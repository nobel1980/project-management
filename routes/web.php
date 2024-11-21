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
    //Route::get('/issues/timeline', [IssueController::class, 'showTimeline'])->name('issues.timeline');
/*
    Route::get('/projects/index', [ProjectController::class, 'index'])->name('projects.index');
    //Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update'); // optional if PATCH is used separately
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    
  */  

    // Route::post('issues/{issue}/status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    
    
    // Route::get('/projects/{project}/issues/index', [IssueController::class, 'index'])->name('projects.issues.index');
    // Route::get('/projects/{project}/issues/create', [IssueController::class, 'create'])->name('projects.issues.create');
    // Route::post('/projects/{project}/issues', [IssueController::class, 'store'])->name('projects.issues.store');
    // Route::get('/projects/{project}/issues/{issue}', [IssueController::class, 'show'])->name('projects.issues.show');
    // Route::get('/projects/{project}/issues/{issue}/edit', [IssueController::class, 'edit'])->name('projects.issues.edit');
    // Route::put('/projects/{project}/issues/{issue}', [IssueController::class, 'update'])->name('projects.issues.update');
    // Route::patch('/projects/{project}/issues/{issue}', [IssueController::class, 'update'])->name('projects.issues.update'); // optional if PATCH is used separately
    // Route::delete('/projects/{project}/issues/{issue}', [IssueController::class, 'destroy'])->name('projects.issues.destroy');
    

    //Route::post('/issues/assign', [IssueController::class, 'assign'])->name('issues.assign');
    //Route::post('/issues/update-status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    // Route::resource('projects', ProjectController::class);
    // Route::resource('projects.issues', IssueController::class);
});

Route::middleware(['auth', 'role:Developer'])->group(function () {
    Route::get('/developer/dashboard', [DeveloperController::class, 'index'])->name('developer.dashboard');
    
    // Route::resource('projects', ProjectController::class);
    // Route::resource('projects', ProjectController::class)->only(['index', 'show']);
    // Route::resource('projects.issues', IssueController::class);
    // Route::post('issues/{issue}/status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    // Route::post('/issues/{id}/update-status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    // Route::get('/issues/timeline', [IssueController::class, 'showTimeline'])->name('issues.timeline');

}); 

Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
}); 

Route::middleware(['auth'])->group(function () {
    Route::post('/issues/{issue}/update-status', [IssueController::class, 'updateStatus']);
});

Route::middleware(['auth', 'role:Administrator,Developer'])->group(function () {
    Route::get('/issues/timeline', [IssueController::class, 'showTimeline'])->name('issues.timeline');
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.issues', IssueController::class);
});




