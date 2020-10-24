<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use Illuminate\Validation\Rule;
use App\Imports\ProductsImport;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        if(!$products->count()) {
            return response([
                'products' => [],
                'message'  => 'No Products found!'
            ], 404);
        }

        return response([
            'products' => ProductResource::collection($products),
            'message'  => 'products retrieved'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'  => 'required|max:255',
            'price' => 'required|numeric',
            'sku'   => 'required|unique:products,sku',
            'description' => 'required'
        ]);

        if($validator->fails()) {
            return response([
                'message' => 'failed',
                'error' => $validator->errors()
            ], 400);
        }

        $product = Product::create($data);
        return response([
            'product' => new ProductResource($product),
            'message' => 'Product Created successfully'    
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response([ 'product' => new ProductResource($product), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'  => 'required|max:255',
            'price' => 'required|numeric',
            'sku'   => [
                'required',
                Rule::unique('products')
                ->ignore($product->id),
            ],
            'description' => 'required'
        ]);


        if($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'Validation Error'
            ]);
        }
 
        $product->update($request->all());

        return response([ 'product' => new ProductResource($product), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(!$product) {
            return response(['message' => 'Product Not found']);    
        }

        $product->delete();

        return response(['message' => 'Deleted']);
    }

    public function import(Request $request) {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx',
        ]);

        $data = Excel::import(new ProductsImport, request()->file('select_file'));
        $data = Excel::toArray(new ProductsImport, request()->file('select_file'));
        
        return response(['products' => $data, 'message' => 'Products Imported successfully']);
    }
}
