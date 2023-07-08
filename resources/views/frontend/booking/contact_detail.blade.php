@extends('layouts.frontend.main')

@section('content')
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Booking </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('booking') }}">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kontak Detail</li>
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
                    <div class="card-header"><i class="uil uil-user"></i> Data Detail</div>
                    <div class="card-body">
                        <div class="custom-form">
                            <form action="{{ route('save_contact_details') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">No. Identitas <span class="text-danger">*</span></label>
                                            <input name="no_identity" id="no_identity" type="number" class="form-control @error('no_identity') is-invalid @enderror" value="{{ old('no_identity') }}" placeholder="No. Identitas :">
                                            <small class="text-muted">*Sesuai KTP/Paspor/SIM</small>
                                            @error('no_identity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input name="fullname" id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}" placeholder="Nama Lengkap :">
                                            @error('fullname')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tipe Identitas <span class="text-danger">*</span></label>
                                            <select name="type_identity" id="type_identity" class="form-control @error('type_identity') is-invalid @enderror">
                                                <option value="">Pilih Tipe Identitas</option>
                                                <option value="KTP" {{ old('type_identity') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                                <option value="Paspor" {{ old('type_identity') == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                                                <option value="SIM" {{ old('type_identity') == 'SIM' ? 'selected' : '' }}>SIM</option>
                                            </select>
                                            @error('type_identity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Upload Identitas <span class="text-danger">*</span></label>
                                            <input name="upload_identity" id="upload_identity" type="file" class="form-control @error('upload_identity') is-invalid @enderror">
                                            <small class="text-muted">Ukuran file tidak boleh lebih dari 2MB.</small>
                                            @error('upload_identity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input name="birth_date" id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                                            @error('birth_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                            <input name="telephone" id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}" placeholder="No. Telepon :">
                                            @error('telephone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email :">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Lanjut</button>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
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
                                <table class="table mb-0 table-center">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ asset('storage/packages/' . $booking->package->image) }}" width="50px" alt="paket"></td>
                                            <td class="fw-bold">{{ $booking->package->name }}</td>
                                        </tr>
                                        <tr>
                                            <td width="10%">Tanggal Mulai</td>
                                            <td>{{ date('d/m/Y', strtotime($booking->start_date))}}</td>
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
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end custom-form-->
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
<!-- End -->
@endsection
