<!DOCTYPE html>
<html lang="en">
@include('pages.client.panels.head',['title'=>'login'])
<body class="bg-main">
    <div class="row justify-content-center m-auto">
        <div class="col p-4 text-center">
            <form action="{{route('siswa.auth')}}" method="POST">
                @csrf

                <div style="font-size: 35pt;">Belajar <br> PAI</div>
                <img src="{{asset('client/assets/login.png')}}" alt=""><br><br><br>
                @if(session('message'))
                <div class="alert alert-danger">{{session('message')}}</div>
                @endif
                <div class="border-dashed-purple mb-2">
                    <input type="text" name="nama" placeholder="Ketik Nama anda disini" class="wall-purple p-2 text-center w-100" id="">
                </div>
                <div class="border-dashed-pink mb-2">
                    <input type="number" name="kelas" placeholder="Kelas" class="wall-pink p-2 text-center w-100" id="">
                </div>
                <button type="button" id="btn-login" class="btn-blue w-100 p-2 border-0">Masuk</button>
            </form>
        </div>
    </div>
    @include('pages.client.panels.js')
    <script>
        $("#btn-login").click(function (e) {
            e.preventDefault();
            login()
        });
        function login(){
            $("#btn-login").addClass('disabled')
            $("#btn-login").text('Tunggu sebentar ...')
            $(".card").addClass('box')
            $('form').submit()
        }
      </script>
</body>
</html>
