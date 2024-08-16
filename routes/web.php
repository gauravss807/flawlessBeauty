<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/',function()
{
    return view('admin.pages.login');
});

Route::get('/register',function()
{
    return view('admin.pages.register');
})->name('register');

Route::post('/register_save',[UserController::class,'register'])->name('register_save');
