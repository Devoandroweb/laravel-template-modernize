@extends('app',['title'=>'Master Latihan'])
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold d-flex align-items-center float-start" onclick="location.href = '{{route("master.latihan.index")}}'"><span class="btn-back float-start me-2"><i class="fas fa-arrow-left m-auto"></i></span> Master Latihan Detail (Nomor {{$nomor}})</span>
                <a href="{{route('master.latihan.create',null)}}" class="btn btn-primary float-end">Tambah Latihan</a>
            </div>
            <div class="card-body">
                @if(session('message'))
                    <div class="alert alert-warning">{{session('message')}}</div>
                @endif
                <table id="data" class="table table-bordered"></table>
            </div>
        </div>
    </div>
</div>
@push('datatable')
<script>
    var _URL = @json($urlDT);
    var _COLUMN = @json($columnDT);
    console.log(_COLUMN)
    var _DATATABLE = setDataTable(_URL, _COLUMN)
 </script>
@endpush
@endsection
