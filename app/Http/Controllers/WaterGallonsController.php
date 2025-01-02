<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HargaGalon;

class WaterGallonsController extends Controller
{
    public function index()
    {
        $hargaGalon = HargaGalon::all();
        return view('welcome', compact('hargaGalon')); // Mengembalikan tampilan welcome.blade.php
    }

    public function buy()
    {
        // Logika untuk halaman pembelian
        return view('buy'); // Ganti dengan tampilan yang sesuai
    }

    public function learnMore()
    {
        // Logika untuk halaman belajar lebih lanjut
        return view('learn-more'); // Ganti dengan tampilan yang sesuai
    }
}