<!DOCTYPE html>
<html lang="en">
@include('pages.client.panels.head',['title'=>'login'])
<body class="bg-main">
    <div class="row justify-content-center m-auto">
        <div class="col text-center pt-5">
            <img src="{{asset('client/assets/animation_lmubklkn_small.gif')}}" style="width: 200px" alt="" srcset="">
            <br>
            <br>
            <p>Terima Kasih, Silahkan minta nilai ke Guru kamu ya...:)</p>
            <br>
            <a href="{{route('client.home')}}" class="btn-lanjut">
                <div class="border-dashed-green mb-2 btn btn-next">
                    <div class="wall-green p-2 px-4 text-center">
                        <p>Kembali ke Halaman Utama</p>
                    </div>
                </div>
                </a>
        </div>
    </div>

</body>
</html>
