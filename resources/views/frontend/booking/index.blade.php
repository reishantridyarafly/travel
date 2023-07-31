@extends('layouts.frontend.main')

@section('css')
    <link href="{{ asset('frontend') }}/libs/select2/select2.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/select2.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css" />
@endsection

@section('content')
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('default') }}/1.jpg') center center;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="pages-heading">
                        <h3 class="title text-white title-dark mb-0">Booking</h3>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <div class="position-relative">
        <div class="shape overflow-hidden text-color-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 pt-2 pt-sm-0 order-2 order-md-1">
                    <div class="card shadow rounded border-0">
                        <div class="card-body py-5">
                            <div class="custom-form">
                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Paket <span class="text-danger">*</span></label>
                                                <select name="package" id="package"
                                                    class="form-control select2 @error('package') is-invalid @enderror"
                                                    data-search="true">
                                                    <option value="">Pilih Paket</option>
                                                    @php
                                                        $selectedId = request()->query('id');
                                                    @endphp
                                                    @foreach ($packages as $package)
                                                        <option value="{{ $package->id }}"
                                                            {{ $selectedId == $package->id ? 'selected' : '' }}>
                                                            {{ $package->name }} - {{ $package->duration }} Hari
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('package')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal mulai <span
                                                        class="text-danger">*</span></label>
                                                <input name="start_date" id="start_date" type="date"
                                                    class="form-control @error('start_date') is-invalid @enderror"
                                                    placeholder="Tanggal mulai :">
                                                @error('start_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Booking</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end custom-form-->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- End -->
@endsection

@section('javascript')
    <script src="{{ asset('frontend') }}/libs/select2/select2.min.js"></script>
    <script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        // show dialog success
        @if (Session::has('message'))
            swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ Session::get('message') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        @endif
    </script>
@endsection
