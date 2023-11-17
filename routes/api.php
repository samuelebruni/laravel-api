<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('project', function () {
    return response()->json([
        'success' => true,
        'result' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(12)
    ]);
});

Route::get('type', function () {
    return response()->json([
        'status' => 'success',
        'result' => App\Models\Type::all()
    ]);
});


Route::get('technology', function () {
    return response()->json([
        'status' => 'success',
        'result' => App\Models\Technology::all()
    ]);
});