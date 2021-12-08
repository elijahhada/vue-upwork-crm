<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Upwork\UpworkController;
use App\Http\Controllers\TimetableController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FilterController;

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

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //    Route::get('/dashboard/socket-event', [DashboardController::class, 'deleteJob']);

    Route::resource('jobs', JobsController::class);
    Route::post('/jobs/change-status', [JobController::class, 'changeStatus'])->name('jobs.change-status');
    Route::post('/jobs/delete', [JobController::class, 'delete'])->name('jobs.delete');
    Route::post('/jobs/filter', [JobController::class, 'filter'])->name('jobs.filter');
    Route::get('/pipedrive/deal/add', [\App\Http\Controllers\Pipedrive\DealController::class, 'add'])->name('pipedrive.deal.add');
    Route::get('/auth/upwork', [\App\Http\Controllers\Auth\UpworkController::class, 'index'])->name('auth.upwork');
    Route::get('/auth/callback', [\App\Http\Controllers\Auth\UpworkController::class, 'callback'])->name('auth.upwork.callback');
    Route::get('/auth/callback/console', [\App\Http\Controllers\Auth\UpworkController::class, 'console'])->name('auth.upwork.callback.console');
    Route::get('/upwork/jobs', [UpworkController::class, 'search'])->name('upwork.jobs.index');
    Route::get('/upwork/jobsprofile/{id}', function ($id) {
        $service = new \App\Services\UpworkJobsProfileService();
        dd($service->getJobProfiles($id));
    })->name('upwork.jobs.profile');
    Route::get('/filters', [UpworkController::class, 'filters'])->name('filters');

    Route::post('/add-filter', [FilterController::class, 'create']);
    Route::post('/update-filter', [FilterController::class, 'update']);
    Route::post('/remove-filter', [FilterController::class, 'destroy']);

    Route::get('/calendar/dayTimes/{day?}', [TimetableController::class, 'dayTimes']);
    Route::get('/calendar/dayUsers/{day?}', [TimetableController::class, 'dayUsers']);
    Route::get('/calendar/itemUsers/{data}', [TimetableController::class, 'itemUsers']);
    Route::get('/calendar/userHour/{time}', [TimetableController::class, 'userHour']);
    Route::get('/calendar/currentWeek/{data}', [TimetableController::class, 'currentWeek']);
});

Route::get('/auth/pipedrive', [\App\Http\Controllers\Auth\PipedriveController::class, 'index'])
    ->name('auth.pipedrive')
    ->middleware('guest');
Route::get('/auth/pipedrive/callback', [\App\Http\Controllers\Auth\PipedriveController::class, 'callback'])
    ->name('auth.pipedrive.callback')
    ->middleware('guest');
Route::get('/pipedrive/user-info', [\App\Http\Controllers\JobController::class, 'info']);
Route::get('/jobs/get-job/{id}', [\App\Http\Controllers\JobController::class, 'getJob']);
Route::post('/pipedrive/store-deal', [\App\Http\Controllers\JobController::class, 'storeDeal']);
