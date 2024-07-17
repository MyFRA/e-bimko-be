@extends('auth.layouts.app')

@section('content')
    <section class="sign-in-page">
        <div id="container-inside">
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
        </div>
        <div class="container p-0">
            <div class="row no-gutters height-self-center">
                <div class="col-md-5 align-self-center mx-auto bg-primary rounded">
                    <div class="row m-0">
                        <div class="col bg-white sign-in-page-data">
                            <div class="sign-in-from">
                                <h1 class="mb-0 text-center">Masuk</h1>
                                <p class="text-center text-dark">Masukkan alamat email dan kata sandi Anda untuk mengakses panel admin.</p>
                                <form class="mt-4" action="/panel/auth/login" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" required class="form-control mb-0 @error('email') is-invalid @enderror" id="email" placeholder="Masukan email" value="{{ old('email') }}">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="passwprd">Kata Sandi</label>
                                        <input type="password" name="password" required class="form-control mb-0 @error('password') is-invalid  @enderror" id="passwprd" placeholder="Kata Sandi">

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="sign-info text-center">
                                        <button type="submit" class="btn btn-primary d-block w-100 mb-2">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
