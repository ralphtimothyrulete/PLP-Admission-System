<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmissionController;

//Navigation
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('layout', function () {
    return view('components.layout'); 
})->name('layout');

Route::get('/admission', function () {
    return view('admission');
});

Route::get('/admission-req', function () {
    return view('admission-req');
});

//Admission Form
Route::get('/admission', function () {
    return view('admission');
})->name('admission');

Route::get('/admissionform2', function () {
    return view('admissionform2');
})->name('admissionform2');

Route::get('/req-strand', function () {
    return view('req-strand');
})->name('req-strand');

Route::post('/submit-application', [AdmissionController::class, 'submitApplication'])->name('submit-application');

//Requirements
Route::get('/freshmen-reqs', function () {
    return view('freshmen-reqs');
})->name('freshmen-reqs');

Route::post('/freshmen/upload', [App\Http\Controllers\FreshmenController::class, 'upload'])->name('freshmen.upload');

Route::get('/transferee-reqs', function () {
    return view('transferee-reqs');
})->name('transferee-reqs');

Route::post('/transferee/upload', [App\Http\Controllers\TransfereeController::class, 'upload'])->name('transferee.upload');

//Login and Register
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
 
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('layout', function () {
        return view('layout');
    })->name('layout');

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});
