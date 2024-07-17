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
                    <h4 class="card-title">Kategori Artikel</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articleCategories as $index => $articleCategory)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $articleCategory->name }}</td>
                                    <td>
                                        <a href="/panel/article-categories/{{ $articleCategory->id }}/edit" class="btn btn-sm btn-primary">
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
