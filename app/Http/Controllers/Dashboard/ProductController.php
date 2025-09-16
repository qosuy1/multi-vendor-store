<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        #GlobalScope methode in product Model

        // $user = Auth::user();
        // if ($user->store_id)
        //     $products = Product::where('store_id', $user->srore_id)->paginate();
        // else

        $products = Product::with(['store', 'category'])->paginate();

        return view(
            'dashboard.products.index',
            compact('products')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $product = null ;
        return view('dashboard.products.create' , compact('categories' )) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $productTags = implode(",", $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'tags' => $productTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $tags = json_decode($request->input('tags'));

        $product->update($request->except('tags', '_token', '_method'));

        // $stringTags = $request->get('tags');
        // $tags = explode(',', $stringTags);
        $tag_ids = [];

        $savedTags = Tag::all();
        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            // here I filter using collection from the object not from database
            $tag = $savedTags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create(['slug' => $slug, 'name' => $item->value]);
            }
            $tag_ids[] = $tag->id;
        }



        $product->tags()->sync($tag_ids);   # to sync add and delete
        // $product->tags()->syncWithoutDetaching($tag_ids);    # sync without delete
        // $product->tags()->attach($tag_ids);   # to add
        // $product->tags()->detach($tag_ids);   # to delete


        return redirect()
            ->route('dashboard.products.index')
            ->with('success', "product ` $product->id ` updated succssfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
