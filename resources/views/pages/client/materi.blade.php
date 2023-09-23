@extends('pages.client.app',['title'=>'Materi Detail'])
@section('content')
    <div class="row col">
        <a href="{{route('client.home')}}">
            <div class="btn-back text-muted">
                <i class="fas fa-chevron-left"></i> Kembali
            </div>
        </a>
        <div class="p-4 d-flex align-items-center">
            <img src="{{asset('client/assets/materi.png')}}" class="me-3" alt=""> <h5>Materi Pembelajaran</h5>
        </div>
    </div>
    @foreach ($materi as $m)
    <a href="{{route('client.materi.detail',$m)}}">
        <div class="row">
            <div class="col">
                <div class="border-dashed-purple mb-2">
                    <div class="wall-purple p-3">
                        <p>{{$m->judul}}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endforeach
    @include('pages.client.panels.js')
@endsection
