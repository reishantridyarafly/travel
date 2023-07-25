@extends('layouts.backend.main')

@section('title', 'Ketersediaan fasilitas dan informasi yang diberikan')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
<!-- Sweat Alert -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Rasa tanggungjawab atas pekerjaan Crew Langkuy</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Rating</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">List</li>
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
                                    <th class="text-center border-bottom p-3">No</th>
                                    <th class="border-bottom p-3">Nama Paket</th>
                                    <th class="border-bottom p-3">Kode Booking</th>
                                    <th class="border-bottom p-3">Pelanggan</th>
                                    <th class="border-bottom p-3">Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @foreach($ratings as $rating)
                                    <tr>
                                        <th class="text-center p-3" style="width: 5%;">{{ $loop->iteration }}</th>
                                        <td class="p-3">{{ $rating->package->name }}</td>
                                        <td class="p-3">{{ $rating->booking_id }}</td>
                                        <td class="p-3">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</td>
                                        <td class="p-3">
                                            @php
                                                $ratingValue = 5;
                                                $currentRating = $rating->rating ?? 0;

                                                function getRatingClass($index, $currentRating) {
                                                    return $index <= $currentRating ? 'text-warning' : 'text-muted';
                                                }
                                            @endphp

                                            <ul class="list-unstyled mb-0">
                                                @for ($i = 1; $i <= $ratingValue; $i++)
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-star icon-large {{ getRatingClass($i, $currentRating) }}"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- End -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
<!-- Sweat Alert -->
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
    // show datatable with search and pagination
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endsection
