<?php

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\PrisonerController;
use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileAvatarController;
use App\Http\Controllers\Profile\ProfileInformationController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
})->name('home');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','verified'])->name('dashboard');



Route::middleware(['auth', 'verified'])->group(function ()
{


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/profile', [ProfileInformationController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileInformationController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('user-password.update');
    Route::put('/user-avatar', [ProfileAvatarController::class, 'update'])->name('user-avatar.update');

    Route::get('/directors', [DirectorController::class, 'index'])->name('director.index');
    Route::get('/directors/create', [DirectorController::class, 'create'])->name('director.create');
    Route::post('/directors/create', [DirectorController::class, 'store'])->name('director.store');
    Route::get('/directors/{user}', [DirectorController::class, 'show'])->name('director.show');
    Route::get('/directors/update/{user}', [DirectorController::class, 'edit'])->name('director.edit');
    Route::put('/directors/update/{user}', [DirectorController::class, 'update'])->name('director.update');
    Route::get('/directors/destroy/{user}', [DirectorController::class, 'destroy'])->name('director.destroy');

    Route::get('/prisoners', [PrisonerController::class, 'index'])->name('prisoner.index');
    Route::get('/prisoners/create', [PrisonerController::class, 'create'])->name('prisoner.create');
    Route::post('/prisoners/create', [PrisonerController::class, 'store'])->name('prisoner.store');
    Route::get('/prisoners/{user}', [PrisonerController::class, 'show'])->name('prisoner.show');
    Route::get('/prisoners/update/{user}', [PrisonerController::class, 'edit'])->name('prisoner.edit');
    Route::put('/prisoners/update/{user}', [PrisonerController::class, 'update'])->name('prisoner.update');
    Route::get('/prisoners/destroy/{user}', [PrisonerController::class, 'destroy'])->name('prisoner.destroy');


    Route::get('/guards', [GuardController::class, 'index'])->name('guard.index');
    Route::get('/guards/create', [GuardController::class, 'create'])->name('guard.create');
    Route::post('/guards/create', [GuardController::class, 'store'])->name('guard.store');
    Route::get('/guards/{user}', [GuardController::class, 'show'])->name('guard.show');
    Route::get('/guards/update/{user}', [GuardController::class, 'edit'])->name('guard.edit');
    Route::put('/guards/update/{user}', [GuardController::class, 'update'])->name('guard.update');
    Route::get('/guards/destroy/{user}', [GuardController::class, 'destroy'])->name('guard.destroy');

});




require __DIR__.'/auth.php';
