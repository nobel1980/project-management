<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\UserController;
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
    return view('auth/login');
    //return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    Route::post('/issues/assign', [IssueController::class, 'assign'])->name('issues.assign');
    Route::post('/issues/update-status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
});
/*
Route::get('/admin', [AdminController::class, 'index'])->middleware('role:Administrator');
Route::get('/developer', [DeveloperController::class, 'index'])->middleware('role:Developer');
Route::get('/user', [UserController::class, 'index'])->middleware('role:User');
*/
Route::resource('projects', ProjectController::class);
Route::resource('projects.issues', IssueController::class);

// Route::prefix('projects/{project}')->group(function () {
//     Route::resource('issues', IssueController::class);
// });
