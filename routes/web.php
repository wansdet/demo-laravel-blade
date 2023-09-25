<?php

use App\Events\PlaygroundEvent;
use App\Http\Controllers\Admin\AdminBlogPostController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('blog')->middleware('auth')->group(function () {
    Route::get('/my-posts', [BlogPostController::class, 'bloggerIndex'])->name('blog.bloggerIndex');
    Route::get('/admin', [AdminBlogPostController::class, 'adminIndex'])->name('blog.adminIndex');

    Route::get('/create', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/create', [BlogPostController::class, 'store'])->name('blog.store');

    Route::post('/blogger/export-report', [BlogPostController::class, 'exportBloggerReport'])->name('blog.exportBloggerReport');
    Route::post('/admin/export-report', [AdminBlogPostController::class, 'exportAdminReport'])->name('blog.exportAdminReport');

    Route::get('/{blogPost}/show-blogger', [BlogPostController::class, 'showBlogger'])->name('blog.showBlogger');
    Route::get('/{blogPost}/show-admin', [AdminBlogPostController::class, 'showAdmin'])->name('blog.showAdmin');
    Route::get('/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');

    Route::get('/{blogPost}/manage', [AdminBlogPostController::class, 'manage'])->name('blog.manage');
    Route::put('/{blogPost}/submit', [BlogPostController::class, 'submit'])->name('blog.submit');
    Route::put('/{blogPost}/reject', [AdminBlogPostController::class, 'reject'])->name('blog.reject');
    Route::put('/{blogPost}/publish', [AdminBlogPostController::class, 'publish'])->name('blog.publish');
    Route::put('/{blogPost}/archive', [AdminBlogPostController::class, 'archive'])->name('blog.archive');

    Route::put('/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
    Route::delete('/{blogPost}', [AdminBlogPostController::class, 'destroy'])->name('blog.destroy');
});

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogPostController::class, 'index'])->name('blog.index');
    Route::get('/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
});

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/files', [UserController::class, 'indexUserFiles'])->name('user.files');
    Route::get('/files/{filename}/{extension}', [UserController::class, 'downloadFile'])->name('user.downloadFile');
});

require __DIR__.'/auth.php';
