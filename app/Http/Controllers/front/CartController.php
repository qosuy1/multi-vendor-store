<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepositories;

class CartController extends Controller
{
    private $cart;
    public function __construct(CartRepositories $cart)
    {
        $this->cart = $cart;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = $this->cart;
        return view('front.cart.index', compact('cart'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $this->cart->add($product, $request->quantity ?? 1);

        if ($request->expectsJson())
            return response()->json([
                'message' => 'product added succssfully to cart',
            ], 201);
        else
            return redirect()->back()->with('success', 'Product added to cart successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|int|min:1',
        ]);

        $this->cart->update($id, $request->quantity);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cart->delete($id);
        return response()->json(
            [
                'message' => 'deleted succssfully'
            ]
        );
    }
}
