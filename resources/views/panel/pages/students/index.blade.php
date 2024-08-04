@extends('panel.layouts.app')

@section('content')
    <div>
        @if (Session::get('success'))
            <div class="alert text-white bg-success" role="alert">
                <div class="iq-alert-text"><b>Berhasil</b> {{ Session::get('success') }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                </button>
            </div>
        @endif
        <a href="/panel/students/create" class="btn btn-sm btn-success mb-3"><i class="las la-plus"></i>Tambah Siswa</a>
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Siswa</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Angkatan</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Device ID</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ $student->profile_pict_url }}" alt="{{ $student->name }}" class="img-thumbnail" width="100px">
                                    </td>
                                    <td>{{ $student->academic_year }}</td>
                                    <td>{{ $student->mobileUser->nip_nisn }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $student->mobileUser->device_id ? $student->mobileUser->device_id : 'Belum Login' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 5px">
                                            @if ($student->mobileUser->device_id)
                                                <form action="/panel/students/{{ $student->id }}/reset-device" onsubmit="return confirm('Apakah anda yakin?')" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-dark">
                                                        <i class="las la-exclamation-triangle"></i>
                                                        Reset Device
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="/panel/students/{{ $student->id }}/edit" class="btn btn-sm btn-primary">
                                                <i class="las la-edit"></i>
                                                Edit
                                            </a>
                                            <form action="/panel/students/{{ $student->id }}" method="post" onsubmit="return confirm(`Apakah anda yakin, akan menghapus siswa {{ $student->name }}`)">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <i class="las la-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
