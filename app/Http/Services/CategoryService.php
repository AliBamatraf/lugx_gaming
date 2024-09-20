<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function StoreCategoryService(Request $request)
    {
        //check the path of image
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('/images/categories', $request->image);
        }

        Category::create([
            'name' => $request->name,
            'image' => $path
        ]);
    }

    public function UpdateCategoryService(Request $request, Category $category)
    {
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
    }

    public function DeleteCategoryService(Category $category)
    {
        Storage::disk('public')->delete($category->image);

        $category->delete();
    }
}
