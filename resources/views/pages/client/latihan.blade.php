<!DOCTYPE html>
<html lang="en">
@include('pages.client.panels.head',['title'=>'login'])
<body class="bg-main p-4">
    <div class="row col">
        <a href="{{route('client.home')}}">
        <div class="btn-back text-muted">
            <i class="fas fa-chevron-left me-2"></i> Kembali
        </div>
        </a>
        <div class="p-4 d-flex align-items-center">
            <img src="{{asset('client/assets/latihan.png')}}" class="me-3" alt=""> <h5>Latihan</h5>
        </div>
    </div>
    <div class="row">
        @foreach ($latihan as $l)
        <div class="col-6">
            @php
                $done = $l->checkDonelatihan(Auth::guard('siswa')->user()->nis);
            @endphp
            <a href="{{($done)?"#":route('client.latihan.detail',$l->nomor)}}">
                <div class="border-dashed-purple mb-4">
                    <div class="wall-purple p-3 text-center position-relative">
                        @if($done)
                        <span class="position-absolute h-100 d-flex align-items-center" style="top:-30px;right:0">
                            <img src="{{asset('client/assets/verified.png')}}" alt="" style="width: 40px">
                        </span>
                        @endif
                        <p>Latihan {{$l->nomor}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @include('pages.client.panels.js')
</body>
</html>
