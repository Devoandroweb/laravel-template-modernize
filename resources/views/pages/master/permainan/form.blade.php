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
                <form action="{{route('master.permainan.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_permainan" value="{{$permainan->id_permainan ?? null}}">
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{$permainan->pertanyaan ?? ''}}" required>
                    </div>
                    <div class="mb-3">

                        <div class="form-group">
                            <label for="">Kunci Jawaban</label>
                            <div class="image-live" data-target="image" data-ext="png,jpg,jpeg">
                                <input type="file" class="d-none file-live" name="image">
                                <input type="text" class="d-none" value="{{$permainan->image ?? null}}" name="image-old">
                                @if($permainan?->image != null)
                                <img id="image" src="{{$permainan->imageSrc()}}"  style="width: 200px; height:200px" class="shadow mb-4 img-fluid" alt="">
                                @else
                                <div style="width: 200px; height:200px" class="shadow mb-4 img-fluid d-flex align-items-center">
                                    <div class="m-auto">
                                        <img id="image" src="{{asset('images/upload-image.png')}}" class="img-fluid" style="width: 100px" alt=""><br>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="text-danger mb-4"><small><i>File Tidak Boleh Lebih besar dari 1Mb</i></small></div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="submit" class="btn btn-success" value="Simpan">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{asset('js/image-live.js')}}"></script>
@endpush
@endsection
