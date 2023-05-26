<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);

//post
Route::post('create/categories',[RouteController::class,'categoryCreate']);
Route::post('create/content',[RouteController::class,'contentCreate']);
//delete
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);
Route::get('category/list/{id}',[RouteController::class,'categoryDetail']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);

