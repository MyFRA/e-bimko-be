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
        <a href="/panel/teachers/create" class="btn btn-sm btn-success mb-3"><i class="las la-plus"></i>Tambah Guru</a>
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Guru</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Device ID</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $index => $teacher)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ $teacher->profile_pict_url }}" alt="{{ $teacher->name }}" class="img-thumbnail" width="100px">
                                    </td>
                                    <td>{{ $teacher->mobileUser->nip_nisn }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $teacher->mobileUser->device_id ? $teacher->mobileUser->device_id : 'Belum Login' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 5px">
                                            <a href="/panel/teachers/{{ $teacher->id }}/edit" class="btn btn-sm btn-primary">
                                                <i class="las la-edit"></i>
                                                Edit
                                            </a>
                                            <form action="/panel/teachers/{{ $teacher->id }}" method="post" onsubmit="return confirm(`Apakah anda yakin, akan menghapus guru {{ $teacher->name }}`)">
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
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection
