@extends('panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Edit Guru</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <form action="/panel/teachers/{{ $teacher->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') ? old('name') : $teacher->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP<span class="text-danger">*</span></label>
                            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP" value="{{ old('nip') ? old('nip') : $teacher->mobileUser->nip_nisn }}">
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Male" @if (old('gender')) {{ old('gender') == 'Male' ? 'selected' : '' }}
                                    @else
                                    {{ $teacher->gender == 'Male' ? 'selected' : '' }} @endif>Laki-laki</option>
                                <option value="Female" @if (old('gender')) {{ old('gender') == 'Female' ? 'selected' : '' }}
                                @else
                                {{ $teacher->gender == 'Female' ? 'selected' : '' }} @endif>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profile_pict">Foto Profil</label>
                            <img src="{{ $teacher->profile_pict_url }}" alt="{{ $teacher->title }}" class="img-thumbnail d-block" width="150px" id="thumbnail-preview">
                            <input type="file" name="profile_pict" id="profile_pict" class="form-control-file mt-1" accept=".jpg,.jpeg,.png,.webp">
                            @error('profile_pict')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-end" style="gap: 6px">
                            <a href="/panel/teachers" class="btn btn-secondary"><i class="las la-undo"></i>Kembali</a>
                            <button class="btn btn-primary"><i class="las la-save"></i>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            makeInputFileThumbnailListenChangeValue()
        })

        function makeInputFileThumbnailListenChangeValue() {
            const inputThumbnailElement = document.getElementById('profile_pict');
            const thumbnailPreviewElement = document.getElementById('thumbnail-preview')

            inputThumbnailElement.addEventListener('change', () => {
                if (inputThumbnailElement.files.length > 0) {
                    thumbnailPreviewElement.setAttribute('src', URL.createObjectURL(inputThumbnailElement.files[0]))
                }
            })
        }
    </script>
@endsection
