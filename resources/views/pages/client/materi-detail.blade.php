@extends('pages.client.app',['title'=>'Materi Detail'])
@section('content')
    <div class="row col">
        <a href="{{route('client.materi')}}">
            <div class="btn-back text-muted">
                <i class="fas fa-chevron-left"></i> Kembali
            </div>
        </a>
        <div class="p-4 text-center">
            <h5>{{$materi->judul}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="border-dashed-purple mb-2">
                <div class="wall-purple p-3">
                    {!! $materi->isi !!}
                </div>
            </div>
        </div>
    </div>
    @include('pages.client.panels.js')
@endsection