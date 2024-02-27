<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pending = Transaction::where('status', 'pending')->count();
        $success = Transaction::where('status', 'success')->count();
        $failed = Transaction::whereIn('status', ['failed', 'expired', 'cancel'])->count();
        $package = Package::count();
        $customer = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', '=', 'admin')->orWhere('name', '=', 'owner');
        })->count();

        $tangibles = Rating::with(['user', 'indikator', 'subindikator'])
            ->where('indikator_id', 1) // Filter hanya yang memiliki indikator_id = 1
            ->orderBy('created_at', 'asc')
            ->get();

        // Menghitung rata-rata rating
        $totalTangibles = $tangibles->count();
        $sumOfTangibles = $tangibles->sum('rating');

        if ($totalTangibles > 0) {
            $averageTangibles = $sumOfTangibles / $totalTangibles;
        } else {
            $averageTangibles = 0; // Jika tidak ada rating yang ditemukan
        }

        $reliability = Rating::with(['user', 'indikator', 'subindikator'])
            ->where('indikator_id', 2)
            ->orderBy('created_at', 'asc')
            ->get();

        // Menghitung rata-rata rating
        $totalReliability = $reliability->count();
        $sumOfReliability = $reliability->sum('rating');

        if ($totalReliability > 0) {
            $averageReliability = $sumOfReliability / $totalReliability;
        } else {
            $averageReliability = 0; // Jika tidak ada rating yang ditemukan
        }

        $responsive = Rating::with(['user', 'indikator', 'subindikator'])
            ->where('indikator_id', 3)
            ->orderBy('created_at', 'asc')
            ->get();

        // Menghitung rata-rata rating
        $totalResponsive = $responsive->count();
        $sumOfResponsive = $responsive->sum('rating');

        if ($totalResponsive > 0) {
            $averageResponsive = $sumOfResponsive / $totalResponsive;
        } else {
            $averageResponsive = 0; // Jika tidak ada rating yang ditemukan
        }

        $assurance = Rating::with(['user', 'indikator', 'subindikator'])
            ->where('indikator_id', 4)
            ->orderBy('created_at', 'asc')
            ->get();

        // Menghitung rata-rata rating
        $totalAssurance = $assurance->count();
        $sumOfAssurance = $assurance->sum('rating');

        if ($totalAssurance > 0) {
            $averageAssurance = $sumOfAssurance / $totalAssurance;
        } else {
            $averageAssurance = 0; // Jika tidak ada rating yang ditemukan
        }

        $emphaty = Rating::with(['user', 'indikator', 'subindikator'])
            ->where('indikator_id', 5)
            ->orderBy('created_at', 'asc')
            ->get();

        // Menghitung rata-rata rating
        $totalEmphaty = $emphaty->count();
        $sumOfEmphaty = $emphaty->sum('rating');

        if ($totalEmphaty > 0) {
            $averageEmphaty = $sumOfEmphaty / $totalEmphaty;
        } else {
            $averageEmphaty = 0; // Jika tidak ada rating yang ditemukan
        }

        $ratingsPerYearByIndikator = Rating::selectRaw('YEAR(created_at) as year, indikator_id, AVG(rating) as average_rating')
            ->where('indikator_id', '<>', '006')
            ->whereRaw('YEAR(created_at) >= YEAR(CURDATE()) - 4')
            ->groupBy('year', 'indikator_id')
            ->get();
            

        return view('backend.dashboard.index', compact(
            'pending',
            'success',
            'failed',
            'package',
            'customer',
            'averageTangibles',
            'averageReliability',
            'averageResponsive',
            'averageAssurance',
            'averageEmphaty',
            'ratingsPerYearByIndikator'
        ));
    }
}
