<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Forntend\CategoryController as ForntendCategoryController;
use App\Http\Controllers\Forntend\MenuController as ForntendMenuController;
use App\Http\Controllers\Forntend\ReseravtionController;
use App\Http\Controllers\Forntend\WelcomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categoies', [ForntendCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [ForntendCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [ForntendMenuController::class, 'index'])->name('menus.index');
Route::get('/reservation/step-one', [ReseravtionController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [ReseravtionController::class, 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [ReseravtionController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservation/step-two', [ReseravtionController::class, 'storeStepTwo'])->name('reservations.store.step.two');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservation', ReservationController::class);
});
require __DIR__ . '/auth.php';
