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

        return view('backend.dashboard.index', compact('pending', 'success', 'failed', 'package', 'customer',
                                                'starRatings1', 'starRatings2', 'starRatings3', 'starRatings4',
                                                'starRatings5', 'starRatings6', 'starRatings7', 'starRatings8',
                                                'starRatings9', 'starRatings10', 'starRatings11', 'starRatings12',
                                                'starRatings13', 'starRatings14', 'starRatings15'));
    }
}
