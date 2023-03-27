<?php

use App\Http\Controllers\IndependentProducerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group([
    'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/blank', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');

//routes for ipp CRUD
    Route::group([
        'prefix' => '/independent-producer',
        'as' =>'independent-producer.',
    ], function () {

        Route::get('/index', [IndependentProducerController::class, 'index'])->name('index');
        Route::get('/create', [IndependentProducerController::class, 'create'])->name('create');
        // Route::get('/independent-producer/import',  [\App\Http\Controllers\IndependentProducerController::class, 'importexcel'])->name('import');
        Route::get('/show/{item}', [IndependentProducerController::class, 'show'])->name('show');
        Route::get('/edit/{item}', [IndependentProducerController::class, 'edit'])->name('edit');
        Route::post('/update/{item}', [IndependentProducerController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [IndependentProducerController::class, 'destroy'])->name('destroy');
        Route::post('/store', [IndependentProducerController::class, 'store'])->name('store');


    });


    //routes for adding users
    Route::get('/users/index', [UserController::class, 'index'])->name('user.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/search', [UserController::class, 'getEmployeeData'])->name('api.search.employee');

});
