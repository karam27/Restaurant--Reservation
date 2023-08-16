<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $specials = Category::where('name', 'specials')->first();
        return view('welcome', compact('specials'));
    }
    public function thankyou()
    {
        return view('thankyou');
    }
}
