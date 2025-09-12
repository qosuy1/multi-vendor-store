<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        ###############################################################
        # shortcut of this code usig [ local scope ] in model
        // $query = Category::query();
        // if ($name = $request->query('name'))
        //     $query->where('name', 'LIKE', "%$name%");
        // if ($status = $request->query('status'))
        //     $query->where('status', $status);

        ###############################################################
        /* to show category parent name you have to methods :
            [1] => make Elqountent Relationship ($this->belongTo()) in model
            [2] => usign the query builder => join :

                select categories.* , parents.name as parents_name
                From categories LEFT JOIN categories as parents
                ON parents.id = categories.name
        */
        $categories = Category::with('parentCategory')
            /*  leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
                select([
                    'categories.*',
                    'parents.name as parents_name'
                ]) */
            # to count products using query builder
            // ->select('categories.*')
            // ->selectRaw('(' . "SELECT COUNT(*) FROM `products` WHERE category_id = categories.id AND status = 'active' " . ')' . "as products_count")
            # using Relations
            ->withCount([
                'products' => function ($query) {
                    $query->where('products.status', 'active'); # where product status is active
                }
            ])
            ->filter($request->query())
            ->orderBy('id', 'desc')
            ->paginate();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(Category::rules());

        $attributes['image'] = $this->uploadImage($request);

        $attributes['slug'] = Str::slug($attributes['name']);
        Category::create($attributes);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products = $category->products()->with('store')->latest()->paginate(5);
        return view('dashboard.categories.show', compact('category', 'products'));
    }
    /**

     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found');
        }

        $parents = Category::where('id', '!=', $id)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', '!=', $id)
                    ->orWhere('parent_id', null);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attributes = $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);

        $attributes['image'] = $this->uploadImage($request, $category);

        //delete old image
        if (isset($category->image) && $category->image != $attributes['image'])
            Storage::disk('public')->delete($category->image);


        $attributes['slug'] = Str::slug($attributes['name']);


        $category->update($attributes);
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $category = Category::findOrFail($id);
        $category->delete();

        //delete category image
        // if (isset($category->image))
        //     Storage::disk('public')->delete($category->image);


        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category deleted successfully');
    }


    public function trash()
    {
        $deletedCategories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', ['categories' => $deletedCategories]);
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category restored');
    }
    public function forseDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        //delete category image
        if (isset($category->image))
            Storage::disk('public')->delete($category->image);

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category deleted forever!');

    }


    protected function uploadImage(Request $request, $category = null)
    {
        if (!$request->hasFile('image')) {
            return $category->image ?? null;
        }

        $file = $request->file('image');
        $path = $file->store('categories', 'public');
        return $path;
    }
}
