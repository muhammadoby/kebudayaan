<?php

use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SigninController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CultureCommentController;
use App\Http\Controllers\CultureCommentReportController;
use App\Http\Controllers\CultureReportController;
use App\Http\Controllers\EventCommentController;
use App\Http\Controllers\EventCommentReportController;
use App\Http\Controllers\EventReportController;
use App\Http\Controllers\CultureViewController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => Inspiring::quotes()[rand(0, 39)],
        'code' => 200
    ], 200);
});

Route::prefix(env("API_VERSION"))->group(function () {

    Route::middleware('guest')->group(function() {
        Route::post('contactus', [ContactController::class, 'contactUs'])->name('api.contactus');
        Route::post('signin', [SigninController::class, 'auth'])->name('api.signin');
        Route::post('signup', [RegisterController::class, 'register'])->name('api.signup');
        Route::post('forgot-password', [ForgotPasswordController::class, 'send'])->name('user')->middleware('throttle:6,1');
        Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password')->middleware('throttle:6,1');
    });
    
    Route::middleware('auth:santum')->group(function () {
        Route::post('culture-view', [CultureViewController::class, 'add']);
        Route::resource('event-report', EventReportController::class)->except(['index', 'show']);
        Route::resource('culture-report', CultureReportController::class)->except(['index', 'show']);
        Route::resource('culture-comment', CultureCommentController::class)->except(['index', 'show']);
        Route::resource('culture-comment-report', CultureCommentReportController::class)->except(['index']);
        Route::resource('event-comment', EventCommentController::class)->except(['index', 'show']);
        Route::resource('event-comment-report', EventCommentReportController::class)->except(['index']);
    });

    Route::get('culture-view/{id}', [CultureViewController::class, 'show']);
    Route::get('culture-report/{id}', [CultureReportController::class, 'show']);
    Route::get('culture-comment/{id}', [CultureCommentController::class, 'show']);
    Route::get('event-report/{id}', [EventReportController::class, 'show']);
    Route::get('event-comment/{id}', [EventCommentController::class, 'show']);
});

require __DIR__ . '/api/auth/auth.php';