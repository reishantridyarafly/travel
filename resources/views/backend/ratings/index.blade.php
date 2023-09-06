@extends('layouts.backend.main')

@section('title', 'Rata-rata Ratings Indikator')

@section('content')
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">Rata-rata Ratings Indikator</h5>

                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item text-capitalize"><a href="#">Ratings</a></li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">Rata-rata Indikator</li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="table-responsive shadow rounded">
                        <div class="card-body">
                            <table class="table table-center bg-white mb-0" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center border-bottom p-3">Indikator</th>
                                        <th class="border-bottom p-3">Rata-rata Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($averageIndikatorRatings as $averageRating)
                                        <tr>
                                            <td>{{ $averageRating->indikator->name }}</td>
                                            <td>
                                                @php
                                                    $averageRating = number_format($averageRating->average_rating, 2);
                                                    $starCount = floor($averageRating);
                                                    $remainingStars = 5 - $starCount;
                                                @endphp

                                                @for ($i = 1; $i <= $starCount; $i++)
                                                    <i class="fa fa-star text-warning"></i>
                                                @endfor

                                                @if ($remainingStars > 0)
                                                    @for ($i = 1; $i <= $remainingStars; $i++)
                                                        <i class="fa fa-star-o text-secondary"></i>
                                                    @endfor
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="table-responsive shadow rounded">
                        <div class="card-body">
                            <table class="table table-center bg-white mb-0" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center border-bottom p-3">Subindikator</th>
                                        <th class="border-bottom p-3">Rata-rata Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($averageSubindikatorRatings as $averageRating)
                                        <tr>
                                            <td>{{ $averageRating->subindikator->name }}</td>
                                            <td>
                                                @php
                                                    $averageRating = number_format($averageRating->average_rating, 2);
                                                    $starCount = floor($averageRating);
                                                    $remainingStars = 5 - $starCount;
                                                @endphp

                                                @for ($i = 1; $i <= $starCount; $i++)
                                                    <i class="fa fa-star text-warning"></i>
                                                @endfor

                                                @if ($remainingStars > 0)
                                                    @for ($i = 1; $i <= $remainingStars; $i++)
                                                        <i class="fa fa-star-o text-secondary"></i>
                                                    @endfor
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end container-->
@endsection
