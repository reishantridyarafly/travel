@extends('layouts.frontend.main')

@section('content')
    <section class="bg-half-170 d-table w-100" style="background: url('{{ asset('default') }}/1.jpg') center center;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="pages-heading">
                        <h3 class="title text-white title-dark mb-0">Detail Paket</h3>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Paket</li>
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

    <section class="section">
        <div class="container">
            <div class="row">
                <!-- BLog Start -->
                <div class="col-lg-8 col-md-6">
                    <div class="card border-0 shadow rounded overflow-hidden">
                        @if ($package->images->count() > 0)
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @php $activeIndex = 0; @endphp
                                    @foreach ($package->images as $image)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $activeIndex }}"
                                            @if ($activeIndex === 0) class="active" aria-current="true" @endif
                                            aria-label="Slide {{ $activeIndex + 1 }}"></button>
                                        @php $activeIndex++; @endphp
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @php $activeIndex = 0; @endphp
                                    @foreach ($package->images as $image)
                                        <div class="carousel-item @if ($activeIndex === 0) active @endif">
                                            <img src="{{ asset('storage/packages/' . $image->path) }}" class="d-block w-100"
                                                alt="image">
                                        </div>
                                        @php $activeIndex++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="text-center">
                                <span class="badge bg-primary">Paket</span>
                                <h4 class="mt-3">{{ $package->name }}</h4>

                                <ul class="list-unstyled mt-3">
                                    <li class="list-inline-item text-muted me-2"><i
                                            class="uil uil-map-marker me-1"></i>{{ $package->location }}</li>
                                    <li class="list-inline-item text-muted"><i class="uil uil-calender me-1"></i>Durasi
                                        {{ $package->duration }} Hari</li>
                                </ul>
                            </div>

                            <div class="text-muted">
                                {!! $package->description !!}
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <a href="{{ route('booking_langkuy', ['id' => $package->id]) }}" class="btn btn-primary">Booking</a>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!-- BLog End -->

                <!-- START SIDEBAR -->
                <div class="col-lg-4 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card border-0 sidebar sticky-bar ms-lg-4">
                        <div class="card-body p-0">
                            <!-- TAG BENEFIT -->
                            <div class="widget mt-4">
                                <span class="bg-light d-block py-2 rounded shadow text-center h6 mb-0">
                                    Benefit
                                </span>

                                <div class="tagcloud text-center mt-4">
                                    @foreach ($package->benefits as $benefit)
                                        <a href="jvascript:void(0)" class="rounded">{{ $benefit->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- TAG BENEFIT -->
                        </div>
                    </div>
                </div>
                <!--end col-->
                <!-- END SIDEBAR -->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
@endsection
