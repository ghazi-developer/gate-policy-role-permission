<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserValid;
use App\Http\Middleware\ValidUser;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/permission/added',[PermissionController::class,'index'])->name('permssions');
    Route::get('permission/create',[PermissionController::class,'create'])->name('permit');
    Route::post('/permission',[PermissionController::class,'store'])->name('permission.create');

    Route::delete('/permission/delete{id}',[PermissionController::class,'delete'])->name('permission.delete');


    Route::get('/permission/edit{id}',[PermissionController::class,'edit'])->name('permission.edit');

    Route::put('/permission/update{id}',[PermissionController::class,'update'])->name('permission.update');



    // Roles Routes
    
    Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
    Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
    Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
    Route::get('/role/edit{id}',[RoleController::class,'edit'])->name('edit.role');
    Route::delete('/roles/delete{id}',[RoleController::class,'destroy'])->name('delete.roles');
    Route::put('/roles/update{id}',[RoleController::class,'update'])->name('role.update');


    // Route for Article

    Route::get('/article',[ArticleController::class,'index'])->name('index.article');
    Route::get('/article/create',[ArticleController::class,'create'])->name('create.article');
    Route::post('/article/store',[ArticleController::class,'store'])->name('article.store');
    Route::delete('/article/delete{id}',[ArticleController::class,'destroy'])->name('article.delete');
    Route::get('/article/edit{id}',[ArticleController::class,'edit'])->name('edit.article');
    Route::put('/article/update{id}',[ArticleController::class,'update'])->name('update.article');


    // Route for Users

    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::get('/user/edit{id}',[UserController::class,'edit'])->name('edit.user');
    Route::post('/user/update{id}',[UserController::class,'update'])->name('update.user');


});

// Route::get('/dashboard',[DashboardController::class,'index'])->middleware(UserValid::class);

require __DIR__.'/auth.php';
