@extends('layouts.frontend.main')

@section('content')
<section class="bg-half-170 d-table w-100" style="background: url('{{ asset('default') }}/1.jpg') center center;">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title text-white mb-0"> Metode Pembayaran </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('booking') }}">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Metode Pembayaran</li>
                </ul>
            </nav>
        </div>
    </div> <!--end container-->
</section><!--end section-->
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
                    <div class="card-header"><i class="uil uil-user"></i> Metode Pembayaran</div>
                    <div class="card-body">
                        <div class="custom-form">
                            <form action="{{ route('payment.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="booking" value="{{ $booking->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Bank Transfer(Verifikasi Manual)</label>
                                            @foreach ($payments as $payment)
                                            <div class="form-check">
                                                <input id="credit" name="name_bank" type="radio" value="{{ $payment->name_bank }}" class="form-check-input" checked required>
                                                <label class="form-check-label" for="credit">{{ $payment->name_bank }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div><!--end col-->

                                    <h5 class="mb-3 mt-4 pt-4 border-top">Total</h5>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>{{ $booking->package->name }}</span>
                                        <span>Rp {{ number_format($booking->package->price, 0, ',', '.') }}</span>
                                        <input type="hidden" name="total" value="{{ $booking->package->price}}">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-4 pt-4 border-top">
                                    <div class="col-12 ">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Lanjut</button>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                            <div class="row">
                                <div class="col-12 ">
                                    <form action="{{ route('payment.cancel') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="booking" value="{{ $booking->id}}">
                                        <input type="hidden" name="total" value="{{ $booking->package->price}}">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </div>
                                    </form>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end custom-form-->
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 pt-2 pt-sm-0 order-2 order-md-1">
                <div class="card shadow rounded border-0">
                    <div class="card-header"><i class="uil uil-clipboard-alt"></i> Booking Detail</div>
                    <div class="card-body">
                        <div class="custom-form">
                            <div class="row mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Kode Booking</span>
                                    <span class="fw-bold">{{ $booking->id }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Nama</span>
                                    <span class="fw-bold">{{ $contactDetail->fullname }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Lokasi</span>
                                    <span class="fw-bold">{{ $booking->package->location }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span width="10%">Tanggal Mulai</span>
                                    <span class="fw-bold">{{ date('d/m/Y', strtotime($booking->start_date))}}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span width="50%">Tanggal Selesai</span>
                                    <span class="fw-bold">{{ date('d/m/Y', strtotime($booking->end_date)) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span width="50%">Jumlah Pembayaran</span>
                                    <span class="fw-bold">Rp {{ number_format($booking->package->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div><!--end custom-form-->
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
<!-- End -->
@endsection
