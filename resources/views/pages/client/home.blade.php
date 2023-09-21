<!DOCTYPE html>
<html lang="en">
@include('pages.client.panels.head',['title'=>'login'])
<body class="bg-main">
    <div class="row justify-content-center m-auto">
        <div class="col p-4 text-center">
            <img src="{{asset('client/assets/home.png')}}" width="200px" alt=""><br><br>
            <div class="bg-blue-light mb-4 mx-1">Semester 1</div>
            <div class="row">
                <div class="col">
                    <div class="bg-blue-light mb-4 mx-1">{{$siswa->nama}}</div>
                </div>
                <div class="col">
                    <div class="bg-blue-light mb-4 mx-1">Kelas {{$siswa->kelas}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{route('client.materi')}}">
                        <div class="border-dashed-purple mb-2">
                            <div class="wall-purple p-4">
                                <img src="{{asset('client/assets/materi.png')}}" alt="" class=""><br><br>
                                <h3>Materi</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{route('client.latihan')}}">
                    <div class="border-dashed-pink mb-2">
                        <div class="wall-pink p-4">
                            <img src="{{asset('client/assets/latihan.png')}}" alt="" class=""><br><br>
                            <h3>Latihan</h3>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
    @include('pages.client.panels.js')
</body>
</html>
