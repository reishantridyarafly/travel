@extends('layouts.auth.main')

@section('title', 'Lupa Kata Sandi')

@section('content')
<!-- Hero Start -->
<section class="bg-home bg-primary d-flex align-items-center">
    <div class="bg-overlay bg-overlay-white"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card form-signin p-4 rounded shadow">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <a href="{{ url('/') }}"><img src="{{ asset('backend') }}/assets/images/logo-icon.png" class="avatar avatar-small mb-4 d-block mx-auto" alt=""></a>
                        <h5 class="mb-3 text-center">Lupa kata sandi</h5>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="text-muted">Masukkan alamat email Anda. Anda akan menerima tautan untuk membuat kata sandi baru melalui email.</p>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            <label for="floatingInput">Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Kirim</button>

                        <div class="col-12 text-center mt-3">
                            <p class="mb-0 mt-3"><small class="text-dark me-2">Ingat kata sandi anda ?</small> <a href="{{ route('login') }}" class="text-dark fw-bold">Masuk</a></p>
                        </div><!--end col-->

                        <p class="mb-0 text-muted mt-3 text-center">© <script>document.write(new Date().getFullYear())</script> Mountaineer.</p>
                    </form>
                </div>
            </div>
        </div>
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->
@endsection
