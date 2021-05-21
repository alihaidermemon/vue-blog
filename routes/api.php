<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
 

// Blog
Route::group([
    'prefix' => 'blog'
], function () {
    Route::post('create', [BlogController::class, 'create']);
    Route::post('update', [BlogController::class, 'update']);
    Route::post('delete', [BlogController::class, 'delete']);
    Route::get('list', [BlogController::class, 'list']);
    Route::get('get', [BlogController::class, 'get']);
});
