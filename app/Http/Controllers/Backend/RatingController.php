<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index()
    {
        // Mengambil rata-rata rating indikator dengan mengelompokkannya berdasarkan indikator_id
        $averageIndikatorRatings = Rating::with('indikator')
            ->where('indikator_id', '<>', '006') // Menghindari indikator_id '006'
            ->select('indikator_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('indikator_id')
            ->get();

        // Mengambil rata-rata rating subindikator dengan mengelompokkannya berdasarkan subindikator_id
        $averageSubindikatorRatings = Rating::with('subindikator')
            ->where('subindikator_id', '<>', '016') // Menghindari subindikator_id '016'
            ->select('subindikator_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('subindikator_id')
            ->get();

        $averageIndikatorRatingsBooking = Rating::with('indikator', 'booking')
            ->where('indikator_id', '<>', '006') // Menghindari indikator_id '006'
            ->select('booking_id', 'indikator_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('booking_id', 'indikator_id')
            ->get();

        // Mengirim data rata-rata ke tampilan (view) 'backend.ratings.index'
        return view('backend.ratings.index', compact('averageIndikatorRatings', 'averageSubindikatorRatings', 'averageIndikatorRatingsBooking'));
    }
}
