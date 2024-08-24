<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController,VendorController,ServicesController};
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

Route::prefix('/admin')->middleware(ValidUser::class)->group(function(){
    Route::get('/vendors',[VendorController::class,'index'])->name('vendor.listing');
    Route::get('/vendor/create',[VendorController::class,'create'])->name('vendor.create');
    Route::get('/vendor/edit/{id}',[VendorController::class,'edit'])->name('vendor.edit');
    Route::post('/vendor/store',[VendorController::class,'store'])->name('vendor.store');
    Route::delete('/vendor/delete',[VendorController::class,'destroy'])->name('vendor.delete');
});

Route::prefix('/admin')->middleware(ValidUser::class)->group(function(){
    Route::get('/services',[ServicesController::class,'index'])->name('service.listing');
    Route::get('/service/create',[ServicesController::class,'create'])->name('service.create');
    Route::get('/service/edit/{id}',[ServicesController::class,'edit'])->name('service.edit');
    Route::post('/service/store',[ServicesController::class,'store'])->name('service.store');
    Route::delete('/service/delete',[ServicesController::class,'destroy'])->name('service.delete');
    
    Route::get('/service/{id}/hot_deal',[ServicesController::class,'hotDealListing'])->name('service.hot_deal.listing');
});