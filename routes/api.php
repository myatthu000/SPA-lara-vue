<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::get("product",[\App\Http\Controllers\ProductController::class,"index"]);
//Route::post("product",[\App\Http\Controllers\ProductController::class,"store"]);
//Route::get("product/{id}",[\App\Http\Controllers\ProductController::class,'show']);
//Route::put("product/{id}",[\App\Http\Controllers\ProductController::class,'update']);
//Route::delete("product/{id}",[\App\Http\Controllers\ProductController::class,'destroy']);

Route::apiResource("product",\App\Http\Controllers\ProductController::class);




//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
