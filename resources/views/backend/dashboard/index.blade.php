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
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-receipt fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Data Booking Pending</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $pending }}"></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-receipt fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Data Booking Sukses</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $success }}"></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-receipt fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Data Booking Gagal</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $failed }}"></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-package fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Data Paket</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $package }}"></span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-users-alt fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pelanggan</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $customer }}"></span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Ketersediaan fasilitas dan informasi yang diberikan</h6>
                    </div>
                    <div id="rating1" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Penampilan Crew Langkuy yang bersih dan rapih</h6>
                    </div>
                    <div id="rating2" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Perlengkapan dalam memudahkan pelayanan</h6>
                    </div>
                    <div id="rating3" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Kemudahan prosedur dalam memberikan pelayanan</h6>
                    </div>
                    <div id="rating4" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Kemudahan memberikan informasi kepada pelanggan</h6>
                    </div>
                    <div id="rating5" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Crew Langkuy bekerja dengan baik dan memebuhi kebutuhan pelanggan</h6>
                    </div>
                    <div id="rating6" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Ketepatan waku dan kedisplinan Crew Langkuy</h6>
                    </div>
                    <div id="rating7" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Rasa tanggungjawab atas pekerjaan Crew Langkuy</h6>
                    </div>
                    <div id="rating8" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Kesediaan Crew Langkuy untuk membantu pelanggan</h6>
                    </div>
                    <div id="rating9" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Kesopanan keramahan serta komunikasi yang baik dalam memberikan pelayanan</h6>
                    </div>
                    <div id="rating10" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Kejaminan fasilitas yang diberikan</h6>
                    </div>
                    <div id="rating11" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Crew Langkuy memiliki pengetahuan luas tentang destinasi wisata</h6>
                    </div>
                    <div id="rating12" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Keramahan Crew Langkuy terhadap pelanggan</h6>
                    </div>
                    <div id="rating13" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Ketersediaan waktu Crew Langkuy dalam mendengan keluhan pelanggan</h6>
                    </div>
                    <div id="rating14" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2 fw-bold">Crew Langkuy dapat berkomunikasi dengan baik</h6>
                    </div>
                    <div id="rating15" class="apex-chart"></div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/apexcharts/apexcharts.min.js"></script>
<script>
    // question 1
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings1[1] }}, {{ $starRatings1[2] }}, {{ $starRatings1[3] }}, {{ $starRatings1[4] }}, {{ $starRatings1[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating1"), options);

    chart.render();

    // question 2
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings2[1] }}, {{ $starRatings2[2] }}, {{ $starRatings2[3] }}, {{ $starRatings2[4] }}, {{ $starRatings2[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating2"), options);

    chart.render();

    // question 3
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings3[1] }}, {{ $starRatings3[2] }}, {{ $starRatings3[3] }}, {{ $starRatings3[4] }}, {{ $starRatings3[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating3"), options);

    chart.render();

    // question 4
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings4[1] }}, {{ $starRatings4[2] }}, {{ $starRatings4[3] }}, {{ $starRatings4[4] }}, {{ $starRatings4[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating4"), options);

    chart.render();

    // question 5
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings5[1] }}, {{ $starRatings5[2] }}, {{ $starRatings5[3] }}, {{ $starRatings5[4] }}, {{ $starRatings5[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating5"), options);

    chart.render();

    // question 6
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings6[1] }}, {{ $starRatings6[2] }}, {{ $starRatings6[3] }}, {{ $starRatings6[4] }}, {{ $starRatings6[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating6"), options);

    chart.render();

    // question 7
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings7[1] }}, {{ $starRatings7[2] }}, {{ $starRatings7[3] }}, {{ $starRatings7[4] }}, {{ $starRatings7[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating7"), options);

    chart.render();

    // question 8
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings8[1] }}, {{ $starRatings8[2] }}, {{ $starRatings8[3] }}, {{ $starRatings8[4] }}, {{ $starRatings8[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating8"), options);

    chart.render();

    // question 9
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings9[1] }}, {{ $starRatings9[2] }}, {{ $starRatings9[3] }}, {{ $starRatings9[4] }}, {{ $starRatings9[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating9"), options);

    chart.render();

    // question 10
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings10[1] }}, {{ $starRatings10[2] }}, {{ $starRatings10[3] }}, {{ $starRatings10[4] }}, {{ $starRatings10[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating10"), options);

    chart.render();

    // question 11
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings11[1] }}, {{ $starRatings11[2] }}, {{ $starRatings11[3] }}, {{ $starRatings11[4] }}, {{ $starRatings11[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating11"), options);

    chart.render();

    // question 12
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings12[1] }}, {{ $starRatings12[2] }}, {{ $starRatings12[3] }}, {{ $starRatings12[4] }}, {{ $starRatings12[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating12"), options);

    chart.render();

    // question 13
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings13[1] }}, {{ $starRatings13[2] }}, {{ $starRatings13[3] }}, {{ $starRatings13[4] }}, {{ $starRatings13[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating13"), options);

    chart.render();

    // question 14
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings14[1] }}, {{ $starRatings14[2] }}, {{ $starRatings14[3] }}, {{ $starRatings14[4] }}, {{ $starRatings14[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating14"), options);

    chart.render();

    // question 15
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Rating',
            data: [{{ $starRatings15[1] }}, {{ $starRatings15[2] }}, {{ $starRatings15[3] }}, {{ $starRatings15[4] }}, {{ $starRatings15[5] }}]
        }],
        xaxis: {
            categories: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5']
        }
    };

    var chart = new ApexCharts(document.querySelector("#rating15"), options);

    chart.render();
</script>
@endsection
