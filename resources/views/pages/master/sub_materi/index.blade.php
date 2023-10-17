@extends('app',['title'=>'Master Sub Materi'])
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold">Master Sub Materi</span>
                <a href="{{route('master.sub-materi.create',$id_materi)}}" class="btn btn-primary float-end">Tambah Sub Materi</a>
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
