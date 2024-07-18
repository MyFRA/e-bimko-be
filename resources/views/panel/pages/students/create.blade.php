@extends('panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Tambah Siswa</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <form action="/panel/students" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="academic_year">Angkatan<span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center" style="gap: 10px">
                                <input type="number" style="width: 120px" min="2000" max="3000" placeholder="Tahun Awal" class="form-control text-center @error('academic_year_start') is-invalid @enderror" name="academic_year_start" id="academic_year_start" value="{{ old('academic_year_start') }}">
                                <h3>/</h3>
                                <input type="number" style="width: 120px" min="2000" max="3000" placeholder="Tahun Akhir" class="form-control text-center @error('academic_year_end') is-invalid @enderror" name="academic_year_end" id="academic_year_end" value="{{ old('academic_year_end') }}">
                            </div>
                            @error('academic_year_start')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('academic_year_end')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN<span class="text-danger">*</span></label>
                            <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN" value="{{ old('nisn') }}">
                            @error('nisn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dob">Tanggal Lahir<span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Tanggal Lahir" value="{{ old('dob') }}">
                            @error('dob')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profile_pict">Foto Profil</label>
                            <img src="/assets/images/no-profile.webp" alt="student" class="img-thumbnail d-block" width="150px" id="thumbnail-preview">
                            <input type="file" name="profile_pict" id="profile_pict" class="form-control-file mt-1" accept=".jpg,.jpeg,.png,.webp">
                            @error('profile_pict')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-end" style="gap: 6px">
                            <a href="/panel/students" class="btn btn-secondary"><i class="las la-undo"></i>Kembali</a>
                            <button class="btn btn-primary"><i class="las la-save"></i>Simpan</button>
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
