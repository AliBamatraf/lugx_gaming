<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all categories and create paginite
        $category = Category::paginate(4);

        // return view with all the categories
        return view('category.index', [
            'categories' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate entered value
        $input = $request->validate([
            'name' => ['required', 'unique:categories'],
            'image' => ['required', 'file', 'mimes:png,jpg']
        ]);
        // dd($input);
        //check the path of image
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('/images/categories', $request->image);
        }

        Category::create([
            'name' => $request->name,
            'image' => $path
        ]);

        return back()->with([
            'success' => 'the category has been created'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //validate entered value
        $request->validate([
            'name' => ['required'],
            'image' => ['file', 'mimes: png ,jpg']
        ]);

        //check the path of image
        $path = $category->image ?? null;
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $path = Storage::disk('public')->put('images/categories', $request->image);
        }

        $category->update([
            'name' => $request->name,
            'image' => $path
        ]);

        return back()->with([
            'success' => 'the category has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        Storage::disk('public')->delete($category->image);

        $category->delete();

        return back()->with([
            'success' => 'the category has been deleted'
        ]);
    }
}
