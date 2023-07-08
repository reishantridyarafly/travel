@extends('layouts.frontend.main')

@section('css')
<!-- Sweat Alert -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Riwayat Booking </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Booking</li>
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
<!-- Hero End -->

<!-- Start -->
<section class="section">
    <div class="container">
        <div class="row align-items-end">

            <div class="col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="shadow rounded p-4">
                    <div class="table-responsive bg-white shadow rounded">
                        <table class="table mb-0 table-center table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-bottom">Kode Booking</th>
                                    <th scope="col" class="border-bottom">Paket</th>
                                    <th scope="col" class="border-bottom">Tanggal Mulai</th>
                                    <th scope="col" class="border-bottom">Tanggal Selesai</th>
                                    <th scope="col" class="border-bottom">Total</th>
                                    <th scope="col" class="border-bottom">Status</th>
                                    <th scope="col" class="border-bottom">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <th scope="row">{{ $booking->id }}</th>
                                    <td>{{ $booking->package->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->start_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->end_date)) }}</td>
                                    @if ($booking->transactions && $booking->transactions->isNotEmpty())
                                        <td>Rp {{ number_format($booking->transactions->first()->total, 0, ',', '.') }}</td>
                                        @if ($booking->transactions->first()->photo_evidence != null)
                                            <td class="{{ $booking->transactions->first()->status == 'success' ? 'text-success' : ($booking->transactions->first()->status == 'failed' ? 'text-danger' : 'text-muted') }}">
                                                {{ strtoupper($booking->transactions->first()->status) }}
                                            </td>
                                        @else
                                            <td class="text-muted">Belum Upload Bukti Pembayaran</td>
                                        @endif
                                    @endif
                                    <td>
                                        @if ($booking->transactions && $booking->transactions->isNotEmpty())
                                            @if ($booking->transactions->first()->photo_evidence == null)
                                                <a href="{{ route('payment_detail', $booking->id) }}" class="text-primary">Upload Bukti <i class="uil uil-arrow-right"></i></a><br>
                                            @endif
                                        @endif
                                        <a href="javascript:void(0)" class="text-primary" data-bs-toggle="modal" data-bs-target="#detail{{ $booking->id }}">Detail <i class="uil uil-arrow-right"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--end teb pane-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
<!-- Modal Detail -->
@foreach ($bookings as $booking)
<div class="modal fade" id="detail{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Data Booking</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="row">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <span>Kode Booking</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span class="fw-bold">{{ $booking->id }}</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span>Nama</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        @if ($booking->contactDetails && $booking->contactDetails->isNotEmpty())
                                        <span class="fw-bold">{{ $booking->contactDetails->first()->fullname }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span>Paket</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span class="fw-bold">{{ $booking->package->name }}</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span>Lokasi</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span class="fw-bold">{{ $booking->package->location }}</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span>Tanggal Mulai</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span class="fw-bold">{{ date('d/m/Y', strtotime($booking->start_date)) }}</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span>Tanggal Selesai</span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <span class="fw-bold">{{ date('d/m/Y', strtotime($booking->end_date)) }}</span>
                                    </div>
                                    @if ($booking->transactions && $booking->transactions->isNotEmpty())
                                        @if ($booking->transactions->first()->photo_evidence != null)
                                            <div class="col-6 mb-2">
                                                <span>Tanggal Divalidasi</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <span class="fw-bold">{{ date('d/m/Y', strtotime($booking->transactions->first()->updated_at)) }}</span>
                                            </div>
                                        @endif
                                        <div class="col-6 mb-2">
                                            <span>Bank</span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="fw-bold">{{ $booking->transactions->first()->name_bank }}</span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span>Total</span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="fw-bold">Rp {{ number_format($booking->transactions->first()->total, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            @if ($booking->transactions->first()->photo_evidence != null)
                                                <td class="{{ $booking->transactions->first()->status == 'success' ? 'text-success' : ($booking->transactions->first()->status == 'failed' ? 'text-danger' : 'text-muted') }}">
                                                    {{ strtoupper($booking->transactions->first()->status) }}
                                                </td>
                                            @else
                                                <td class="text-muted">Belum Upload Bukti Pembayaran</td>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Detail End -->
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    // show dialog success
    @if (Session::has('success'))
        swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "{{ Session::get('success') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
        @endif
</script>
@endsection
