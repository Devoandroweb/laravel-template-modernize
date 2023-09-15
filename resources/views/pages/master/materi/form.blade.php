@extends('app',['title'=>'Master Materi'])
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
                <form action="{{route('master.materi.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_materi" value="{{$mMateri->id_materi ?? null}}">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{$mMateri->judul ?? ''}}">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Isi</label>
                        <textarea id="editor" style="height: 500px" name="isi">{!!$mMateri->isi ?? ''!!}</textarea>
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
