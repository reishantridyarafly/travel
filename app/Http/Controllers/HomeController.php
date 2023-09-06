<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function tampil()
    {
        // Mengambil semua data rating dengan relasi user, indikator, dan subindikator, lalu mengurutkannya berdasarkan tanggal yang terbaru
        $ratings = Rating::with(['user', 'indikator', 'subindikator'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mengelompokkan ratings berdasarkan booking_id
        $bookingGroups = $ratings->groupBy('booking_id');

        // Menghitung jumlah total bookings
        $totalBookings = $bookingGroups->count();

        // Inisialisasi variabel data
        $data = [];
        $currentBookingId = '';

        // Loop melalui semua ratings
        foreach ($ratings as $row) {
            // Jika booking_id berbeda dari sebelumnya, hitung hasil rating untuk booking sebelumnya / hitung booking paling awal
            if ($currentBookingId != $row->booking_id) {
                if ($currentBookingId != '') {
                    $data[$currentBookingId] = $this->calculateBookingRatings(
                        $data[$currentBookingId]['subindikators'],
                        $data[$currentBookingId]['results']
                    );
                }

                $currentBookingId = $row->booking_id;
                $data[$currentBookingId] = [
                    'subindikators' => [],
                    'results' => [],
                ];
            }

            // Menambahkan data rating ke dalam struktur data
            $data[$currentBookingId]['subindikators'][] = [
                'indikator' => $row->indikator->name,
                'subindikator' => $row->subindikator->name,
                'rating' => $row->rating,
                'kodeSubindikator' => $row->subindikator->kode_subindikator,
            ];

            $data[$currentBookingId]['results'][] = $row->rating;
        }

        if ($currentBookingId != '') {
            // Inisialisasi array 'subindikators' dan 'results' jika belum ada
            $data[$currentBookingId]['subindikators'] = $data[$currentBookingId]['subindikators'] ?? [];
            $data[$currentBookingId]['results'] = $data[$currentBookingId]['results'] ?? [];

            // Hitung hasil perhitungan dan simpan ke dalam array $data
            $data[$currentBookingId] = $this->calculateBookingRatings(
                $data[$currentBookingId]['subindikators'],
                $data[$currentBookingId]['results']
            );
        }

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

        $satisfiedCount = $totalSatisfiedBookings; // Jumlah ratings yang "Puas"
        $dissatisfiedCount = $totalDissatisfiedBookings; // Jumlah ratings yang "Tidak Puas"
        $totalBookings = $satisfiedCount + $dissatisfiedCount; // Total ratings

        $p_satisfied = $satisfiedCount / $totalBookings; // Probabilitas ratings "Puas"
        $p_dissatisfied = $dissatisfiedCount / $totalBookings; // Probabilitas ratings "Tidak Puas"

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

        $informationGains = [
            'Tangibles' => $informationGainTangibles,
            'Reliability' => $informationGainReliability,
            'Responsive' => $informationGainResponsive,
            'Assurance' => $informationGainAssurance,
            'Emphaty' => $informationGainEmphaty,
        ];

        // Temukan nilai tertinggi
        $highestInformationGain = max($informationGains);

        // Menemukan kategori dengan gain tertinggi
        $kategoriTerbaik = array_keys($informationGains, max($informationGains))[0];

        return view('welcome', compact(
            'ratings',
            'data',
            'totalBookings',
            'totalSatisfiedBookings',
            'totalDissatisfiedBookings',
            'entropyTotal',
            'initialEntropy',

            'categoryTangiblesCounts',
            'categoryTangiblesSatisfactionCounts',
            'entropyTangiblesSTS',
            'entropyTangiblesTS',
            'entropyTangiblesN',
            'entropyTangiblesS',
            'entropyTangiblesSS',
            'informationGainTangibles',

            'categoryReliabilityCounts',
            'categoryReliabilitySatisfactionCounts',
            'entropyReliabilitySTS',
            'entropyReliabilityTS',
            'entropyReliabilityN',
            'entropyReliabilityS',
            'entropyReliabilitySS',
            'informationGainReliability',

            'categoryResponsiveCounts',
            'categoryResponsiveSatisfactionCounts',
            'entropyResponsiveSTS',
            'entropyResponsiveTS',
            'entropyResponsiveN',
            'entropyResponsiveS',
            'entropyResponsiveSS',
            'informationGainResponsive',

            'categoryAssuranceCounts',
            'categoryAssuranceSatisfactionCounts',
            'entropyAssuranceSTS',
            'entropyAssuranceTS',
            'entropyAssuranceN',
            'entropyAssuranceS',
            'entropyAssuranceSS',
            'informationGainAssurance',

            'categoryEmphatyCounts',
            'categoryEmphatySatisfactionCounts',
            'entropyEmphatySTS',
            'entropyEmphatyTS',
            'entropyEmphatyN',
            'entropyEmphatyS',
            'entropyEmphatySS',
            'informationGainEmphaty',

            'highestInformationGain',
            'kategoriTerbaik'
        ));
    }

    // Fungsi untuk menghitung entropy berdasarkan jumlah "puas" dan "tidak puas" entitas/kejadian
    private function calculateEntropy($puasCount, $tidakPuasCount)
    {
        // Menghitung total jumlah entitas atau kejadian
        $total = $puasCount + $tidakPuasCount;

        // Pengecekan jika ada data yang valid untuk dihitung
        if ($total > 0) {
            // Menghitung probabilitas "puas" dan "tidak puas"
            $puasProb = $puasCount / $total;
            $tidakPuasProb = $tidakPuasCount / $total;

            // Pengecekan apakah probabilitas yang dihitung lebih besar dari 0
            if ($puasProb > 0 && $tidakPuasProb > 0) {
                // Menghitung entropy berdasarkan rumus teori informasi
                $entropy = - ($puasProb * log($puasProb, 2)) - $tidakPuasProb * log($tidakPuasProb, 2);
                // Mengubah hasil entropy menjadi format dengan 9 digit desimal
                return number_format($entropy, 9);
            } else {
                // Jika probabilitas adalah 0 (tidak ada variasi dalam data), entropy dianggap 0
                return '0';
            }
        } else {
            // Jika tidak ada data yang valid untuk dihitung, entropy dianggap 0
            return '0';
        }
    }


    // Fungsi untuk menghitung peringkat (ratings) berdasarkan subindikator dan hasilnya
    private function calculateBookingRatings($subindikators, $results)
    {
        // Inisialisasi variabel untuk total dan jumlah subindikator dalam kategori-kategori yang berbeda
        $totalTangibles = 0;
        $countTangibles = 0;

        $totalReliability = 0;
        $countReliability = 0;

        $totalResponsive = 0;
        $countResponsive = 0;

        $totalAssurance = 0;
        $countAssurance = 0;

        $totalEmphaty = 0;
        $countEmphaty = 0;

        $totalResults = 0;
        $countResults = 0;

        $ratingSubindikator016 = null;

        // Iterasi melalui subindikator untuk menghitung total dan jumlah di setiap kategori
        foreach ($subindikators as $subindikator) {
            $kodeSubindikator = $subindikator['kodeSubindikator'];

            // Memeriksa kode subindikator untuk menentukan kategori dan menghitung total serta jumlah
            if ($kodeSubindikator >= '001' && $kodeSubindikator <= '003') {
                $totalTangibles += $subindikator['rating'];
                $countTangibles++;
            } elseif ($kodeSubindikator >= '004' && $kodeSubindikator <= '006') {
                $totalReliability += $subindikator['rating'];
                $countReliability++;
            } elseif ($kodeSubindikator >= '007' && $kodeSubindikator <= '009') {
                $totalResponsive += $subindikator['rating'];
                $countResponsive++;
            } elseif ($kodeSubindikator >= '0010' && $kodeSubindikator <= '0012') {
                $totalAssurance += $subindikator['rating'];
                $countAssurance++;
            } elseif ($kodeSubindikator >= '0013' && $kodeSubindikator <= '0015') {
                $totalEmphaty += $subindikator['rating'];
                $countEmphaty++;
            } elseif ($kodeSubindikator == '016') {
                $ratingSubindikator016 = $subindikator['rating'];
            }

            // Tambahkan nilai rating ke total hasil nilai
            $totalResults += $subindikator['rating'];
            $countResults++;
        }

        // Menghitung hasil rata-rata rating untuk setiap kategori dan hasil keseluruhan
        $hasilTangibles = $countTangibles > 0 ? $totalTangibles / $countTangibles : 0;
        $hasilReliability = $countReliability > 0 ? $totalReliability / $countReliability : 0;
        $hasilResponsive = $countResponsive > 0 ? $totalResponsive / $countResponsive : 0;
        $hasilAssurance = $countAssurance > 0 ? $totalAssurance / $countAssurance : 0;
        $hasilEmphaty = $countEmphaty > 0 ? $totalEmphaty / $countEmphaty : 0;
        $hasilResults = $countResults > 0 ? $totalResults / $countResults : 0;

        // Mengembalikan hasil perhitungan dalam bentuk array
        return [
            'totalTangibles' => $totalTangibles,
            'totalReliability' => $totalReliability,
            'totalResponsive' => $totalResponsive,
            'totalAssurance' => $totalAssurance,
            'totalEmphaty' => $totalEmphaty,
            'totalResults' => $totalResults,
            'hasilTangibles' => $hasilTangibles,
            'hasilReliability' => $hasilReliability,
            'hasilResponsive' => $hasilResponsive,
            'hasilAssurance' => $hasilAssurance,
            'hasilEmphaty' => $hasilEmphaty,
            'hasilResults' => $hasilResults,
            'ratingSubindikator016' => $ratingSubindikator016,
        ];
    }
}
