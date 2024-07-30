@extends('panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Edit Diagnostik</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <form action="/panel/diagnostics/{{ $diagnostic->id }}" method="POST" enctype="multipart/form-data" id="form-submit" onsubmit="formOnSubmit()">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Judul<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Judul" value="{{ old('title') ? old('title') : $diagnostic->title }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <img src="{{ $diagnostic->thumbnail_url }}" alt="{{ $diagnostic->title }}" class="img-thumbnail d-block" width="150px" id="thumbnail-preview">
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control-file mt-1" accept=".jpg,.jpeg,.png,.webp">
                            @error('thumbnail')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi<span class="text-danger">*</span></label>
                            <div id="editor">
                                {!! old('description') ? old('description') : $diagnostic->description !!}
                            </div>
                            <input type="hidden" name="description" id="description" value="{{ old('description') ? old('description') : $diagnostic->description }}">
                            @error('description')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Link<span class="text-danger">*</span></label>
                            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" placeholder="Link" value="{{ old('link') ? old('link') : $diagnostic->link }}">
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-end" style="gap: 6px">
                            <a href="/panel/diagnostics" class="btn btn-secondary"><i class="las la-undo"></i>Kembali</a>
                            <button class="btn btn-primary"><i class="las la-save"></i>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css">
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endsection

@section('scripts')
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
            }
        }
    </script>
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
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font,
            List
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Paragraph, Bold, Italic, Font, List],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ],
                placeholder: 'Tulis konten disini'
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function formOnSubmit() {
            event.preventDefault()

            const formSubmitElement = document.getElementById('form-submit')
            const contentValue = window.editor.getData();

            document.getElementById('description').value = contentValue

            formSubmitElement.submit()
        }
    </script>
@endsection
