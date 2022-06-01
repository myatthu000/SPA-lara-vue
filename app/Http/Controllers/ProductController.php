<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
//        if ($request->search)
//        {
//            return Product::where('name','like','%'.$request->search.'%')
//                ->orderBy("id","desc")->get();
//
//        }else{
//            return Product::orderBy("id","desc")->get();
//        }

//        $product = Product::query();
//        if (request('search'))
//        {
//            return $product->where('name','like','%'.request("search").'%')
//                ->orderBy("id","desc")->get();
//        }else{
//            return  $product->orderBy("id","desc")->get();
//        }

        return Product::when(request('search'),function ($query){
            $query->where('name','like','%'.request("search").'%');
        })->orderBy("id","desc")->paginate(5);



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
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
