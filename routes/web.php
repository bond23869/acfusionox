<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Actions\Fortify\RedirectToGoogle;
use App\Actions\Fortify\HandleGoogleCallback;
use App\Http\Controllers\GoogleOAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleDocsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // google docs
    Route::get('/google-docs/sync-initiate', [GoogleDocsController::class, 'syncInitiate'])->name('google-docs.sync-initiate');
    Route::get('/google-docs/callback', [GoogleDocsController::class, 'handleGoogleCallback'])->name('google-docs.callback');
    Route::get('/google-docs/list', [GoogleDocsController::class, 'showDocsList'])->name('google-docs.list');


    Route::post('/api/fetch-google-docs', [GoogleDocsController::class, 'fetchDocs']);


});



Route::get('login/google', [GoogleOAuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleOAuthController::class, 'handleGoogleCallback']);



require __DIR__.'/auth.php';
