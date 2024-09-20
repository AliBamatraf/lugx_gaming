<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
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
        $category = Category::select(['id', 'name', 'image'])->latest()->paginate(4);
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
    public function store(StoreCategoryRequest $request, CategoryService $CategoryService)
    {
        $CategoryService->StoreCategoryService($request);
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
    public function update(UpdateCategoryRequest $request, Category $category, CategoryService $CategoryService)
    {

        $CategoryService->UpdateCategoryService($request, $category);
        return back()->with([
            'success' => 'the category has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, CategoryService $CategoryService)
    {
        $CategoryService->DeleteCategoryService($category);
        return back()->with([
            'success' => 'the category has been deleted'
        ]);
    }
}
