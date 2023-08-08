@extends('layouts.backend.main')

@section('title', 'Rating')

@section('content')
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ratings</h5>

                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item text-capitalize"><a href="#">Ratings</a></li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">list</li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="d-grid gap-2 d-md-flex">
                        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3 btn-sm">
                            Tambah Data +
                        </a>
                    </div>
                    <div class="table-responsive shadow rounded">
                        <div class="card-body">
                            <table class="table table-center bg-white mb-0" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center border-bottom p-3">No</th>
                                        <th class="border-bottom p-3">Indikator</th>
                                        <th class="border-bottom p-3">Hasil</th>
                                        <th class="border-bottom p-3">Pertanyaan</th>
                                        <th class="border-bottom p-3">Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
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

@section('javascript')
    <!-- Datatables -->
    <script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
@endsection
