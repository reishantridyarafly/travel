<!-- Footer Start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-py-60">
                    <div class="row">
                        <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                            <h5 class="footer-head">Tentang Kami</h5>
                            <p class="mt-4">Start working with Landrick that can provide everything you need to generate awareness, drive traffic, connect.</p>
                            <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                                <li class="list-inline-item"><a href="https://www.instagram.com/langkuy_project/" target="_blank" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                            </ul><!--end icon-->
                        </div><!--end col-->

                        <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Perusahaan</h5>
                            <ul class="list-unstyled footer-list mt-4">
                                <li><a href="{{ url('/') }}#about" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Tentang</a></li>
                                <li><a href="{{ url('/') }}#package" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Paket</a></li>
                                <li><a href="{{ route('booking_langkuy') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Booking</a></li>
                            </ul>
                        </div><!--end col-->

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Paket Terbaru</h5>
                            @php
                                use App\Models\Package;

                                $packages = Package::orderBy('created_at', 'desc')->take(5)->get();
                            @endphp
                            <ul class="list-unstyled footer-list mt-4">
                                @foreach ($packages as $package)
                                <li><a href="{{ route('detail', $package->slug) }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> {{ $package->name }}</a></li>
                                @endforeach
                            </ul>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="footer-py-30 footer-bar">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="text-sm-start">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> CV Langkuy.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </div>
</footer><!--end footer-->
<!-- Footer End -->
