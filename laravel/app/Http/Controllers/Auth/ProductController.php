<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    // Get all products
    function getProducts(){
        return response() -> json(Product::all());
    }

    function createProduct( Request $request ){
        try{
            $request -> validate(
                [
                    'name' => 'required',
                    'price' => 'required',
                    'category_id' => 'required',
                    'images' => 'image|mimes:jpeg,png|max:2048',
                ]
            );
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            dd($imageName);
            $product = Product::create($request -> all());
            return response() -> json([
                'message' => 'Product created successfully',
                'product' => $product
            ], 201);
        }catch(Exception $error){
            return response() -> json([
                'message' => 'Product creation failed',
                'error' => $error -> getMessage()
            ], 500);
        }
    }

    function getActiveProducts(){
        $product = Product::where('active', 1)
        -> orderBy('name')
        -> take(10)
        ->get();
        
        return response() -> json($product);
    }
}
