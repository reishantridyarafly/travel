@extends('layouts.frontend.main')

@section('content')
    <!-- Hero Start -->
    <section class="bg-half-260 d-table w-100" id="home">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-12">
                    <div class="title-heading text-center">
                        <h4 class="display-4 fw-bold text-white title-dark mb-3">Selamat Datang !</h4>
                        <p class="para-desc text-white-50 mb-0 mx-auto">Kami Solusi Perjalanan Anda</p>
                    </div>
                </div>
            </div><!--end row-->
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- Start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-11 col-12 text-center mt-sm-0 pt-sm-0">
                    <div class="text-center features-absolute">
                        <div class="tab-content bg-white rounded-top rounded-bottom shadow">
                            <div class="card border-0 tab-pane fade show active">
                                <form action="{{ route('search') }}" method="GET" class="card-body text-start">
                                    <div class="row">
                                        <div class="col-lg-10 col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Cari :</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="search" class="fea icon-sm icons"></i>
                                                    <input name="key" id="key" type="text"
                                                        class="form-control ps-5" placeholder="Cari :">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-2 col-md-6 col-12">
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary">Search now</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form><!--end form-->
                            </div><!--end teb pane-->
                        </div><!--end tab content-->
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        @if (!Request::routeIs('search'))
            <!-- About Start -->
            <div class="section" id="about">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="section-title mb-4 pb-2 text-center">
                                <h4 class="title mt-3 mb-4">Tentang Kami</h4>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5 mt-4 pt-2 mt-sm-0 pt-sm-0">
                            <div class="position-relative">
                                <img src="{{ asset('default') }}/1.jpg" class="rounded img-fluid mx-auto d-block"
                                    alt="about">
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-7 col-md-7 mt-4 pt-2 mt-sm-0 pt-sm-0">
                            <div class="section-title ms-lg-4">
                                <h4 class="title mb-4">CV Langkuy Project</h4>
                                <p class="text-muted">CV Langkuy Project</span> merupakan salah satu perusahaan yang
                                    bergerak dalam bidang jasa open trip atau yang bisa disebut Tour And Travel yang
                                    berlokasi di Kuningan. Dengan menawarkan berbagai destinasi wisata yang menarik.</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div><!--end section-->
            <!-- About End -->
        @endif

        <!-- Package Start -->
        <div class="section" id="package">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="section-title mb-4 pb-2 text-center">
                            <h4 class="title mt-3 mb-4">Paket</h4>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row align-items-center">
                    @foreach ($packages as $package)
                        <div class="col-lg-4">
                            <div class="card pricing pricing-primary border-0 shadow position-relative overflow-hidden m-2">
                                <div class="shop-image position-relative overflow-hidden shadow">
                                    <a href="{{ route('detail', $package->slug) }}">
                                        @if ($package->images->count() > 0)
                                            @foreach ($package->images as $image)
                                                <img src="{{ asset('storage/packages/' . $image->path) }}"
                                                    class="img-fluid" style="height: 400px; width: 350px;" alt="package">
                                            @break
                                        @endforeach
                                    @endif
                                </a>
                            </div>
                            <div class="card-body content p-4">
                                <a href="javascript:void(0)" class="text-dark product-name h6">{{ $package->name }}
                                    ({{ $package->kapasitas }} Pax)</a>
                                <ul class="list-unstyled text-muted mt-2 mb-0">
                                    <li class="list-inline-item me-2"><i
                                            class="uil uil-map-marker me-1"></i>{{ $package->location }}</li>
                                    <li class="list-inline-item"><i class="uil uil-calender me-1"></i>Durasi
                                        {{ $package->duration }} Hari</li>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-between mt-2 mb-2">
                                    <li class="list-inline-item"><b>Rp
                                            {{ number_format($package->price, 0, ',', '.') }}</b></li>
                                </ul>
                                <a href="{{ route('detail', $package->id) }}" class="btn btn-primary mt-4">Detail</a>
                            </div>
                        </div><!--end items-->
                    </div>
                @endforeach
            </div><!--end row-->
        </div><!--end container-->
    </div>
    <!-- Package End -->
</section>
<!-- End -->
@endsection

@section('javascript')
<script>
    easy_background("#home", {
        slide: ["{{ asset('default') }}/1.jpg", "{{ asset('default') }}/2.jpg",
            "{{ asset('default') }}/3.jpg"
        ],
        delay: [2000, 2000, 2000]
    });
</script>
@endsection
