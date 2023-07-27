<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Models\about;
use App\Models\post;
use App\Models\website;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome', [
        'website' => website::all()->first(),
        'post' => post::with('kategori')->get()
    ]);
})->name('welcome');


Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resources([
        'website' => WebsiteController::class,
        'about' => AboutController::class,
        'kategori' => KategoriController::class,
        'post' => PostController::class,
    ]);
});

Route::view('/about', 'about', [
    'website' => website::first(),
    'about' => about::first()
])->name('about');
