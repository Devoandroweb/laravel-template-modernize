@extends('app',['title'=>'Dashboard'])
@section('content')
<!--  Row 1 -->
<div class="row">
    <div class="col text-center">
        <div class="card border border-primary border-3">
            <div class="card-body p-4">
                <img src="{{asset('images/logos/logo-sd.png')}}" style="width: 150px" alt=""><br><br>
                <h1 class="fw-semibold">Aplikasi Pembelajaran Pendidikan Agama Islam (APAI)</h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100 border border-secondary border-3">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Terakhir Siswa yang Login</h5>
                <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">NIS</h6>
                        </th>
                        <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama</h6>
                        </th>
                        <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Kelas</h6>
                        </th>
                        <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Time</h6>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($siswaTerkahirLogin as $st)
                    <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$loop->iteration}}</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{{$st->nis}}</h6>
                        </td>
                        <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">{{$st->nama}}</p>
                        </td>
                        <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                                <p class="mb-0 fw-normal">Kelas {{$st->kelas}}</p>
                            </div>
                        </td>
                        <td class="border-bottom-0">
                            <span class="badge bg-primary rounded-3">{{date('d-m-Y | H:i:s',strtotime($st->terakhir_login))}}</span>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
        <div class="col-lg-12">
            <!-- Yearly Breakup -->
            <div class="card border border-warning border-3 overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Total Siswa</h5>
                <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3">{{$siswaL+$siswaP}} Siswa dan Siswi</h4>
                    <div class="d-flex align-items-center mb-3">
                        <span
                            class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                            <i class="fas fa-female text-success"></i>
                        </span>
                        <p class="text-dark me-1 fs-3 mb-0">{{$siswaP}} Perempuan</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <span
                            class="me-1 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="fas fa-male text-danger"></i>
                        </span>
                        <p class="text-dark me-1 fs-3 mb-0">{{$siswaL}} Laki-laki</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                    <div id="totalSiswa"></div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@push('js')
<script>
    $(function () {

    // =====================================
    // Breakup
    // =====================================
    var totalSiswa = {
    color: "#adb5bd",
    series: [@json($siswaP), @json($siswaL)],
    labels: ["Perempuan", "Laki-laki"],
    chart: {
        width: 180,
        type: "donut",
        fontFamily: "Plus Jakarta Sans', sans-serif",
        foreColor: "#adb0bb",
    },
    plotOptions: {
        pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
            size: '75%',
        },
        },
    },
    stroke: {
        show: false,
    },

    dataLabels: {
        enabled: false,
    },

    legend: {
        show: false,
    },
    colors: ["#13DEB9", "#FA896B"],

    responsive: [
        {
        breakpoint: 991,
        options: {
            chart: {
            width: 150,
            },
        },
        },
    ],
    tooltip: {
        theme: "dark",
        fillSeriesColor: false,
    },
    };

    var chart = new ApexCharts(document.querySelector("#totalSiswa"), totalSiswa);
    chart.render();
    })

</script>
@endpush
@endsection
