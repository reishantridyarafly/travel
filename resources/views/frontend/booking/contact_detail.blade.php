@extends('layouts.frontend.main')

@section('content')
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('default') }}/1.jpg') center center;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="pages-heading">
                        <h4 class="title text-white mb-0"> Booking </h4>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('booking_langkuy') }}">Booking</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kontak Detail</li>
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
                <div class="col-lg-8 col-md-6 pt-2 pt-sm-0 order-2 order-md-1">
                    <div class="card shadow rounded border-0">
                        <div class="card-header"><i class="uil uil-user"></i> Data Detail</div>
                        <div class="card-body">
                            <div class="custom-form">
                                <form action="{{ route('save_contact_details') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <div class="row">
                                        @for ($i = 0; $i < $booking->package->kapasitas; $i++)
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Nama Lengkap
                                                            {{ $i == 0 ? 'Ketua' : 'Anggota' }}
                                                            <span class="text-danger">*</span></label>
                                                        <input name="fullnames[]" id="fullname{{ $i }}"
                                                            type="text"
                                                            class="form-control @error('fullnames.' . $i) is-invalid @enderror"
                                                            value="{{ $i == 0 ? auth()->user()->name : old('fullnames.' . $i) }}"
                                                            placeholder="Nama Lengkap :">
                                                        @error('fullnames.' . $i)
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Nomor Induk Kependudukan
                                                            {{ $i == 0 ? 'Ketua' : 'Anggota' }}
                                                            <span class="text-danger">*</span></label>
                                                        <input name="nik[]" id="nik{{ $i }}" type="number"
                                                            class="form-control @error('nik.' . $i) is-invalid @enderror"
                                                            value="{{ $i == 0 ? auth()->user()->nik : old('nik.' . $i) }}"
                                                            placeholder="Nomor Induk Kependudukan :">
                                                        @error('nik.' . $i)
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        @endfor
                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                            <input name="telephone" id="telephone" type="number"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                value="{{ auth()->user()->no_hp }}" placeholder="No. Telepon :">
                                            @error('telephone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ auth()->user()->email }}" placeholder="Email :">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Lanjut</button>
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
                <div class="col-lg-4 col-md-6 pt-2 pt-sm-0 order-2 order-md-1">
                    <div class="card shadow rounded border-0">
                        <div class="card-header"><i class="uil uil-clipboard-alt"></i> Booking Detail</div>
                        <div class="card-body">
                            <div class="custom-form">
                                <div class="row mb-3">
                                    <table class="table mb-0 table-center">
                                        <tbody>
                                            <tr>
                                                {{-- <td><img src="{{ asset('storage/packages/' . $booking->package->images) }}" width="50px" alt="paket"></td> --}}
                                                <td class="fw-bold" colspan="2">{{ $booking->package->name }}
                                                    ({{ $booking->package->kapasitas }} Pax)</td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Tanggal Mulai</td>
                                                <td>{{ date('d/m/Y', strtotime($booking->start_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Tanggal Selesai</td>
                                                <td>{{ date('d/m/Y', strtotime($booking->end_date)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="text-muted"><i class="uil uil-times-circle"></i> Non Refundable</div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
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
