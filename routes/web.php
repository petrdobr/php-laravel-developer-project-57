<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Idea is to force https in the form's actions
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
});
Route::resource('task_statuses', TaskStatusController::class);
Route::resource('tasks', TaskController::class);
/*
Route::get('/task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses.index');
Route::get('/task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
Route::post('/task_statuses', [TaskStatusController::class, 'store'])->name('task_statuses.store');
Route::get('/task_statuses/{id}/edit', [TaskStatusController::class, 'edit'])->name('task_statuses.edit');
Route::patch('/task_statuses', [TaskStatusController::class, 'update'])->name('task_statuses.update');
Route::delete('/task_statuses/{id}', [TaskStatusController::class, 'destroy'])->name('task_statuses.destroy');
//Route::get('/task_statuses/{id}', [TaskStatusController::class, 'show']);
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
