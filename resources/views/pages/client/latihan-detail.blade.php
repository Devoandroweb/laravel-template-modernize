<!DOCTYPE html>
<html lang="en">
@include('pages.client.panels.head',['title'=>'login'])
<style>
    .pilihan{
        cursor: pointer;
    }
</style>
<body class="bg-main p-4">
    <div class="row col">
        <a href="{{route('client.latihan')}}">
        <div class="btn-back text-muted">
            <i class="fas fa-chevron-left"></i> Kembali
        </div>
        <div class="p-4 text-center">
            <h5>Latihan {{$latihan->nomor}}</h5>
        </div>
        </a>
    </div>
    <div class="row">
        <div class="col">
            <div class="border-dashed-green mb-2">
                <div class="wall-green p-3 text-center">
                    <p>{{$latihan->urutan}}.<br>{{$latihan->pertanyaan}}</p>
                </div>
            </div>

            <div class="border-dashed-purple mb-2 pilihan" data-pilihan="a">
                <div class="wall-purple p-3">
                    <p>A. {{$latihan->pilihan_a}}</p>
                </div>
            </div>
            <div class="border-dashed-purple mb-2 pilihan" data-pilihan="b">
                <div class="wall-purple p-3">
                    <p>B. {{$latihan->pilihan_b}}</p>
                </div>
            </div>
            <div class="border-dashed-purple mb-2 pilihan" data-pilihan="c">
                <div class="wall-purple p-3">
                    <p>C. {{$latihan->pilihan_c}}</p>
                </div>
            </div>
            <div class="border-dashed-purple mb-2 pilihan" data-pilihan="d">
                <div class="wall-purple p-3">
                    <p>D. {{$latihan->pilihan_d}}</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                </div>
                <div class="col text-center">
                    <div class="border-dashed-pink m-auto mb-2 rounded-circle p-0 d-flex align-items-center" style="width: 55px;height: 55px;">
                        <div class="wall-pink rounded-circle m-auto d-flex align-items-center" style="width: 40px;height: 40px;">
                            <span class="m-auto">{{$latihan->bobot}}</span>
                        </div>
                    </div>
                    Point
                </div>
                <div class="col text-end">
                    @if($nextButton)
                    <a href="#" class="btn-lanjut">
                        <div class="border-dashed-blue-light mb-2 btn-next btn disabled">
                            <div class="wall-blue-light p-2 px-4 text-center">
                                <p>Lanjut</p>
                            </div>
                        </div>
                    </a>
                    @else
                    <a href="#" class="btn-lanjut">
                    <div class="border-dashed-blue-light mb-2 btn btn-next disabled">
                        <div class="wall-blue-light p-2 px-4 text-center">
                            <p>Selesai</p>
                        </div>
                    </div>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @include('pages.client.panels.js')
    <script>
        var selesai = false;
        @if($nextButton)
            selesai = true;
        @endif
        
        $(".pilihan").click(function (e) {
            e.preventDefault();
            $(".pilihan").removeClass('border-dashed-active')
            $(this).addClass('border-dashed-active')
            $('.btn-next').removeClass('disabled')
        });
        $(".pilihan").click(function (e) {
            e.preventDefault();
            var pilihan = $(this).data('pilihan');
            var href = "{{route('client.latihan.next',$latihan->nomor)}}?urutan={{$latihan->urutan+1}}&nis={{$nis}}&selesai="+selesai;
            $('.btn-lanjut').attr('href',href+"&jawaban="+pilihan);
        });
    </script>
</body>
</html>
