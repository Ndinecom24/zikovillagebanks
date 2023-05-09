<?php

use App\Http\Controllers\DistrictsController;
use App\Http\Controllers\IndependentProducerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ReportsController;
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
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/search', [UserController::class, 'getEmployeeData'])->name('api.search.employee');
    Route::get('/getManNumbers', [UserController::class, 'getManNumbers'])->name('getManNumbers');
    Route::get('/getOfficerResponsibleNumbers', [UserController::class, 'getOfficerResponsibleNumbers'])->name('getOfficerResponsibleNumbers');
    Route::get('/getManNumber', [UserController::class, 'getManNumber'])->name('getManNumber');
    Route::get('/getEmployees', [UserController::class, 'getEmployees'])->name('getEmployees');
    Route::get('/getEmployee', [UserController::class, 'getEmployee'])->name('getEmployee');

    //routes for reports
    Route::get('/reports/index', [ReportsController::class, 'index'])->name('reports.index');

    Route::get('/province/index', [ProvinceController::class, 'index'])->name('province.index');
    Route::post('/province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('/province/show', [ProvinceController::class, 'show'])->name('province.show');


    Route::post('/districts/store', [DistrictsController::class, 'store'])->name('districts.store');
});
