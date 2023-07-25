<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function question1()
    {
        $ratings = Rating::where('question', 'Pertanyaan 1')->get();

        return view('backend.ratings.question1', compact('ratings'));
    }

    public function question2()
    {
        $ratings = Rating::where('question', 'Pertanyaan 2')->get();

        return view('backend.ratings.question2', compact('ratings'));
    }

    public function question3()
    {
        $ratings = Rating::where('question', 'Pertanyaan 3')->get();

        return view('backend.ratings.question3', compact('ratings'));
    }

    public function question4()
    {
        $ratings = Rating::where('question', 'Pertanyaan 4')->get();

        return view('backend.ratings.question4', compact('ratings'));
    }

    public function question5()
    {
        $ratings = Rating::where('question', 'Pertanyaan 5')->get();

        return view('backend.ratings.question5', compact('ratings'));
    }

    public function question6()
    {
        $ratings = Rating::where('question', 'Pertanyaan 6')->get();

        return view('backend.ratings.question6', compact('ratings'));
    }

    public function question7()
    {
        $ratings = Rating::where('question', 'Pertanyaan 7')->get();

        return view('backend.ratings.question7', compact('ratings'));
    }

    public function question8()
    {
        $ratings = Rating::where('question', 'Pertanyaan 8')->get();

        return view('backend.ratings.question8', compact('ratings'));
    }

    public function question9()
    {
        $ratings = Rating::where('question', 'Pertanyaan 9')->get();

        return view('backend.ratings.question9', compact('ratings'));
    }

    public function question10()
    {
        $ratings = Rating::where('question', 'Pertanyaan 10')->get();

        return view('backend.ratings.question10', compact('ratings'));
    }

    public function question11()
    {
        $ratings = Rating::where('question', 'Pertanyaan 11')->get();

        return view('backend.ratings.question11', compact('ratings'));
    }

    public function question12()
    {
        $ratings = Rating::where('question', 'Pertanyaan 12')->get();

        return view('backend.ratings.question12', compact('ratings'));
    }

    public function question13()
    {
        $ratings = Rating::where('question', 'Pertanyaan 13')->get();

        return view('backend.ratings.question13', compact('ratings'));
    }

    public function question14()
    {
        $ratings = Rating::where('question', 'Pertanyaan 14')->get();

        return view('backend.ratings.question14', compact('ratings'));
    }

    public function question15()
    {
        $ratings = Rating::where('question', 'Pertanyaan 15')->get();

        return view('backend.ratings.question15', compact('ratings'));
    }
}
