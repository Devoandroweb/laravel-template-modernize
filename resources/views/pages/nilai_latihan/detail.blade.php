@extends('app',['title'=>'Nilai Latihan'])
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold d-flex align-items-center float-start" onclick="location.href = '{{route('nilai_latihan.index')}}'"><span class="btn-back float-start me-2"><i class="fas fa-arrow-left m-auto"></i></span> Nilai Latihan Detail (Nomor {{$nomor}})</span>
                <a href="{{route('nilai_latihan.reset',$nomor)}}" class="btn btn-primary float-end">Reset</a>
            </div>
            <div class="card-body">
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
    _DATATABLE.column(3).order('desc').draw()
 </script>
@endpush
@endsection
