<?php

use App\Http\Controllers\ConnectionPointsController;
use App\Http\Controllers\DistrictsController;
use App\Http\Controllers\IndependentProducerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentureController;
use App\Models\ConnectionPoints;
use Illuminate\Support\Facades\Auth;
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

Route::group([ 'middleware' => 'auth'  ],   function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('blank', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');


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
    Route::post('store', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::post('search', [\App\Http\Controllers\UserController::class, 'getStaffDetails'])->name('user.search');
    Route::get('create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::get('show', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');




    Route::get('/reports/index', [ReportsController::class, 'index'])->name('reports.index');

    Route::get('/province/index', [ProvinceController::class, 'index'])->name('province.index');
    Route::post('/province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('/province/show/{id}/{district}', [ProvinceController::class, 'show'])->name('province.show');

    Route::post('/districts/store', [DistrictsController::class, 'store'])->name('districts.store');

    Route::post('/node/store', [ConnectionPointsController::class, 'store'])->name('node.store');


    Route::get('/status/index', [StatusController::class, 'index'])->name('status.index');
    Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');
    Route::post('/destroy/{id}', [StatusController::class, 'destroy'])->name('status.destroy');





    Route::get('/reports', [ReportsController::class, 'create'])->name('graphical.reports');

    Route::get('/technology', [TechnologyController::class, 'index'])->name('technology.index');
    Route::post('/technology/store', [TechnologyController::class, 'store'])->name('technology.store');

    Route::get('/ventures', [VentureController::class, 'index'])->name('venture.index');
    Route::post('/ventures/store', [VentureController::class, 'store'])->name('venture.store');

});
