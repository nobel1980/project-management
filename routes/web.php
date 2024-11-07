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

Route::get('/home', function () {
    return view('admin.dashboard');
    //return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//Route::resource('projects', ProjectController::class)->middleware(['auth', 'role:Administrator']);

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.issues', IssueController::class);
    Route::post('issues/{issue}/status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    // Route::post('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::get('/projects/index', [ProjectController::class, 'index'])->name('projects.index');
    // Route::get('/projects/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    //Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    //Route::post('/issues/assign', [IssueController::class, 'assign'])->name('issues.assign');
    //Route::post('/issues/update-status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    // Route::resource('projects', ProjectController::class);
    // Route::resource('projects.issues', IssueController::class);
});

Route::middleware(['auth', 'role:Developer'])->group(function () {
    Route::get('/developer/dashboard', [DeveloperController::class, 'index'])->name('developer.dashboard');
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.issues', IssueController::class);
    Route::post('issues/{issue}/status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
}); 

Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
}); 





