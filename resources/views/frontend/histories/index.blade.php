@extends('layouts.frontend.main')

@section('css')
<!-- Sweat Alert -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 d-table w-100" style="background: url('{{ asset('default') }}/1.jpg') center center;">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title text-white mb-0"> Riwayat Booking </h4>
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
                                        @if ($booking->transactions->first()->photo_evidence == null && $booking->transactions->first()->status == 'pending')
                                            <td class="text-muted">Belum Upload Bukti Pembayaran</td>
                                        @else
                                            <td class="{{ $booking->transactions->first()->status == 'success' ? 'text-success'
                                            : ($booking->transactions->first()->status == 'failed' ? 'text-danger'
                                            : ($booking->transactions->first()->status == 'cancel' ? 'text-danger' : 'text-muted')) }}">
                                                {{ strtoupper($booking->transactions->first()->status) }}
                                            </td>
                                        @endif
                                    @endif
                                    <td>
                                        @if ($booking->transactions && $booking->transactions->isNotEmpty())
                                            @if ($booking->transactions->first()->photo_evidence == null && $booking->transactions->first()->status == 'pending')
                                                <a href="{{ route('payment_detail', $booking->id) }}" class="btn btn-primary btn-sm mb-2">Upload Bukti</a><br>
                                                <form action="{{ route('booking.cancel', $booking->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2">Batalkan</button><br>
                                                </form>
                                            @elseif ($booking->transactions->first()->photo_evidence != null && $booking->transactions->first()->status == 'pending')
                                                <form action="{{ route('booking.cancel', $booking->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2">Batalkan</button><br>
                                                </form>
                                            @elseif ($booking->transactions->first()->status == 'success')
                                                @if ($booking->ratings()->count() < 15)
                                                    <a href="" class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#question1{{ $booking->id }}">Tanggapan</a><br>
                                                @endif
                                            @endif
                                        @endif
                                        <a href="javascript:void(0)" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail{{ $booking->id }}">Detail</a>
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
@if ($bookings->count() > 0)
@foreach ($bookings as $booking)
<div class="modal fade" id="detail{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Data Booking</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-15 text-dark"></i></button>
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
                                        @if ($booking->transactions->first()->status == 'success')
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
<!-- Modal Question 1 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question1{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">1. Ketersediaan fasilitas dan informasi yang diberikan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 1)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 1)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 1)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 1)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 1)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 1 End -->
<!-- Modal Question 2 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question2{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">2. Penampilan Crew Langkuy yang bersih dan rapih</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 2)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 2)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 2)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 2)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 2)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 2 End -->
<!-- Modal Question 3 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question3{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">3. Perlengkapan dalam memudahkan pelayanan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 3)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 3)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 3)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 3)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 3)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 3 End -->
<!-- Modal Question 4 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question4{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">4. Kemudahan prosedur dalam memberikan pelayanan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 4)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 4)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 4)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 4)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 4)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 4 End -->
<!-- Modal Question 5 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question5{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">5. Kemudahan memberikan informasi kepada pelanggan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 5)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 5)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 5)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 5)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 5)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 5 End -->
<!-- Modal Question 6 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question6{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">6. Crew Langkuy bekerja dengan baik dan memebuhi kebutuhan pelanggan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 6)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 6)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 6)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 6)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 6)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 6 End -->
<!-- Modal Question 7 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question7{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">7. Ketepatan waku dan kedisplinan Crew Langkuy</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 7)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 7)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 7)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 7)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 7)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 7 End -->
<!-- Modal Question 8 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question8{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">8. Rasa tanggungjawab atas pekerjaan Crew Langkuy</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 8)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 8)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 8)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 8)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 8)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 8 End -->
<!-- Modal Question 9 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question9{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">9. Kesediaan Crew Langkuy untuk membantu pelanggan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 9)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 9)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 9)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 9)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 9)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 9 End -->
<!-- Modal Question 10 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question10{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">10. Kesopanan keramahan serta komunikasi yang baik dalam memberikan pelayanan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 10)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 10)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 10)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 10)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 10)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 10 End -->
<!-- Modal Question 11 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question11{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">11. Kejaminan fasilitas yang diberikan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 11)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 11)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 11)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 11)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 11)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 11 End -->
<!-- Modal Question 12 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question12{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">12. Crew Langkuy memiliki pengetahuan luas tentang destinasi wisata</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 12)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 12)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 12)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 12)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 12)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 12 End -->
<!-- Modal Question 13 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question13{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">13. Keramahan Crew Langkuy terhadap pelanggan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 13)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 13)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 13)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 13)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 13)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 13 End -->
<!-- Modal Question 14 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question14{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">14. Ketersediaan waktu Crew Langkuy dalam mendengan keluhan pelanggan</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 14)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 14)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 14)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 14)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 14)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Question 14 End -->
<!-- Modal Question 15 -->
@foreach ($bookings as $booking)
<div class="modal fade" id="question15{{ $booking->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Tanggapan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <input type="hidden" id="package_id" value="{{ $booking->package_id }}">
                            <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                            <h6 class="fw-bold">15. Crew Langkuy dapat berkomunikasi dengan baik</h6>
                            <p class="text-muted small m-0">Penilaian :</p>
                            <p class="text-muted small m-0">Bintang 1 : Sangat tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 2 : Tidak setuju</p>
                            <p class="text-muted small m-0">Bintang 3 : Biasa saja/netral</p>
                            <p class="text-muted small m-0">Bintang 4 : Setuju</p>
                            <p class="text-muted small m-0">Bintang 5 : Sangat setuju</p>

                            <div class="mt-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, 15)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, 15)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, 15)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, 15)"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, 15)"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-next">Lanjut</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
<!-- Modal Question 15 End -->
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

    let currentRating = 0;
    let currentQuestion = 1;
    const totalQuestions = 15;
    const bookingId = document.getElementById('booking_id').value;

    function setRating(rating, questionNumber) {
        const stars = document.querySelectorAll(`#question${questionNumber}${bookingId} .icon-large`);

        // Highlight the selected stars
        for (let i = 0; i < rating; i++) {
            stars[i].classList.remove("text-muted");
            stars[i].classList.add("text-warning");
        }

        // Dim the stars after the selected ones
        for (let i = rating; i < stars.length; i++) {
            stars[i].classList.remove("text-warning");
            stars[i].classList.add("text-muted");
        }

        // Update the current rating
        currentRating = rating;
    }

    function resetRating() {
        const stars = document.querySelectorAll(".icon-large");
        for (let i = 0; i < stars.length; i++) {
            if (i < currentRating) {
                stars[i].classList.remove("text-muted");
                stars[i].classList.add("text-warning");
            } else {
                stars[i].classList.remove("text-warning");
                stars[i].classList.add("text-muted");
            }
        }
        currentRating = 0;
    }

    function saveRatingAndNext() {
        var bookingId = $('#booking_id').val();
        var packageId = $('#package_id').val();

        if (currentRating !== 0) {

            // Assuming you have an AJAX call to save the rating for the current question
            $.ajax({
                url: 'rating',
                type: 'POST',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    booking_id: bookingId,
                    package_id: packageId,
                    question: 'Pertanyaan ' + currentQuestion,
                    rating: currentRating,
                },
                success: function(response) {
                    // Update the current question number
                    currentQuestion++;
                    if (currentQuestion <= totalQuestions) {
                        // Hide the current question modal
                        $(`#question${currentQuestion - 1}${bookingId}`).modal('hide');

                        // Show the next question modal
                        $(`#question${currentQuestion}${bookingId}`).modal('show');
                    } else {
                        // If all questions are answered, show SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Terima kasih atas tanggapan dan penilaiannya!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error saving rating:', error);
                    console.log('Status:', xhr.status);
                    console.log('Status Text:', xhr.statusText);
                    console.log('Response Text:', xhr.responseText);
                }
            });
        } else {
            alert('Bintang harus dipilih');
        }
    }

    // Handle modal 'hidden' event to reset the rating when modal is closed
    $('.modal').on('hidden.bs.modal', function () {
        resetRating();
    });

    // Handle "Lanjut" button click
    $(document).on('click', '.btn-next', function() {
        saveRatingAndNext();
    });

    // Show only the "Batal" button in the first modal, hide "Batal" in others
    $(document).on('show.bs.modal', function(event) {
        // Check if event.relatedTarget exists before accessing its attributes
        if (event.relatedTarget) {
            const modalId = event.relatedTarget.getAttribute('data-bs-target');
            const bookingId = document.getElementById('booking_id').value;

            // Use bookingId instead of $booking->id
            const isFirstModal = modalId === `#question1${bookingId}`;
            $('.btn-cancel').toggle(isFirstModal);
        }
    });
</script>
@endsection
