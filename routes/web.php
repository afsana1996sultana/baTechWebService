<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\FrontendController;
use \App\Http\Controllers\SettingController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\InformationController;
use \App\Http\Controllers\StaffController;
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
Route::get('/',[FrontendController::class,'login'])->name('index');
Route::get('/csv-file',[FrontendController::class,'csvFile'])->name('csvFile');

Route::get('/login',[FrontendController::class,'login'])->name('frontend.login');
Route::post('/login-check',[FrontendController::class,'loginCheck'])->name('frontend.loginCheck');

Route::middleware(['auth:web'])->group(function(){

    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::post('/logout', [FrontendController::class,'logout'])->name('logout');

    //Profile Update
    Route::prefix('profile')->name('profile.')->group(function (){
        Route::get('/',[AdminController::class,'index'])->name('index');
        Route::post('/update-profile',[AdminController::class,'updatePro'])->name('update');
        Route::post('/update-password',[AdminController::class,'updatePass'])->name('updatePass');
    });

  //Dashboard
    Route::prefix('all-information')->name('all-information.')->group(function (){
        Route::get('/',[DashboardController::class,'index'])->name('index');
    });


    //Information Data
    Route::prefix('information')->name('information.')->group(function (){
        Route::get('/',[InformationController::class,'index'])->name('index');
        Route::post('/import', [InformationController::class, 'import'])->name('import');
        Route::get('/Print', [InformationController::class, 'information_Print'])->name('Print');
        Route::get('/multiple/informationprint/page', [InformationController::class, 'multiple_information_print_page'])->name('multiple.informationprint.page');
        Route::delete('/delete', [InformationController::class, 'delete'])->name('delete');
        Route::delete('/delete-all', [InformationController::class, 'deleteAll'])->name('delete.all');
    });


    //Category
    Route::prefix('category')->name('category.')->group(function (){
        Route::get('/',[CategoryController::class,'index'])->name('index');
        Route::get('/create',[CategoryController::class,'create'])->name('create');
        Route::post('/store',[CategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[CategoryController::class,'update'])->name('update');
        Route::get('/delete/{id}',[CategoryController::class,'destroy'])->name('delete');

    });

    //Product
     Route::prefix('product')->name('product.')->group(function (){
        Route::get('/',[ProductController::class,'index'])->name('index');
        Route::get('/create',[ProductController::class,'create'])->name('create');
        Route::post('/store',[ProductController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[ProductController::class,'update'])->name('update');
        Route::get('/delete/{id}',[ProductController::class,'destroy'])->name('delete');

    });

    //Staff
    Route::prefix('staffs')->name('staff.')->group(function (){
        Route::get('/',[StaffController::class,'index'])->name('index');
        Route::get('/create',[StaffController::class,'create'])->name('create');
        Route::post('/store',[StaffController::class,'store'])->name('store');
        Route::get('/edit/{id}',[StaffController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[StaffController::class,'update'])->name('update');
        Route::get('/delete/{id}',[StaffController::class,'delete'])->name('delete');
    });

    //Setting
    Route::prefix('setting')->name('setting.')->group(function (){
        Route::get('/',[SettingController::class,'index'])->name('index');
        Route::post('/store',[SettingController::class,'store'])->name('store');
    });

});



