<?php

use App\Http\Controllers\TransfereeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\AdmissionFormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\FreshmenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\PredictionController;

//Navigation


Route::get('layout', function () {
    return view('components.layout'); 
})->name('layout');

// Admission routes for users
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('layout', function () {
        return view('layout');
    })->name('layout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/admission', [AdmissionController::class, 'index'])->name('admission.index');
    Route::get('/admissionform2', [AdmissionController::class, 'form2'])->name('admissionform2.index');
    Route::post('/admission', [AdmissionController::class, 'store'])->name('admission.store');
    Route::post('/submit-application', [AdmissionController::class, 'submitApplication'])->name('submit-application');
    Route::get('/req-strand', function () {
    return view('req-strand');
    })->name('req-strand');    
    Route::get('/admission-req', function () {
        return view('admission-req');
    });
    Route::get('/freshmen-reqs', function () {
        return view('freshmen-reqs');
    })->name('freshmen-reqs');
    Route::get('/freshmen-reqs.index', [FreshmenController::class, 'index'])->name('freshmen-reqs.index');
    Route::post('/freshmen.upload', [FreshmenController::class, 'upload'])->name('freshmen.upload');
    Route::get('/transferee-reqs', function () {
        return view('transferee-reqs');
    })->name('transferee-reqs');
    Route::get('/transferee-reqs.index', [TransfereeController::class, 'index'])->name('transferee-reqs.index');
    Route::post('/transferee.upload', [TransfereeController::class, 'upload'])->name('transferee.upload');
});

// Dashboard routes for admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//Dashboard and Analytics
    Route::get('/admin/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/admin/analytics/data', [AnalyticsController::class, 'getData'])->name('analytics.data');
// Application Forms routes
    Route::get('/application-forms', [AdmissionController::class, 'applicationFormsIndex'])->name('application-forms.index');
    Route::get('/application-forms/{id}', [AdmissionController::class, 'applicationFormsShow'])->name('application-forms.show');
    Route::get('/application-forms/{id}/edit', [AdmissionController::class, 'applicationFormsEdit'])->name('application-forms.edit');
    Route::put('/application-forms/{id}', [AdmissionController::class, 'applicationFormsUpdate'])->name('application-forms.update');
    Route::delete('/application-forms/{id}', [AdmissionController::class, 'applicationFormsDestroy'])->name('application-forms.destroy');
});

//Login and Register Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

//Logout Route
    Route::get('logout', 'logout')->middleware('auth')->name('logout');

//Email Verification Notice
Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');

//Email Verification Handler 
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

//Resending the Verification Email
Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Forgot Password Routes
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});

//Emails
Route::get('/send-entrance-exam-email', [EmailController::class, 'sendEntranceExamEmail']);
Route::get('/send-entrance-exam-passed-email', [EmailController::class, 'sendEntranceExamPassedEmail']);
Route::get('/send-enrollment-slot-offering-email', [EmailController::class, 'sendEnrollmentSlotOfferingEmail']);
Route::get('/send-requirements-submission-email', [EmailController::class, 'sendRequirementsSubmissionEmail']);

//Notifications
Route::get('/send-deadline-notification/{student_id}', [EmailController::class, 'sendAdmissionDeadlineNotification']);
Route::get('/admission-update', [AdmissionController::class, 'triggerAdmissionUpdate']);

Route::get('/export-data', [App\Http\Controllers\DataExportController::class, 'exportData']);


