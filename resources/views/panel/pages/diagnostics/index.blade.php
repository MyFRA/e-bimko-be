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
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Diagnostik</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Link</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnostics as $index => $diagnostic)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $diagnostic->title }}</td>
                                    <td>
                                        <img src="{{ $diagnostic->thumbnail_url }}" alt="{{ $diagnostic->title }}" class="img-thumbnail" width="150px">
                                    </td>
                                    <td>
                                        <a href="{{ $diagnostic->link }}" target="_blank">{{ $diagnostic->link }}</a>
                                    </td>
                                    <td>
                                        <a href="/panel/diagnostics/{{ $diagnostic->id }}/edit" class="btn btn-sm btn-primary">
                                            <i class="las la-edit"></i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
