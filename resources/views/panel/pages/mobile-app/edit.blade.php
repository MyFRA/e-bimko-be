@extends('panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (Session::get('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text"><b>Berhasil</b> {{ Session::get('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Pengaturan Aplikasi</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <form action="/panel/app-settings/" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="app_version">Versi Aplikasi<span class="text-danger">*</span></label>
                            <input type="text" name="app_version" id="app_version" class="form-control @error('app_version') is-invalid @enderror" placeholder="Judul" value="{{ old('app_version') ? old('app_version') : $mobileApp->app_version }}">
                            @error('app_version')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="app_url">URL Aplikasi<span class="text-danger">*</span></label>
                            <input type="text" name="app_url" id="app_url" class="form-control @error('app_url') is-invalid @enderror" placeholder="Judul" value="{{ old('app_url') ? old('app_url') : $mobileApp->app_url }}">
                            @error('app_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-end" style="gap: 6px">
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
            const inputThumbnailElement = document.getElementById('thumbnail');
            const thumbnailPreviewElement = document.getElementById('thumbnail-preview')

            inputThumbnailElement.addEventListener('change', () => {
                if (inputThumbnailElement.files.length > 0) {
                    thumbnailPreviewElement.setAttribute('src', URL.createObjectURL(inputThumbnailElement.files[0]))
                }
            })
        }
    </script>
@endsection
