<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    public function index()
    {
        //git comment is added
       return  ProductCollection::collection(Product::paginate(5));
    }


    public function create()
    {
        //
    }


    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->details = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->save();
        return response([
            'data' => new ProductResource($product)
        ], 201);
    }


    public function show(Product $product)
    {
       return new ProductResource($product);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        $request['details'] = $request->description;
        unset($request['description']);
        $product->update($request->all());
    }


    public function destroy(Product $product)
    {
        //
    }
}
