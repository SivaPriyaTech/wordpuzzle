<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::post('/register-student', [StudentController::class, 'register'])->name('register.student');


