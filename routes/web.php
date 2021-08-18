<?php

use App\Http\Controllers\Upwork\UpworkController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/pipedrive/deal/add', [\App\Http\Controllers\Pipedrive\DealController::class, 'add'])->name('pipedrive.deal.add');
    Route::get('/auth/upwork', [\App\Http\Controllers\Auth\UpworkController::class, 'index'])->name('auth.upwork');
    Route::get('/auth/callback', [\App\Http\Controllers\Auth\UpworkController::class, 'callback'])->name('auth.upwork.callback');
    Route::get('/auth/callback/console', [\App\Http\Controllers\Auth\UpworkController::class, 'console'])->name('auth.upwork.callback.console');
    Route::get('/upwork/jobs', [UpworkController::class, 'search'])->name('upwork.jobs.index');
    Route::get('/filters', [UpworkController::class, 'filters'])->name('filters');
});

Route::get('/auth/pipedrive', [\App\Http\Controllers\Auth\PipedriveController::class, 'index'])->name('auth.pipedrive')->middleware('guest');
Route::get('/auth/pipedrive/callback', [\App\Http\Controllers\Auth\PipedriveController::class, 'callback'])->name('auth.pipedrive.callback')->middleware('guest');
