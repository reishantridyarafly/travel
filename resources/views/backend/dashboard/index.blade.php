@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1">Selamat Datang, {{ Auth::user()->name }}!</h6>
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
                        <div class="col-3">
                            <table class="table">
                                <tr>
                                    <th>Tangibles</th>
                                    <td>:</td>
                                    <td>
                                        @php
                                            $hasilTangiblesText = '';
                                            if ($averageTangibles >= 4.1) {
                                                $hasilTangiblesText = 'Sangat Puas';
                                            } elseif ($averageTangibles >= 3.1) {
                                                $hasilTangiblesText = 'Puas';
                                            } elseif ($averageTangibles >= 2.1) {
                                                $hasilTangiblesText = 'Biasa saja/Netral';
                                            } elseif ($averageTangibles <= 2) {
                                                $hasilTangiblesText = 'Tidak Puas';
                                            } else {
                                                $hasilTangiblesText = 'Sangat Tidak Puas';
                                            }
                                        @endphp
                                        {{ $hasilTangiblesText }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Reliability</th>
                                    <td>:</td>
                                    <td>
                                        @php
                                            $hasilReliabilityText = '';
                                            if ($averageReliability >= 4.1) {
                                                $hasilReliabilityText = 'Sangat Puas';
                                            } elseif ($averageReliability >= 3.1) {
                                                $hasilReliabilityText = 'Puas';
                                            } elseif ($averageReliability >= 2.1) {
                                                $hasilReliabilityText = 'Biasa saja/Netral';
                                            } elseif ($averageReliability <= 2) {
                                                $hasilReliabilityText = 'Tidak Puas';
                                            } else {
                                                $hasilReliabilityText = 'Sangat Tidak Puas';
                                            }
                                        @endphp
                                        {{ $hasilReliabilityText }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Responsive</th>
                                    <td>:</td>
                                    <td>
                                        @php
                                            $hasilResponsiveText = '';
                                            if ($averageResponsive >= 4.1) {
                                                $hasilResponsiveText = 'Sangat Puas';
                                            } elseif ($averageResponsive >= 3.1) {
                                                $hasilResponsiveText = 'Puas';
                                            } elseif ($averageResponsive >= 2.1) {
                                                $hasilResponsiveText = 'Biasa saja/Netral';
                                            } elseif ($averageResponsive <= 2) {
                                                $hasilResponsiveText = 'Tidak Puas';
                                            } else {
                                                $hasilResponsiveText = 'Sangat Tidak Puas';
                                            }
                                        @endphp
                                        {{ $hasilResponsiveText }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Assurance</th>
                                    <td>:</td>
                                    <td>
                                        @php
                                            $hasilAssuranceText = '';
                                            if ($averageAssurance >= 4.1) {
                                                $hasilAssuranceText = 'Sangat Puas';
                                            } elseif ($averageAssurance >= 3.1) {
                                                $hasilAssuranceText = 'Puas';
                                            } elseif ($averageAssurance >= 2.1) {
                                                $hasilAssuranceText = 'Biasa saja/Netral';
                                            } elseif ($averageAssurance <= 2) {
                                                $hasilAssuranceText = 'Tidak Puas';
                                            } else {
                                                $hasilAssuranceText = 'Sangat Tidak Puas';
                                            }
                                        @endphp
                                        {{ $hasilAssuranceText }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Emphaty</th>
                                    <td>:</td>
                                    <td>
                                        @php
                                            $hasilEmphatyText = '';
                                            if ($averageEmphaty >= 4.1) {
                                                $hasilEmphatyText = 'Sangat Puas';
                                            } elseif ($averageEmphaty >= 3.1) {
                                                $hasilEmphatyText = 'Puas';
                                            } elseif ($averageEmphaty >= 2.1) {
                                                $hasilEmphatyText = 'Biasa saja/Netral';
                                            } elseif ($averageEmphaty <= 2) {
                                                $hasilEmphatyText = 'Tidak Puas';
                                            } else {
                                                $hasilEmphatyText = 'Sangat Tidak Puas';
                                            }
                                        @endphp
                                        {{ $hasilEmphatyText }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
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

        @if (!empty($jumlahBooking) && count($jumlahBooking) > 0)
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
