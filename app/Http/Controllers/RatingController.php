<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Rating;

class RatingController extends Controller
{
    public function create(Request $request)
    {
        $rate = new Rating;

        $rate->fileId = $request->input('fileId');
        $rate->amount = $request->input('amount');

        $rate->save();

        return $rate;
    }
}
