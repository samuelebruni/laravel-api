<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\API\TechnologyController;
use App\Http\Controllers\API\LeadController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('project', [ProjectController::class,'index']);
Route::get('project/latest',[ProjectController::class, 'latest' ]);
Route::get('project/{project:slug}', [ProjectController::class, 'show']);

Route::get('type',[TypeController::class, 'index']);

Route::get('technology',[TechnologyController::class, 'index']);

Route::post('/contacts', [LeadController::class, 'store']);

