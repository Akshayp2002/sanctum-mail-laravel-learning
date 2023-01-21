<?php

use App\Http\Controllers\UserController;
// use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

// Route::group(['middleware' => 'auth:sanctum'], function(){
//     Route::get('test', function () {
//         return User::get();
//     });
//     });
// Route::post('login',[UserController::class , 'index']);
// Route::post('login', [App\Http\Controllers\Api\Logincontroller::class, 'login']);



Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::get('getproduct', [App\Http\Controllers\Api\ProductController::class, 'view_products']);
Route::post('saveproduct', [App\Http\Controllers\Api\ProductController::class, 'save_product']);
Route::post('update/{id}', [App\Http\Controllers\Api\ProductController::class, 'update']);
Route::get('deleteproduct/{id}', [App\Http\Controllers\Api\ProductController::class, 'delete']);


Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');



Route::get('send-verify-mail/{email}', [App\Http\Controllers\Api\AuthController::class, 'sendVerifyMail']);


Route::get('admin', [App\Http\Controllers\Api\AuthController::class, 'admin']);
