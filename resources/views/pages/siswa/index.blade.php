@extends('app',['title'=>'Siswa'])
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold">Siswa</span>
                <a href="{{route('siswa.create',null)}}" class="btn btn-primary float-end">Tambah Siswa</a>
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
