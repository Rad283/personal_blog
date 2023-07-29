<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Models\about;
use App\Models\post;
use App\Models\website;
use Illuminate\Support\Facades\DB;
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
        'website' => DB::table('websites')->first(),

        'post' => DB::table('posts')
            ->join('kategoris', 'posts.kategori_id', '=', 'kategoris.id')
            ->select('posts.*', 'kategoris.nama')->latest()->get()
    ]);
})->name('welcome');

Route::view('/about', 'about', [
    'website' => DB::table('websites')->first(),
    'about' => DB::table('abouts')->first()
])->name('about');


Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'post' => post::latest()->get()
        ]);
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resources([
        'website' => WebsiteController::class,
        'about' => AboutController::class,
        'kategori' => KategoriController::class,
    ]);
    Route::resource('post', PostController::class)->except(['show']);
});

Route::get('post/detail/{post}', [PostController::class, 'show'])->name('post.show');
