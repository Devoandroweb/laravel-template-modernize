<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEpicRequest;
use App\Http\Resources\UserEpicResource;
use App\Models\UserEpic;
use App\Repositories\ApiHandle\ApiHandleRepository;
use Illuminate\Http\Request;

class CUser extends Controller
{
    protected $apiHandleRepository;
    function __construct(ApiHandleRepository $apiHandleRepository){
        $this->apiHandleRepository = $apiHandleRepository;
    }
    function list() {
        return $this->apiHandleRepository->safeApiCall(function(){
            $user = UserEpic::all();
            $user = UserEpicResource::collection($user);
            return responseSuccess($user);
        });
    }
    function profile($id_user) {
        return $this->apiHandleRepository->safeApiCall(function()use($id_user){
            $user = UserEpic::find($id_user);
            $user = UserEpicResource::make($user);
            return responseSuccess($user);
        });
    }
    function create(UserEpicRequest $userEpicRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($userEpicRequest){
            $credentials = $userEpicRequest->validated();
            UserEpic::create($credentials);
            return responseSuccess(['message'=>'Sukses Menambahkan Pengguna']);
        });

    }
    function update(UserEpicRequest $userEpicRequest) {
        return $this->apiHandleRepository->safeApiCall(function() use ($userEpicRequest){
            $credentials = $userEpicRequest->validated();
            UserEpic::find($userEpicRequest->id_user)->update($credentials);
            return responseSuccess(['message'=>'Sukses Mengubah Pengguna']);
        });
    }
    function delete(){
        return $this->apiHandleRepository->safeApiCall(function(){
            $idUser = request('id_user');
            // dd($id_barang);
            UserEpic::find($idUser)->delete();
            return responseSuccess(['message'=>'Sukses Menghapus Pengguna']);
        });
    }
    function updateFotoProfile() {
        return $this->apiHandleRepository->safeApiCall(function(){
            if(request()->hasFile('foto')){
                $nameFileFoto = uploadImage(public_path("images/user"),request()->file('foto'));
                UserEpic::find(request()->id_user)->update([
                    'foto' => $nameFileFoto
                ]);
            }
            return responseSuccess(['message'=>'Sukses Mengubah Foto Pengguna']);
        });
    }

}
