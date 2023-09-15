@extends('app',['title'=>'Master Latihan'])
@section('content')
<style>
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span class="card-title fw-semibold">{{$titleContent}}</span>
            </div>
            <div class="card-body">
                <form action="{{route('master.latihan.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_latihan" value="{{$mLatihan->id_latihan ?? null}}">
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{$mLatihan->pertanyaan ?? ''}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilihan</label>
                        @php
                            $pilihan = ['A','B','C','D'];
                        @endphp
                        @foreach ($pilihan as $pil)
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">{{$pil}}</span>
                            {{-- <input type="text" name="pilihan_{{strtolower($pil)}}" class="form-control" value="{{$mLatihan['pilihan_'.strtolower($pil)] ?? ''}}" placeholder="Pilihan {{$pil}}" required> --}}
                            @form_text("pilihan_".strtolower($pil),$mLatihan['pilihan_'.strtolower($pil)] ?? '',[
                                'class'=>'form-control',
                                'placeholder'=>'Pilihan '.$pil,
                                'required' => 'required'
                            ])
                        </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="jawaban" class="form-label">Kunci Jawaban</label>
                        @form_select('jawaban',$pilihan,$mLatihan->jawaban ?? 'A',['class' => 'form-control'])
                    </div>
                    <div class="mb-3">
                        <label for="bobot" class="form-label">Bobot</label>
                        <input type="text" class="form-control" id="bobot" name="bobot" value="{{$mLatihan->bobot ?? 0}}" required>
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
