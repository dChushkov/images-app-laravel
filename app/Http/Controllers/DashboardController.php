<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        $photos = Photo::latest()->limit(12)->get();
        return view('dashboard', compact('photos'));
    }
}
