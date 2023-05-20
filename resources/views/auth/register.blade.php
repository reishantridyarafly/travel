@extends('layouts.auth.main')

@section('title', 'Daftar')

@section('content')
<!-- Hero Start -->
<section class="bg-primary d-flex align-items-center">
    <div class="bg-overlay bg-overlay-white"></div>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card p-4 rounded shadow">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <a href="{{ url('/') }}"><img src="{{ asset('backend') }}/images/logo-icon.png" class="avatar avatar-small mb-4 d-block mx-auto" alt=""></a>
                        <h5 class="mb-3 text-center">Daftarkan akun anda</h5>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"  name="first_name" id="floatingInput" placeholder="Nama Lengkap" value="{{ old('first_name') }}" autocomplete="first_name">
                                    <label for="floatingInput">Nama Depan</label>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"  name="last_name" id="floatingInput" placeholder="Nama Lengkap" value="{{ old('last_name') }}" autocomplete="last_name">
                                    <label for="floatingInput">Nama Belakang</label>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-2">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" id="floatingInput" placeholder="nama@gmail.com" value="{{ old('username') }}" autocomplete="username">
                            <label for="floatingInput">Username</label>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-2">
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror"  name="no_hp" id="floatingInput" placeholder="nama@gmail.com" value="{{ old('no_hp') }}" autocomplete="no_hp">
                            <label for="floatingInput">No. Hp</label>
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-2">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" id="floatingInput" placeholder="nama@gmail.com" value="{{ old('email') }}" autocomplete="email">
                            <label for="floatingInput">Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Kata Sandi" autocomplete="new-password">
                            <label for="floatingPassword">Kata Sandi</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password_confirmation" id="floatingPassword" placeholder="Konfirmasi Kata Sandi" autocomplete="new-password">
                            <label for="floatingPassword">Konfirmasi Kata Sandi</label>
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Daftar</button>

                        <div class="col-12 text-center mt-3">
                            <p class="mb-0 mt-3"><small class="text-dark me-2">Sudah memiliki akun ?</small> <a href="{{ route('login') }}" class="text-dark fw-bold">Masuk</a></p>
                        </div><!--end col-->

                        <p class="mb-0 text-muted mt-3 text-center">© <script>document.write(new Date().getFullYear())</script> CV Langkuy Project.</p>
                    </form>
                </div>
            </div>
        </div>
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->
@endsection
