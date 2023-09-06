<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Get authenticated user ID
        $user = Auth::user();

        // Save the rating to the database
        Rating::create([
            'booking_id' => $request->input('booking_id'),
            'package_id' => $request->input('package_id'),
            'user_id' => $user->id,
            'indikator_id' => $request->input('indikator_id'),
            'subindikator_id' => $request->input('subindikator_id'),
            'rating' => $request->input('rating'),
        ]);

        return response()->json(['message' => 'Rating berhasil disimpan']);
    }
}
