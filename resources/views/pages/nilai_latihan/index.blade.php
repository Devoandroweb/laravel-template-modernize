@extends('app',['title'=>'Nilai Latihan'])
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold">Nilai Latihan</span>
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
