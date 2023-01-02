<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::orderBy('created_at')->get());
        return response()->json($products);
    }
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'detail' => $request->input('detail')
        ]);
        return response()->json('Product created!');
    }
    public function show($id)
    {
        $product = new ProductResource(Product::find($id));
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json('Product updated!');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product deleted!');
    }
}
