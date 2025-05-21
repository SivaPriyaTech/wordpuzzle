<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'index'])->name('index');

Route::post('/register-student', [StudentController::class, 'register'])->name('register.student');
Route::post('/submit-words', [GameController::class, 'submit'])->name('submit.words');
Route::post('/logout', [StudentController::class, 'logout'])->name('logout');