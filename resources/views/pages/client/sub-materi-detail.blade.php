@extends('pages.client.app',['title'=>'Materi Detail'])
@section('content')
    <div class="row col">
        <a href="{{route('client.materi.detail',$mmateri)}}">
            <div class="btn-back text-muted">
                <i class="fas fa-chevron-left"></i> Kembali
            </div>
        </a>
        <div class="p-4 text-center">
            <h5>{{$subMateri->judul}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($subMateri->isi)
            <div class="border-dashed-pink mb-2">
                <div class="wall-pink p-3">
                    {!! $subMateri->isi !!}
                </div>
            </div>
            @endif
        </div>
    </div>
    @include('pages.client.panels.js')
@endsection
