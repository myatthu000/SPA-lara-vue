<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return $product;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
//        $request->validate([
//            'name'=>'required|string|min:3',
//            'price'=>'required|numeric|min:10'
//        ],[
//            'name.required'=>"အမည်ထည့်ရန်လိုအပ်သည်။",
//            'name.string'=>"အမည်ထည့်ရန်လိုအပ်သည်။",
//            'price.required'=>"ဈေးနှုန်းထည့်ရန်လိုအပ်သည်။"
//        ]);

        $product = Product::create($request->only('name','price'));
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Product|\Illuminate\Http\Response
     */
    public function show(Product $product)
    {
//        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Product|\Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

//        $product = Product::find($id);
        $product->update($request->only("name","price"));

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Product|\Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
//        $product = Product::find($id);
        $product->delete();
        return $product;

    }
}
