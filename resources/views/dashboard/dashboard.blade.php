@extends('app',['title'=>'Dashboard'])
@section('content')
<!--  Row 1 -->
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
        <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">Grafik Penjualan</h5>
            </div>
            <div>
                <select class="form-select">
                <option value="1">March 2023</option>
                <option value="2">April 2023</option>
                <option value="3">May 2023</option>
                <option value="4">June 2023</option>
                </select>
            </div>
            </div>
            <div id="chart"></div>
        </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
        <div class="col-lg-12">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Penjualan Perbulan</h5>
                <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3">4,600 Unit</h4>
                    <div class="d-flex align-items-center mb-3">
                        <span
                            class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-down text-success"></i>
                        </span>
                        <p class="text-dark me-1 fs-3 mb-0">(+) 400 Barang Masuk</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <span
                            class="me-1 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-up text-danger"></i>
                        </span>
                        <p class="text-dark me-1 fs-3 mb-0">(-) 900 Barang Keluar</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <span
                            class="me-1 rounded-circle bg-light-warning round-20 d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-down text-warning"></i>
                        </span>
                        <p class="text-dark me-1 fs-3 mb-0">(+) 230 Barang Return</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                    <div id="breakup"></div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <div class="card">
            <div class="card-body">
                <div class="row alig n-items-start">
                <div class="col-8">
                    <h5 class="card-title mb-9 fw-semibold">Pendapatan Pertahun </h5>
                    <h4 class="fw-semibold mb-3">Rp489,000,000</h4>
                    <div class="d-flex align-items-center pb-1">
                    <span
                        class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus text-danger"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">9%</p>
                    <p class="fs-3 mb-0">bulan ini</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                    <div
                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="fas fa-dollar-sign text-white fs-6"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div id="earning"></div>
            </div>
        </div>
        </div>
    </div>
    </div>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Riwayat Transaksi</h5>
            <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                <tr>
                    <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Id</h6>
                    </th>
                    <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nama Pembeli</h6>
                    </th>
                    <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Barang</h6>
                    </th>
                    <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Status</h6>
                    </th>
                    <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Total</h6>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                    </td>
                    <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">Mie Instan (4), Minyak (10)</p>
                    </td>
                    <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-3 fw-semibold">Tunai</span>
                    </div>
                    </td>
                    <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">Rp400,000</h6>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
