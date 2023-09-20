@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1">Selamat Datang, {{ Auth::user()->first_name }}!</h6>
                    <h5 class="mb-0">Dashboard</h5>
                </div>
            </div>

            <div class="row row-cols-xl-3 row-cols-md-2 row-cols-1">
                <div class="col mt-4">
                    <a href="#!"
                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-receipt fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Data Booking Pending</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                        data-target="{{ $pending }}"></p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->

                <div class="col mt-4">
                    <a href="#!"
                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-receipt fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Data Booking Sukses</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                        data-target="{{ $success }}"></p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->

                <div class="col mt-4">
                    <a href="#!"
                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-receipt fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Data Booking Gagal</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                        data-target="{{ $failed }}"></p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->

                <div class="col mt-4">
                    <a href="#!"
                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-package fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Data Paket</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                        data-target="{{ $package }}"></span></p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->

                <div class="col mt-4">
                    <a href="#!"
                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-users-alt fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Pelanggan</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                        data-target="{{ $customer }}"></span></p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-xl-12 col-lg-7 mt-4">
                    <div class="card shadow border-0 p-4 pb-0 rounded">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2 fw-bold">Informasi Indikator</h6>
                        </div>
                        <div id="indikator_chart" class="apex-chart"></div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-xl-12 col-lg-7 mt-4">
                    <div class="card shadow border-0 p-4 pb-0 rounded">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2 fw-bold">Informasi Puas & Tidak Puas</h6>
                        </div>
                        <div id="puas_chart" class="apex-chart"></div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('backend') }}/libs/apexcharts/apexcharts.min.js"></script>
    <script>
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'indikator',
            data: [{{ number_format($averageTangibles, 2) }},
                {{ number_format($averageReliability, 2) }},
                {{ number_format($averageResponsive, 2) }},
                {{ number_format($averageAssurance, 2) }},
                {{ number_format($averageEmphaty, 2) }}
            ]
        }],
        xaxis: {
            categories: ["Tangibles", "Reliability", "Responsive", "Assurance", "Empathy"]
        }
    }

    var indikator_chart = new ApexCharts(document.querySelector("#indikator_chart"), options);

    indikator_chart.render();

    // Check if $jumlahBooking has elements before accessing them
    var jumlahPuas = 0;
    var jumlahTidakPuas = 0;

    @if(!empty($jumlahBooking) && count($jumlahBooking) > 0)
        jumlahPuas = {{ $jumlahBooking[0]->jumlah_puas }};
        jumlahTidakPuas = {{ $jumlahBooking[0]->jumlah_tidak_puas }};
    @endif

    var options2 = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'puas',
            data: [jumlahPuas, jumlahTidakPuas]
        }],
        xaxis: {
            categories: ["Puas", "Tidak Puas"]
        }
    }

    var puas_chart = new ApexCharts(document.querySelector("#puas_chart"), options2);

    puas_chart.render();
</script>


@endsection
