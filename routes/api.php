<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| ---------------------------------------------------+------------+
| Domain | Method    | URI                 | Name         | Action                                                     | Middleware |
+--------+-----------+---------------------+--------------+------------------------------------------------------------+------------+
|        | GET|HEAD  | /                   |              | Closure                                                    | web        |
|        | GET|HEAD  | api/post            | post.index   | App\Http\Controllers\API\PostController@index              | api        |
|        | POST      | api/post            | post.store   | App\Http\Controllers\API\PostController@store              | api        |
|        | GET|HEAD  | api/post/{post}     | post.show    | App\Http\Controllers\API\PostController@show               | api        |
|        | PUT|PATCH | api/post/{post}     | post.update  | App\Http\Controllers\API\PostController@update             | api        |
|        | DELETE    | api/post/{post}     | post.destroy | App\Http\Controllers\API\PostController@destroy            | api        |
|        | GET|HEAD  | sanctum/csrf-cookie |              | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web        |
+--------+-----------+---------------------+--------------+---------------------------------------------
*/

//Route::post('login', [AuthController::class, 'signin']);
/*Route::get('/ver',[App\Http\Controllers\API\PostController::class,'index']);
Route::get('/ver/{id}',[App\Http\Controllers\API\PostController::class,'show']);
Route::post('/ver',[App\Http\Controllers\API\PostController::class,'store']);
Route::patch('/ver/{id}',[App\Http\Controllers\API\PostController::class,'update']);


//Route::apiResource('ver', App\Http\Controllers\API\PostController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::apiResource('post',PostController::class);