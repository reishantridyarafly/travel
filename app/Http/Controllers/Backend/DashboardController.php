<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
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
        $ratings = Rating::with(['user', 'indikator', 'subindikator'])
            ->orderBy('created_at', 'asc')
            ->get();
        $bookingGroups = $ratings->groupBy('booking_id');
        $totalBookings = $bookingGroups->count();

        $totalSatisfiedBookings = 0;
        $totalDissatisfiedBookings = 0;

        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            // Menghitung jumlah "Puas" dan "Tidak Puas" berdasarkan subindikator
            $satisfiedCount = $bookingRatings->where('subindikator.kode_subindikator', '016')
                ->where('rating', 2)
                ->count();
            $dissatisfiedCount = $bookingRatings->where('subindikator.kode_subindikator', '016')
                ->where('rating', 1)
                ->count();

            if ($satisfiedCount > $dissatisfiedCount) {
                $totalSatisfiedBookings += 1;
            } else {
                $totalDissatisfiedBookings += 1;
            }
        }

        $satisfiedCount = $totalSatisfiedBookings; // Jumlah pelanggan yang "Puas"
        $dissatisfiedCount = $totalDissatisfiedBookings; // Jumlah pelanggan yang "Tidak Puas"
        $totalBookings = $satisfiedCount + $dissatisfiedCount; // Total pelanggan

        $p_satisfied = $satisfiedCount / $totalBookings; // Probabilitas pelanggan "Puas"
        $p_dissatisfied = $dissatisfiedCount / $totalBookings; // Probabilitas pelanggan "Tidak Puas"

        $entropyTotal = (-$p_satisfied * log($p_satisfied, 2)) - ($p_dissatisfied * log($p_dissatisfied, 2));
        $initialEntropy = $entropyTotal;

        // Tangibles
        $categoryTangiblesCounts = [
            'sts' => 0,
            'ts' => 0,
            'n' => 0,
            's' => 0,
            'ss' => 0,
        ];
        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countTangibles = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['001', '003'])->count();
            $totalTangibles = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['001', '003'])->sum('rating');
            $averageTangibles = $countTangibles > 0 ? $totalTangibles / $countTangibles : 0;

            if ($averageTangibles >= 4.1) {
                $categoryTangiblesCounts['ss']++;
            } elseif ($averageTangibles >= 3.1) {
                $categoryTangiblesCounts['s']++;
            } elseif ($averageTangibles >= 2.1) {
                $categoryTangiblesCounts['n']++;
            } elseif ($averageTangibles <= 2) {
                $categoryTangiblesCounts['ts']++;
            } else {
                $categoryTangiblesCounts['sts']++;
            }
        }

        $categoryTangiblesSatisfactionCounts = [
            'sts' => ['puas' => 0, 'tidak_puas' => 0],
            'ts' => ['puas' => 0, 'tidak_puas' => 0],
            'n' => ['puas' => 0, 'tidak_puas' => 0],
            's' => ['puas' => 0, 'tidak_puas' => 0],
            'ss' => ['puas' => 0, 'tidak_puas' => 0],
        ];

        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countTangibles = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['001', '003'])->count();
            $totalTangibles = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['001', '003'])->sum('rating');
            $averageTangibles = $countTangibles > 0 ? $totalTangibles / $countTangibles : 0;

            $satisfaction = '';
            if ($averageTangibles >= 4.1) {
                $satisfaction = 'ss';
            } elseif ($averageTangibles >= 3.1) {
                $satisfaction = 's';
            } elseif ($averageTangibles >= 2.1) {
                $satisfaction = 'n';
            } elseif ($averageTangibles >= 1) {
                $satisfaction = 'ts';
            } else {
                $satisfaction = 'sts';
            }

            $booking = Booking::find($bookingId);
            $indikatorId = 6;
            $rating = $booking->ratings->where('indikator_id', $indikatorId)->first();

            if ($rating) {
                $satisfactionType = ($rating->rating == 2) ? 'puas' : 'tidak_puas';
                $categoryTangiblesSatisfactionCounts[$satisfaction][$satisfactionType]++;
            }
        }

        // Entropi Tangibles
        $entropyTangiblesSTS = $this->calculateEntropy($categoryTangiblesSatisfactionCounts['sts']['puas'], $categoryTangiblesSatisfactionCounts['sts']['tidak_puas']);
        $entropyTangiblesTS = $this->calculateEntropy($categoryTangiblesSatisfactionCounts['ts']['puas'], $categoryTangiblesSatisfactionCounts['ts']['tidak_puas']);
        $entropyTangiblesN = $this->calculateEntropy($categoryTangiblesSatisfactionCounts['n']['puas'], $categoryTangiblesSatisfactionCounts['n']['tidak_puas']);
        $entropyTangiblesS = $this->calculateEntropy($categoryTangiblesSatisfactionCounts['s']['puas'], $categoryTangiblesSatisfactionCounts['s']['tidak_puas']);
        $entropyTangiblesSS = $this->calculateEntropy($categoryTangiblesSatisfactionCounts['ss']['puas'], $categoryTangiblesSatisfactionCounts['ss']['tidak_puas']);

        // Hitung Entropi dari target variable (S)
        $entropyS = $initialEntropy;

        // Hitung Weighted Sum of Entropy(Attributes) untuk "Tangibles"
        $weightedEntropyTangibles = (
            ($categoryTangiblesCounts['sts'] / $totalBookings) * $entropyTangiblesSTS +
            ($categoryTangiblesCounts['ts'] / $totalBookings) * $entropyTangiblesTS +
            ($categoryTangiblesCounts['n'] / $totalBookings) * $entropyTangiblesN +
            ($categoryTangiblesCounts['s'] / $totalBookings) * $entropyTangiblesS +
            ($categoryTangiblesCounts['ss'] / $totalBookings) * $entropyTangiblesSS
        );

        // Hitung Information Gain untuk "Tangibles"
        $informationGainTangibles = $entropyS - $weightedEntropyTangibles;

        // Reliability
        $categoryReliabilityCounts = [
            'sts' => 0,
            'ts' => 0,
            'n' => 0,
            's' => 0,
            'ss' => 0,
        ];
        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countReliability = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['004', '006'])->count();
            $totalReliability = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['004', '006'])->sum('rating');
            $averageReliability = $countReliability > 0 ? $totalReliability / $countReliability : 0;

            if ($averageReliability >= 4.1) {
                $categoryReliabilityCounts['ss']++;
            } elseif ($averageReliability >= 3.1) {
                $categoryReliabilityCounts['s']++;
            } elseif ($averageReliability >= 2.1) {
                $categoryReliabilityCounts['n']++;
            } elseif ($averageReliability <= 2) {
                $categoryReliabilityCounts['ts']++;
            } else {
                $categoryReliabilityCounts['sts']++;
            }
        }

        $categoryReliabilitySatisfactionCounts = [
            'sts' => ['puas' => 0, 'tidak_puas' => 0],
            'ts' => ['puas' => 0, 'tidak_puas' => 0],
            'n' => ['puas' => 0, 'tidak_puas' => 0],
            's' => ['puas' => 0, 'tidak_puas' => 0],
            'ss' => ['puas' => 0, 'tidak_puas' => 0],
        ];

        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countReliability = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['004', '006'])->count();
            $totalReliability = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['004', '006'])->sum('rating');
            $averageReliability = $countReliability > 0 ? $totalReliability / $countReliability : 0;

            $satisfaction = '';
            if ($averageReliability >= 4.1) {
                $satisfaction = 'ss';
            } elseif ($averageReliability >= 3.1) {
                $satisfaction = 's';
            } elseif ($averageReliability >= 2.1) {
                $satisfaction = 'n';
            } elseif ($averageReliability >= 1) {
                $satisfaction = 'ts';
            } else {
                $satisfaction = 'sts';
            }

            $booking = Booking::find($bookingId);
            $indikatorId = 6;
            $rating = $booking->ratings->where('indikator_id', $indikatorId)->first();

            if ($rating) {
                $satisfactionType = ($rating->rating == 2) ? 'puas' : 'tidak_puas';
                $categoryReliabilitySatisfactionCounts[$satisfaction][$satisfactionType]++;
            }
        }

        // Entropi Reliability
        $entropyReliabilitySTS = $this->calculateEntropy($categoryReliabilitySatisfactionCounts['sts']['puas'], $categoryReliabilitySatisfactionCounts['sts']['tidak_puas']);
        $entropyReliabilityTS = $this->calculateEntropy($categoryReliabilitySatisfactionCounts['ts']['puas'], $categoryReliabilitySatisfactionCounts['ts']['tidak_puas']);
        $entropyReliabilityN = $this->calculateEntropy($categoryReliabilitySatisfactionCounts['n']['puas'], $categoryReliabilitySatisfactionCounts['n']['tidak_puas']);
        $entropyReliabilityS = $this->calculateEntropy($categoryReliabilitySatisfactionCounts['s']['puas'], $categoryReliabilitySatisfactionCounts['s']['tidak_puas']);
        $entropyReliabilitySS = $this->calculateEntropy($categoryReliabilitySatisfactionCounts['ss']['puas'], $categoryReliabilitySatisfactionCounts['ss']['tidak_puas']);

        // Hitung Entropi dari target variable (S)
        $entropyS = $initialEntropy;

        // Hitung Weighted Sum of Entropy(Attributes) untuk "Reliability"
        $weightedEntropyReliability = (
            ($categoryReliabilityCounts['sts'] / $totalBookings) * $entropyReliabilitySTS +
            ($categoryReliabilityCounts['ts'] / $totalBookings) * $entropyReliabilityTS +
            ($categoryReliabilityCounts['n'] / $totalBookings) * $entropyReliabilityN +
            ($categoryReliabilityCounts['s'] / $totalBookings) * $entropyReliabilityS +
            ($categoryReliabilityCounts['ss'] / $totalBookings) * $entropyReliabilitySS
        );

        // Hitung Information Gain untuk "Reliability"
        $informationGainReliability = $entropyS - $weightedEntropyReliability;

        // Responsive
        $categoryResponsiveCounts = [
            'sts' => 0,
            'ts' => 0,
            'n' => 0,
            's' => 0,
            'ss' => 0,
        ];
        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countResponsive = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['007', '009'])->count();
            $totalResponsive = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['007', '009'])->sum('rating');
            $averageResponsive = $countResponsive > 0 ? $totalResponsive / $countResponsive : 0;

            if ($averageResponsive >= 4.1) {
                $categoryResponsiveCounts['ss']++;
            } elseif ($averageResponsive >= 3.1) {
                $categoryResponsiveCounts['s']++;
            } elseif ($averageResponsive >= 2.1) {
                $categoryResponsiveCounts['n']++;
            } elseif ($averageResponsive <= 2) {
                $categoryResponsiveCounts['ts']++;
            } else {
                $categoryResponsiveCounts['sts']++;
            }
        }

        $categoryResponsiveSatisfactionCounts = [
            'sts' => ['puas' => 0, 'tidak_puas' => 0],
            'ts' => ['puas' => 0, 'tidak_puas' => 0],
            'n' => ['puas' => 0, 'tidak_puas' => 0],
            's' => ['puas' => 0, 'tidak_puas' => 0],
            'ss' => ['puas' => 0, 'tidak_puas' => 0],
        ];

        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countResponsive = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['007', '009'])->count();
            $totalResponsive = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['007', '009'])->sum('rating');
            $averageResponsive = $countResponsive > 0 ? $totalResponsive / $countResponsive : 0;

            $satisfaction = '';
            if ($averageResponsive >= 4.1) {
                $satisfaction = 'ss';
            } elseif ($averageResponsive >= 3.1) {
                $satisfaction = 's';
            } elseif ($averageResponsive >= 2.1) {
                $satisfaction = 'n';
            } elseif ($averageResponsive >= 1) {
                $satisfaction = 'ts';
            } else {
                $satisfaction = 'sts';
            }

            $booking = Booking::find($bookingId);
            $indikatorId = 6;
            $rating = $booking->ratings->where('indikator_id', $indikatorId)->first();

            if ($rating) {
                $satisfactionType = ($rating->rating == 2) ? 'puas' : 'tidak_puas';
                $categoryResponsiveSatisfactionCounts[$satisfaction][$satisfactionType]++;
            }
        }

        // Entropi Responsive
        $entropyResponsiveSTS = $this->calculateEntropy($categoryResponsiveSatisfactionCounts['sts']['puas'], $categoryResponsiveSatisfactionCounts['sts']['tidak_puas']);
        $entropyResponsiveTS = $this->calculateEntropy($categoryResponsiveSatisfactionCounts['ts']['puas'], $categoryResponsiveSatisfactionCounts['ts']['tidak_puas']);
        $entropyResponsiveN = $this->calculateEntropy($categoryResponsiveSatisfactionCounts['n']['puas'], $categoryResponsiveSatisfactionCounts['n']['tidak_puas']);
        $entropyResponsiveS = $this->calculateEntropy($categoryResponsiveSatisfactionCounts['s']['puas'], $categoryResponsiveSatisfactionCounts['s']['tidak_puas']);
        $entropyResponsiveSS = $this->calculateEntropy($categoryResponsiveSatisfactionCounts['ss']['puas'], $categoryResponsiveSatisfactionCounts['ss']['tidak_puas']);

        // Hitung Entropi dari target variable (S)
        $entropyS = $initialEntropy;

        // Hitung Weighted Sum of Entropy(Attributes) untuk "Responsive"
        $weightedEntropyResponsive = (
            ($categoryResponsiveCounts['sts'] / $totalBookings) * $entropyResponsiveSTS +
            ($categoryResponsiveCounts['ts'] / $totalBookings) * $entropyResponsiveTS +
            ($categoryResponsiveCounts['n'] / $totalBookings) * $entropyResponsiveN +
            ($categoryResponsiveCounts['s'] / $totalBookings) * $entropyResponsiveS +
            ($categoryResponsiveCounts['ss'] / $totalBookings) * $entropyResponsiveSS
        );

        // Hitung Information Gain untuk "Responsive"
        $informationGainResponsive = $entropyS - $weightedEntropyResponsive;

        // Assurance
        $categoryAssuranceCounts = [
            'sts' => 0,
            'ts' => 0,
            'n' => 0,
            's' => 0,
            'ss' => 0,
        ];
        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countAssurance = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['010', '012'])->count();
            $totalAssurance = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['010', '012'])->sum('rating');
            $averageAssurance = $countAssurance > 0 ? $totalAssurance / $countAssurance : 0;

            if ($averageAssurance >= 4.1) {
                $categoryAssuranceCounts['ss']++;
            } elseif ($averageAssurance >= 3.1) {
                $categoryAssuranceCounts['s']++;
            } elseif ($averageAssurance >= 2.1) {
                $categoryAssuranceCounts['n']++;
            } elseif ($averageAssurance <= 2) {
                $categoryAssuranceCounts['ts']++;
            } else {
                $categoryAssuranceCounts['sts']++;
            }
        }

        $categoryAssuranceSatisfactionCounts = [
            'sts' => ['puas' => 0, 'tidak_puas' => 0],
            'ts' => ['puas' => 0, 'tidak_puas' => 0],
            'n' => ['puas' => 0, 'tidak_puas' => 0],
            's' => ['puas' => 0, 'tidak_puas' => 0],
            'ss' => ['puas' => 0, 'tidak_puas' => 0],
        ];

        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countAssurance = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['010', '012'])->count();
            $totalAssurance = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['010', '012'])->sum('rating');
            $averageAssurance = $countAssurance > 0 ? $totalAssurance / $countAssurance : 0;

            $satisfaction = '';
            if ($averageAssurance >= 4.1) {
                $satisfaction = 'ss';
            } elseif ($averageAssurance >= 3.1) {
                $satisfaction = 's';
            } elseif ($averageAssurance >= 2.1) {
                $satisfaction = 'n';
            } elseif ($averageAssurance >= 1) {
                $satisfaction = 'ts';
            } else {
                $satisfaction = 'sts';
            }

            $booking = Booking::find($bookingId);
            $indikatorId = 6;
            $rating = $booking->ratings->where('indikator_id', $indikatorId)->first();

            if ($rating) {
                $satisfactionType = ($rating->rating == 2) ? 'puas' : 'tidak_puas';
                $categoryAssuranceSatisfactionCounts[$satisfaction][$satisfactionType]++;
            }
        }

        // Entropi Assurance
        $entropyAssuranceSTS = $this->calculateEntropy($categoryAssuranceSatisfactionCounts['sts']['puas'], $categoryAssuranceSatisfactionCounts['sts']['tidak_puas']);
        $entropyAssuranceTS = $this->calculateEntropy($categoryAssuranceSatisfactionCounts['ts']['puas'], $categoryAssuranceSatisfactionCounts['ts']['tidak_puas']);
        $entropyAssuranceN = $this->calculateEntropy($categoryAssuranceSatisfactionCounts['n']['puas'], $categoryAssuranceSatisfactionCounts['n']['tidak_puas']);
        $entropyAssuranceS = $this->calculateEntropy($categoryAssuranceSatisfactionCounts['s']['puas'], $categoryAssuranceSatisfactionCounts['s']['tidak_puas']);
        $entropyAssuranceSS = $this->calculateEntropy($categoryAssuranceSatisfactionCounts['ss']['puas'], $categoryAssuranceSatisfactionCounts['ss']['tidak_puas']);

        // Hitung Entropi dari target variable (S)
        $entropyS = $initialEntropy;

        // Hitung Weighted Sum of Entropy(Attributes) untuk "Assurance"
        $weightedEntropyAssurance = (
            ($categoryAssuranceCounts['sts'] / $totalBookings) * $entropyAssuranceSTS +
            ($categoryAssuranceCounts['ts'] / $totalBookings) * $entropyAssuranceTS +
            ($categoryAssuranceCounts['n'] / $totalBookings) * $entropyAssuranceN +
            ($categoryAssuranceCounts['s'] / $totalBookings) * $entropyAssuranceS +
            ($categoryAssuranceCounts['ss'] / $totalBookings) * $entropyAssuranceSS
        );

        // Hitung Information Gain untuk "Assurance"
        $informationGainAssurance = $entropyS - $weightedEntropyAssurance;

        // Emphaty
        $categoryEmphatyCounts = [
            'sts' => 0,
            'ts' => 0,
            'n' => 0,
            's' => 0,
            'ss' => 0,
        ];
        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countEmphaty = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['013', '015'])->count();
            $totalEmphaty = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['013', '015'])->sum('rating');
            $averageEmphaty = $countEmphaty > 0 ? $totalEmphaty / $countEmphaty : 0;

            if ($averageEmphaty >= 4.1) {
                $categoryEmphatyCounts['ss']++;
            } elseif ($averageEmphaty >= 3.1) {
                $categoryEmphatyCounts['s']++;
            } elseif ($averageEmphaty >= 2.1) {
                $categoryEmphatyCounts['n']++;
            } elseif ($averageEmphaty <= 2) {
                $categoryEmphatyCounts['ts']++;
            } else {
                $categoryEmphatyCounts['sts']++;
            }
        }

        $categoryEmphatySatisfactionCounts = [
            'sts' => ['puas' => 0, 'tidak_puas' => 0],
            'ts' => ['puas' => 0, 'tidak_puas' => 0],
            'n' => ['puas' => 0, 'tidak_puas' => 0],
            's' => ['puas' => 0, 'tidak_puas' => 0],
            'ss' => ['puas' => 0, 'tidak_puas' => 0],
        ];

        foreach ($bookingGroups as $bookingId => $bookingRatings) {
            $countEmphaty = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['013', '015'])->count();
            $totalEmphaty = $bookingRatings->whereBetween('subindikator.kode_subindikator', ['013', '015'])->sum('rating');
            $averageEmphaty = $countEmphaty > 0 ? $totalEmphaty / $countEmphaty : 0;

            $satisfaction = '';
            if ($averageEmphaty >= 4.1) {
                $satisfaction = 'ss';
            } elseif ($averageEmphaty >= 3.1) {
                $satisfaction = 's';
            } elseif ($averageEmphaty >= 2.1) {
                $satisfaction = 'n';
            } elseif ($averageEmphaty >= 1) {
                $satisfaction = 'ts';
            } else {
                $satisfaction = 'sts';
            }

            $booking = Booking::find($bookingId);
            $indikatorId = 6;
            $rating = $booking->ratings->where('indikator_id', $indikatorId)->first();

            if ($rating) {
                $satisfactionType = ($rating->rating == 2) ? 'puas' : 'tidak_puas';
                $categoryEmphatySatisfactionCounts[$satisfaction][$satisfactionType]++;
            }
        }

        // Entropi Emphaty
        $entropyEmphatySTS = $this->calculateEntropy($categoryEmphatySatisfactionCounts['sts']['puas'], $categoryEmphatySatisfactionCounts['sts']['tidak_puas']);
        $entropyEmphatyTS = $this->calculateEntropy($categoryEmphatySatisfactionCounts['ts']['puas'], $categoryEmphatySatisfactionCounts['ts']['tidak_puas']);
        $entropyEmphatyN = $this->calculateEntropy($categoryEmphatySatisfactionCounts['n']['puas'], $categoryEmphatySatisfactionCounts['n']['tidak_puas']);
        $entropyEmphatyS = $this->calculateEntropy($categoryEmphatySatisfactionCounts['s']['puas'], $categoryEmphatySatisfactionCounts['s']['tidak_puas']);
        $entropyEmphatySS = $this->calculateEntropy($categoryEmphatySatisfactionCounts['ss']['puas'], $categoryEmphatySatisfactionCounts['ss']['tidak_puas']);

        // Hitung Entropi dari target variable (S)
        $entropyS = $initialEntropy;

        // Hitung Weighted Sum of Entropy(Attributes) untuk "Emphaty"
        $weightedEntropyEmphaty = (
            ($categoryEmphatyCounts['sts'] / $totalBookings) * $entropyEmphatySTS +
            ($categoryEmphatyCounts['ts'] / $totalBookings) * $entropyEmphatyTS +
            ($categoryEmphatyCounts['n'] / $totalBookings) * $entropyEmphatyN +
            ($categoryEmphatyCounts['s'] / $totalBookings) * $entropyEmphatyS +
            ($categoryEmphatyCounts['ss'] / $totalBookings) * $entropyEmphatySS
        );

        // Hitung Information Gain untuk "Emphaty"
        $informationGainEmphaty = $entropyS - $weightedEntropyEmphaty;

        $jumlahBooking = Rating::with('subindikator')
            ->where('subindikator_id', '=', '016') // Menggunakan '=' untuk memilih subindikator 016
            ->select(
                'subindikator_id',
                DB::raw('SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as jumlah_puas'),
                DB::raw('SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as jumlah_tidak_puas')
            )
            ->groupBy('subindikator_id')
            ->get();

        return view('backend.dashboard.index', compact(
            'pending',
            'success',
            'failed',
            'package',
            'customer',
            'informationGainTangibles',
            'informationGainReliability',
            'informationGainResponsive',
            'informationGainAssurance',
            'informationGainEmphaty',
            'jumlahBooking'
        ));
    }

    private function calculateEntropy($puasCount, $tidakPuasCount)
    {
        $total = $puasCount + $tidakPuasCount;

        if ($total > 0) {
            $puasProb = $puasCount / $total;
            $tidakPuasProb = $tidakPuasCount / $total;

            if ($puasProb > 0 && $tidakPuasProb > 0) {
                $entropy = - ($puasProb * log($puasProb, 2)) - $tidakPuasProb * log($tidakPuasProb, 2);
                return number_format($entropy, 9);
            } else {
                return '0.00';
            }
        } else {
            return '0.00';
        }
    }
}
