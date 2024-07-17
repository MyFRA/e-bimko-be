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
        <a href="/panel/articles/create" class="btn btn-sm btn-success mb-3"><i class="las la-plus"></i>Buat Artikel</a>
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Artikel</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Kategori</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $index => $article)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="img-thumbnail" width="150px">
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->articleCategory->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 5px">
                                            <a href="/panel/articles/{{ $article->id }}/edit" class="btn btn-sm btn-primary">
                                                <i class="las la-edit"></i>
                                                Edit
                                            </a>
                                            <form action="/panel/articles/{{ $article->id }}" method="post" onsubmit="return confirm(`Apakah anda yakin, akan menghapus artikel {{ $article->title }}`)">
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
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
