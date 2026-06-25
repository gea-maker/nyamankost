<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Mengambil 3 data kos terbaru untuk bagian "Rekomendasi"
        $rekomendasiKos = Kos::latest()->take(3)->get();
        
        return view('welcome', compact('rekomendasiKos'));
    }
}