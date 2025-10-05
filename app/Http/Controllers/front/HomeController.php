<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\View\Components\FrontLayout;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::active()->with('category')->latest()->take(8)->get();
        // dd($products);
        return view('front.home' , compact('products'));
    }
}
