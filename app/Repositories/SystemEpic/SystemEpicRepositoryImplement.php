<?php

namespace App\Repositories\SystemEpic;

use App\Models\MBarang;
use App\Models\PengembalianBarang;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\SystemEpic;
use App\Models\Penjualan;
use App\Models\Persediaan;
use App\Models\Sales;
use App\Models\User;
use App\Models\UserEpic;

class SystemEpicRepositoryImplement extends Eloquent implements SystemEpicRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Sales|mixed $sales;
    */
    protected $sales;
    protected $mBarang;
    protected $persediaan;
    protected $penjualan;
    protected $pengembalianBarang;

    public function __construct(
        Sales $sales,
        Mbarang $mBarang,
        Persediaan $persediaan,
        Penjualan $penjualan,
        PengembalianBarang $pengembalianBarang
    )
    {
        $this->sales = $sales;
        $this->mBarang = $mBarang;
        $this->penjualan = $penjualan;
        $this->persediaan = $persediaan;
        $this->pengembalianBarang = $pengembalianBarang;
    }
    function addSalesAndStock($credentials) {
        $idBarang = $credentials['id_barang'];
        $persediaan = $this->persediaan->whereIdBarang($idBarang)->first();
        // dd($persediaan);
        if($persediaan){
            $persediaan->jumlah_barang += (int)$credentials['jumlah_sales'];
            $sales = $this->sales->create($credentials);
            updatedCreatedBy($sales);
            updatedCreatedBy($persediaan);
            return true;
        }else{
            return false;
        }
    }
    function listWarningRefillBarang(){
        $barangWarning = $this->mBarang->whereHas('persediaan', function($query) {
            $query->where('jumlah_barang','<=','barang.minimal_persediaan');
        })->get();
        return $barangWarning;
    }
    function addPenjualanAndReduceStock($credentials) {
        $idBarang = $credentials['id_barang'];
        $persediaan = $this->persediaan->whereIdBarang($idBarang)->first();
        if($persediaan){
            $resultReduce = $persediaan->jumlah_barang - (int)$credentials['jumlah_penjualan'];
            // dd($resultReduce,$resultReduce < 0);
            if($resultReduce < 0){
                return 0;
            }else{
                $penjualan = $this->penjualan->create($credentials);
                $persediaan->jumlah_barang = $resultReduce;
                $persediaan->update();
                updatedCreatedBy($penjualan);
                updatedCreatedBy($persediaan);
                return true;
            }
        }else{
            return false;
        }
    }
    function addReturnBarangAndStock($credentials) {
        $idBarang = $credentials['id_barang'];
        $persediaan = $this->persediaan->whereIdBarang($idBarang)->first();

        if($persediaan){
            $persediaan->jumlah_barang -= (int)$credentials['jumlah_barang'];
            $pengembalian = $this->pengembalianBarang->create($credentials);
            updatedCreatedBy($persediaan);
            updatedCreatedBy($pengembalian);
            return true;
        }else{
            return false;
        }
    }
    function reduceSalesAndStock($id_sales){
        $sales = Sales::whereIdSales($id_sales)->first();
        $persediaan = Persediaan::whereIdBarang($sales->id_barang)->first();
        if($persediaan->jumlah_barang > $sales->jumlah_sales){
            $persediaan->jumlah_barang -= $sales->jumlah_sales;
            if($persediaan->update()){
                $sales->delete();
                return 1;
            }
            return 0;
        }else{
            return -1;
        }
    }
    function reducePenjualanAndStock($id_penjualan){
        $penjualan = Penjualan::whereIdPenjualan($id_penjualan)->first();
        $persediaan = Persediaan::whereIdBarang($penjualan->id_barang)->first();
        $persediaan->jumlah_barang += $penjualan->jumlah_penjualan;
        if($persediaan->update()){
            $penjualan->delete();
            return 1;
        }
        return 0;
    }
    function getStatistic(){
        $month = request('month');
        $year = request('year');
         // $materi = MMateri::whereIdMateri(1)->with('subMateri')->first();

        // Tanggal awal
        $startDate = Carbon::create($year, $month, 1); // Gantilah dengan tanggal awal yang Anda butuhkan

        // Tanggal akhir, misalnya sampai minggu ke-4
        $endDate = $startDate->copy()->addWeeks(3); // 3 minggu setelah tanggal awal

        // Array untuk menyimpan tanggal-tanggal setiap minggu
        $weeklyDates = [];

        $dateMonth = Carbon::create($year, $month, 1);

        // Hitung jumlah hari dalam bulan
        $countDayInMonth = $dateMonth->daysInMonth;

        // Loop untuk mengambil tanggal setiap minggu
        while ($startDate->lte($endDate)) {
            $weeklyDates[] = $startDate->toDateString();
            $startDate->addWeek(); // Geser ke minggu berikutnya
        }
        $result = [];
        // Cetak hasil
        foreach ($weeklyDates as $i => $date) {
            // dd($i);

            $dateSparated = explode("-",$date);
            $dateCreate = Carbon::create($dateSparated[0],$dateSparated[1],$dateSparated[2]);
            $week = [$date,$dateCreate->addDays(6)->toDateString()];

            $result[] = Penjualan::whereBetween('tanggal_penjualan',$week)->get()->count();

        }
        if(($countDayInMonth-28) > 0){
            $result[] = Penjualan::whereBetween('tanggal_penjualan',["{$year}-{$month}-29","{$year}-{$month}-31"])->get()->count();
        }
        return $result;
    }
    function getReportPenjualan(){
        $barang = MBarang::whereUser()->get();
        $result = [];
        $dateLastMothS = date("Y-m-1",strtotime("-1 month"));
        $dateLastMothE = date("Y-m-31",strtotime("-1 month"));
        $whereDate = [$dateLastMothS,$dateLastMothE];
        // dd($dateLastMoth);
        foreach($barang as $b){
            $result[] = [
                'kode_barang'=>$b->kode_barang,
                'nama_barang'=>$b->nama_barang,
                'sales' => $b->salesMany()->whereBetween('created_at',$whereDate)->sum("jumlah_sales"),
                'penjualan' => $b->penjualanMany()->whereBetween('created_at',$whereDate)->sum("jumlah_penjualan"),
                'pengembalian' => $b->pengembalianMany()->whereBetween('created_at',$whereDate)->sum("jumlah_barang"),
                'persediaan' => $b->persediaanMany()->whereBetween('created_at',$whereDate)->sum("jumlah_barang"),
            ];
        }
        return $result;
    }
    function pushNotifWarningRefill($id_user){
        $countBarangRefill = $this->listWarningRefillBarang()->count();
        $userAll = UserEpic::where('role',1)->orWhere('id_user',$id_user)->get();
        
        foreach ($userAll as $user) {
            $message = [
                'title'=> 'Wayahe blonjo',
                'points'=>80,
                'body' => 'Wayahe ngisi barang lur, onok '.$countBarangRefill.' iki ndang isi, cok iiii'
            ];
            if(!sendFCM($user,$message)){
                continue;
            }
        }
    }
}
