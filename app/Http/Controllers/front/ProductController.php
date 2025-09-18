<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

    }
    public function show(Product $product)
    {
        // dd($product) ;
        if ($product->status != "active")
            abort(404, 'sorry! product not found');

        return view('front.products.show', compact('product'));
    }
}
