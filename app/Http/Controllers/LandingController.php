<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        $produks = Product::all();
        // Mengabil semua produk yang ada di database 
        return view("landing.index", compact('produks'));
    }
}
