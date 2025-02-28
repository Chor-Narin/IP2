<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    // --- Get /api/categories
    public function getCategories()
    {
        return response()->json(Category::all());
    }

    // --- Post /api/categories
    public function createCategory(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $category = Category::create($request->all());
            return response()->json([
                'message' => 'Category created Successfully',
                'category' => $category
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Category creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // --- Get /api/categories/{categoryId}
    public function getCategory($categoryId)
    {
        return ["message" => "Getting 1 category based on given categoryId: " . $categoryId];
    }

    // --- Patch /api/categories/{categoryId}
    public function updateCategory($categoryId)
    {
        return ["message" => "Updating 1 category base on given categoryId"];
    }

    // --- Delete /api/categories/{categoryId}
    public function deleteCategory($categoryId)
    {
        return ["message" => "Deleting 1 category base on given categoryId"];
    }
}