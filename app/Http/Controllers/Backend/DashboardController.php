<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\User;
use App\Models\Rating;

class DashboardController extends Controller
{
    public function index()
    {
        // $sts = 1;
        // $st = 2;
        // $n = 3;
        // $s = 4;
        // $ss = 5;

        // // Orang 1
        // $p1_1 = 3;
        // $p2_1 = 4;
        // $p3_1 = 4;
        // $p4_1 = 4;
        // $p5_1 = 4;
        // $p6_1 = 4;
        // $p7_1 = 4;
        // $p8_1 = 4;
        // $p9_1 = 4;
        // $p10_1 = 4;
        // $p11_1 = 4;
        // $p12_1 = 4;
        // $p13_1 = 4;
        // $p14_1 = 4;
        // $p15_1 = 4;
        // $p16_1 = 1;

        // // Tahap 1
        // $tangible_1 = ($p1_1 + $p2_1 + $p3_1) / 3;
        // $reliability_1 = ($p4_1 + $p5_1 + $p6_1) / 3;
        // $responsive_1 = ($p7_1 + $p8_1 + $p9_1) / 3;
        // $assurance_1 = ($p10_1 + $p11_1 + $p12_1) / 3;
        // $emphaty_1 = ($p13_1 + $p14_1 + $p15_1) / 3;

        // // Hasil Indikator Tangible
        // if ($tangible_1 >= 4.1) {
        //     $hasil_indikator_tangible_1 = "Sangat Setuju";
        // } elseif ($tangible_1 >= 3.1) {
        //     $hasil_indikator_tangible_1 = "Setuju";
        // } elseif ($tangible_1 >= 2.1) {
        //     $hasil_indikator_tangible_1 = "Netral / Biasa saja";
        // } elseif ($tangible_1 <= 2) {
        //     $hasil_indikator_tangible_1 = "Tidak Setuju";
        // } else {
        //     $hasil_indikator_tangible_1 = "Sangat Tidak Setuju";
        // }

        // // dd($tangible_1, $reliability_1, $responsive_1, $assurance_1, $emphaty_1);

        // // Orang 2
        // $p1_2 = 3;
        // $p2_2 = 3;
        // $p3_2 = 3;
        // $p4_2 = 4;
        // $p5_2 = 3;
        // $p6_2 = 4;
        // $p7_2 = 3;
        // $p8_2 = 4;
        // $p9_2 = 3;
        // $p10_2 = 3;
        // $p11_2 = 3;
        // $p12_2 = 3;
        // $p13_2 = 4;
        // $p14_2 = 4;
        // $p15_2 = 4;
        // $p16_2 = 0;

        // $tangible_2 = ($p1_2 + $p2_2 + $p3_2) / 3;
        // $reliability_2 = ($p4_2 + $p5_2 + $p6_2) / 3;
        // $responsive_2 = ($p7_2 + $p8_2 + $p9_2) / 3;
        // $assurance_2 = ($p10_2 + $p11_2 + $p12_2) / 3;
        // $emphaty_2 = ($p13_2 + $p14_2 + $p15_2) / 3;

        // if ($tangible_2 >= 4.1) {
        //     $hasil_indikator_tangible_2 = "Sangat Setuju";
        // } elseif ($tangible_2 >= 3.1) {
        //     $hasil_indikator_tangible_2 = "Setuju";
        // } elseif ($tangible_2 >= 2.1) {
        //     $hasil_indikator_tangible_2 = "Netral / Biasa saja";
        // } elseif ($tangible_2 <= 2) {
        //     $hasil_indikator_tangible_2 = "Tidak Setuju";
        // } else {
        //     $hasil_indikator_tangible_2 = "Sangat Tidak Setuju";
        // }

        // // dd($tangible_2, $reliability_2, $responsive_2, $assurance_2, $emphaty_2);

        // // Orang 3
        // $p1_3 = 4;
        // $p2_3 = 4;
        // $p3_3 = 4;
        // $p4_3 = 4;
        // $p5_3 = 4;
        // $p6_3 = 4;
        // $p7_3 = 4;
        // $p8_3 = 4;
        // $p9_3 = 4;
        // $p10_3 = 4;
        // $p11_3 = 4;
        // $p12_3 = 4;
        // $p13_3 = 4;
        // $p14_3 = 4;
        // $p15_3 = 4;
        // $p16_3 = 1;

        // $tangible_3 = ($p1_3 + $p2_3 + $p3_3) / 3;
        // $reliability_3 = ($p4_3 + $p5_3 + $p6_3) / 3;
        // $responsive_3 = ($p7_3 + $p8_3 + $p9_3) / 3;
        // $assurance_3 = ($p10_3 + $p11_3 + $p12_3) / 3;
        // $emphaty_3 = ($p13_3 + $p14_3 + $p15_3) / 3;

        // if ($tangible_3 >= 4.1) {
        //     $hasil_indikator_tangible_3 = "Sangat Setuju";
        // } elseif ($tangible_3 >= 3.1) {
        //     $hasil_indikator_tangible_3 = "Setuju";
        // } elseif ($tangible_3 >= 2.1) {
        //     $hasil_indikator_tangible_3 = "Netral / Biasa saja";
        // } elseif ($tangible_3 <= 2) {
        //     $hasil_indikator_tangible_3 = "Tidak Setuju";
        // } else {
        //     $hasil_indikator_tangible_3 = "Sangat Tidak Setuju";
        // }

        // // dd($tangible_3, $reliability_3, $responsive_3, $assurance_3, $emphaty_3);

        // // Orang 4
        // $p1_4 = 4;
        // $p2_4 = 4;
        // $p3_4 = 4;
        // $p4_4 = 4;
        // $p5_4 = 4;
        // $p6_4 = 4;
        // $p7_4 = 4;
        // $p8_4 = 4;
        // $p9_4 = 3;
        // $p10_4 = 4;
        // $p11_4 = 4;
        // $p12_4 = 4;
        // $p13_4 = 4;
        // $p14_4 = 4;
        // $p15_4 = 4;
        // $p16_4 = 1;

        // $tangible_4 = ($p1_4 + $p2_4 + $p3_4) / 3;
        // $reliability_4 = ($p4_4 + $p5_4 + $p6_4) / 3;
        // $responsive_4 = ($p7_4 + $p8_4 + $p9_4) / 3;
        // $assurance_4 = ($p10_4 + $p11_4 + $p12_4) / 3;
        // $emphaty_4 = ($p13_4 + $p14_4 + $p15_4) / 3;

        // if ($tangible_4 >= 4.1) {
        //     $hasil_indikator_tangible_4 = "Sangat Setuju";
        // } elseif ($tangible_4 > 3.1) {
        //     $hasil_indikator_tangible_4 = "Setuju";
        // } elseif ($tangible_4 > 2.1) {
        //     $hasil_indikator_tangible_4 = "Netral / Biasa saja";
        // } elseif ($tangible_4 < 2) {
        //     $hasil_indikator_tangible_4 = "Tidak Setuju";
        // } else {
        //     $hasil_indikator_tangible_4 = "Sangat Tidak Setuju";
        // }

        // // dd($tangible_4, $reliability_4, $responsive_4, $assurance_4, $emphaty_4);

        // // Orang 5
        // $p1_5 = 4;
        // $p2_5 = 4;
        // $p3_5 = 4;
        // $p4_5 = 4;
        // $p5_5 = 4;
        // $p6_5 = 4;
        // $p7_5 = 4;
        // $p8_5 = 4;
        // $p9_5 = 4;
        // $p10_5 = 4;
        // $p11_5 = 4;
        // $p12_5 = 4;
        // $p13_5 = 4;
        // $p14_5 = 4;
        // $p15_5 = 4;
        // $p16_5 = 1;

        // $tangible_5 = ($p1_5 + $p2_5 + $p3_5) / 3;
        // $reliability_5 = ($p4_5 + $p5_5 + $p6_5) / 3;
        // $responsive_5 = ($p7_5 + $p8_5 + $p9_5) / 3;
        // $assurance_5 = ($p10_5 + $p11_5 + $p12_5) / 3;
        // $emphaty_5 = ($p13_5 + $p14_5 + $p15_5) / 3;

        // if ($tangible_5 >= 4.1) {
        //     $hasil_indikator_tangible_5 = "Sangat Setuju";
        // } elseif ($tangible_5 >= 3.1) {
        //     $hasil_indikator_tangible_5 = "Setuju";
        // } elseif ($tangible_5 >= 2.1) {
        //     $hasil_indikator_tangible_5 = "Netral / Biasa saja";
        // } elseif ($tangible_5 <= 2) {
        //     $hasil_indikator_tangible_5 = "Tidak Setuju";
        // } else {
        //     $hasil_indikator_tangible_5 = "Sangat Tidak Setuju";
        // }

        // $sangatTidakSetujuCount = 0;
        // $tidakSetujuCount = 0;
        // $netralCount = 0;
        // $setujuCount = 0;
        // $sangatSetujuCount = 0;

        // for ($i = 1; $i <= 5; $i++) {
        //     // Get the value of $hasil_indikator_tangible for the current person
        //     $hasil_indikator_tangible = ${"hasil_indikator_tangible_" . $i};

        //     // Check if the response is "Sangat Tidak Setuju"
        //     if ($hasil_indikator_tangible === "Sangat Tidak Setuju") {
        //         $sangatTidakSetujuCount++; // Increment the counter
        //     }

        //     // Check if the response is "Tidak Setuju"
        //     if ($hasil_indikator_tangible === "Tidak Setuju") {
        //         $tidakSetujuCount++; // Increment the counter
        //     }

        //     // Check if the response is "Netral / Biasa saja"
        //     if ($hasil_indikator_tangible === "Netral / Biasa saja") {
        //         $netralCount++; // Increment the counter
        //     }

        //     // Check if the response is "Setuju"
        //     if ($hasil_indikator_tangible === "Setuju") {
        //         $setujuCount++; // Increment the counter
        //     }

        //     // Check if the response is "Sangat Setuju"
        //     if ($hasil_indikator_tangible === "Sangat Setuju") {
        //         $sangatSetujuCount++; // Increment the counter
        //     }
        // }

        // // Initialize counters for Puas and Tidak Puas
        // $total_puas = 0;
        // $total_tidak_puas = 0;

        // // Loop through each individual (Orang 1 to Orang 5)
        // for ($i = 1; $i <= 5; $i++) {
        //     // Check the value of p16 for the current individual
        //     $p16_value = ${"p16_" . $i};

        //     // Update the counters based on the value of p16
        //     if ($p16_value === 1) {
        //         $total_puas++;
        //     } elseif ($p16_value === 0) {
        //         $total_tidak_puas++;
        //     }
        // }

        // // Display the total number of Puas and Tidak Puas responses
        // // dd($total_puas, $total_tidak_puas);
        // // dd($tidakSetujuCount, $sangatTidakSeutujuCount, $netralCount, $setujuCount, $sangatSetujuCount);


        // $sts = [1, 2, 3, 4, 5]; // STS values for each individual

        // $sangatTidakPuasCount = 0;
        // $tidakPuasCount = 0;

        // $puasCounts = [];
        // $tidakPuasCounts = [];

        // for ($i = 1; $i <= 5; $i++) {
        //     // Get the value of p16 for the current individual
        //     $p16_value = ${"p16_" . $i};

        //     // Get the value of sts for the current individual
        //     $sts_value = $sts[$i - 1];

        //     // Determine the appropriate array based on the value of sts
        //     if ($sts_value === 1 || $sts_value === 2) {
        //         $counts = &$tidakPuasCounts;
        //     } else {
        //         $counts = &$puasCounts;
        //     }

        //     // Increment the counters based on the value of p16
        //     if ($p16_value === 1) {
        //         $counts[] = 1; // Puas
        //     } else {
        //         $counts[] = 0; // Tidak Puas
        //     }
        // }

        // // Calculate the total counts for each level of satisfaction
        // $sangatTidakPuasCount = array_sum(array_slice($tidakPuasCounts, 0, 1));
        // $tidakPuasCount = array_sum(array_slice($tidakPuasCounts, 1));
        // $netralCount = array_sum($puasCounts);

        // // Display the counts for each level of satisfaction
        // dd($sangatTidakPuasCount, $tidakPuasCount, $netralCount, $setujuCount, $sangatSetujuCount);

        $pending = Transaction::where('status', 'pending')->count();
        $success = Transaction::where('status', 'success')->count();
        $failed = Transaction::whereIn('status', ['failed', 'expired', 'cancel'])->count();
        $package = Package::count();
        $customer = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', '=', 'admin')->orWhere('name', '=', 'owner');
        })->count();

        // question 1
        $ratings1 = Rating::where('question', 'Pertanyaan 1')->get();
        $starRatings1 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings1 as $rating) {
            $starRatings1[$rating->rating]++;
        }

        // question 2
        $ratings2 = Rating::where('question', 'Pertanyaan 2')->get();
        $starRatings2 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings2 as $rating) {
            $starRatings2[$rating->rating]++;
        }

        // question 3
        $ratings3 = Rating::where('question', 'Pertanyaan 3')->get();
        $starRatings3 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings3 as $rating) {
            $starRatings3[$rating->rating]++;
        }

        // question 4
        $ratings4 = Rating::where('question', 'Pertanyaan 4')->get();
        $starRatings4 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings4 as $rating) {
            $starRatings4[$rating->rating]++;
        }

        // question 5
        $ratings5 = Rating::where('question', 'Pertanyaan 5')->get();
        $starRatings5 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings5 as $rating) {
            $starRatings5[$rating->rating]++;
        }

        // question 6
        $ratings6 = Rating::where('question', 'Pertanyaan 6')->get();
        $starRatings6 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings6 as $rating) {
            $starRatings6[$rating->rating]++;
        }

        // question 7
        $ratings7 = Rating::where('question', 'Pertanyaan 7')->get();
        $starRatings7 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings7 as $rating) {
            $starRatings7[$rating->rating]++;
        }

        // question 8
        $ratings8 = Rating::where('question', 'Pertanyaan 8')->get();
        $starRatings8 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings8 as $rating) {
            $starRatings8[$rating->rating]++;
        }

        // question 9
        $ratings9 = Rating::where('question', 'Pertanyaan 9')->get();
        $starRatings9 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings9 as $rating) {
            $starRatings9[$rating->rating]++;
        }

        // question 10
        $ratings10 = Rating::where('question', 'Pertanyaan 10')->get();
        $starRatings10 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings10 as $rating) {
            $starRatings10[$rating->rating]++;
        }

        // question 11
        $ratings11 = Rating::where('question', 'Pertanyaan 11')->get();
        $starRatings11 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings11 as $rating) {
            $starRatings11[$rating->rating]++;
        }

        // question 12
        $ratings12 = Rating::where('question', 'Pertanyaan 12')->get();
        $starRatings12 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings12 as $rating) {
            $starRatings12[$rating->rating]++;
        }

        // question 13
        $ratings13 = Rating::where('question', 'Pertanyaan 13')->get();
        $starRatings13 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings13 as $rating) {
            $starRatings13[$rating->rating]++;
        }

        // question 14
        $ratings14 = Rating::where('question', 'Pertanyaan 14')->get();
        $starRatings14 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings14 as $rating) {
            $starRatings14[$rating->rating]++;
        }

        // question 15
        $ratings15 = Rating::where('question', 'Pertanyaan 15')->get();
        $starRatings15 = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($ratings15 as $rating) {
            $starRatings15[$rating->rating]++;
        }

        return view('backend.dashboard.index', compact(
            'pending',
            'success',
            'failed',
            'package',
            'customer',
            'starRatings1',
            'starRatings2',
            'starRatings3',
            'starRatings4',
            'starRatings5',
            'starRatings6',
            'starRatings7',
            'starRatings8',
            'starRatings9',
            'starRatings10',
            'starRatings11',
            'starRatings12',
            'starRatings13',
            'starRatings14',
            'starRatings15'
        ));
    }
}
