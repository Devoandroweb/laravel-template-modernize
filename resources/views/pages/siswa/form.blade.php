@extends('app',['title'=>'Master Latihan'])
@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold">{{$titleContent}}</span>
            </div>
            <div class="card-body">
                <form action="{{route('siswa.store')}}" method="POST">
                    @csrf
                    @php
                        $kelas = [
                            1 => "Kelas 1",
                            2 => "Kelas 2",
                            3 => "Kelas 3",
                            4 => "Kelas 4",
                            5 => "Kelas 5",
                            6 => "Kelas 6"];
                    @endphp
                    <input type="hidden" name="id_siswa" value="{{$mSiswa->id_siswa ?? null}}">
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        @form_text('nis',$mSiswa->nis ?? '',[
                            'class'=>'form-control',
                            'placeholder'=>'Nomor Induk Siswa',
                            'required' => 'required'
                        ])
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        @form_text('nama',$mSiswa->nama ?? '',[
                            'class'=>'form-control',
                            'placeholder'=>'Nama Lengkap',
                            'required' => 'required'
                        ])
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        @form_select('kelas',$kelas,$mSiswa->kelas ?? 'Kelas 1',['class' => 'form-control'])
                    </div>
                    <div class="mt-3">
                        <input type="submit" class="btn btn-success" value="Simpan">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
