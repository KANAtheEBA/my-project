<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StackController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [StackController::class, 'list'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('stack/create', [StackController::class, 'create'])->middleware(['auth'])->name('stack.create');
Route::post('post', [StackController::class, 'store'])->name('stack.store');
Route::get('stack/list', [StackController::class, 'list'])->middleware('auth')->name('stack.list');
Route::get('stack/show/{game}', [StackController::class, 'show'])->name('game.show');

Route::get('stack/{game}/edit', [StackController::class, 'edit'])->name('game.edit');
Route::patch('stack/{game}', [StackController::class, 'update'])->name('game.update');
Route::delete('stack/{game}', [StackController::class, 'destroy'])->name('game.destroy');

require __DIR__.'/auth.php';
