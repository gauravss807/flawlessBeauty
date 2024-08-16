<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;

Route::get('/register',function()
{
    return view('admin.pages.register');
})->name('register');

Route::post('/save',[UserController::class,'register'])->name('register_save');

Route::get('/login',function()
{
    return view('admin.pages.login');
})->name('login');

Route::post('/login_check',[UserController::class,'login_check'])->name('login_match');

Route::get('/',function()
{
    $title = 'Dashboard - Flawless Beauty';
    return view('admin.pages.dashboard',compact('title'));
})->name('dashboard')->middleware(ValidUser::class);

Route::get('logout',[UserController::class,'logout'])->name('logout');

Route::prefix('/admin')->group(function(){
    Route::get('/users',[UserController::class,'index'])->name('user.listing');
    Route::get('/user/create',[UserController::class,'create'])->name('user.create');
    Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
});