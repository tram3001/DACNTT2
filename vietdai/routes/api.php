<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::controller(AuthController::class)->group(function(){
//     // Route::get('login','formlogin');
//     Route::post('login','login');
// });
Route::get('/login',[
    AuthController::class,'formlogin'
]);
Route::post('/login',[
    AuthController::class,'login'
]);

Route::middleware('checklogin')->group(function(){
    Route::get('/home',[
        AuthController::class,'home'
    ]);
});