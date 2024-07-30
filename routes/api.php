<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::controller(AuthController::class)->group(function(){

//     Route::post('/register','register');
// });

Route::post('/register',[AuthController::class , 'register']);
Route::get('/dummy-api',function(){
    return response()->json('Hello Worlds');
});

Route::get('/v1-details',[AuthController::class,'version']);
Route::post('/signup',[AuthController::class,'signup']);


