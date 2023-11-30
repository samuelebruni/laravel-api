<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/mailable', function(){
    $lead = App\Models\Lead::find(1);

    return new App\Mail\NewLeadEmail($lead);
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);
    Route::resource('technologies', TechnologyController::class)->parameters([
        'technologies' => 'technology:slug'
    ]);
    Route::resource('types', TypeController::class)->parameters([
        'types' => 'type:slug'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
