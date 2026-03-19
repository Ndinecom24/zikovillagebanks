<?php

use App\Http\Controllers\ConnectionPointsController;
use App\Http\Controllers\DistrictsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
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
    Route::get('/', \App\Http\Livewire\Dashboard\Dashboard::class);
    Route::get('home', \App\Http\Livewire\Dashboard\Dashboard::class)->name('home');
    Route::get('blank', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');


//routes for ipp CRUD (Livewire)
    Route::get('/independent-producer/index', \App\Http\Livewire\Producers\ProducerList::class)->name('independent-producer.index');
    Route::get('/independent-producer/show/{id}', \App\Http\Livewire\Producers\ProducerShow::class)->name('independent-producer.show');


    //routes for user management (Livewire)
    Route::get('/users/index', \App\Http\Livewire\UserManagement\UserList::class)->name('user.index');
    Route::get('/users/show/{id}', \App\Http\Livewire\UserManagement\UserShow::class)->name('user.show');
    Route::post('search', [\App\Http\Controllers\UserController::class, 'getStaffDetails'])->name('user.search');
    Route::post('change', [UserController::class, 'changePassword'])->name('user.change.password');




    Route::get('/reports/index', [ReportsController::class, 'index'])->name('reports.index');

    Route::get('/province/index', [ProvinceController::class, 'index'])->name('province.index');
    Route::post('/province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('/province/show/{id}/{district}', [ProvinceController::class, 'show'])->name('province.show');

    Route::post('/substations/show/{id}', [ProvinceController::class, 'editSubstations'])->name('substations.edit');

    Route::post('/districts/store', [DistrictsController::class, 'store'])->name('districts.store');

    Route::post('/node/store', [ConnectionPointsController::class, 'store'])->name('node.store');


    // Statuses (Livewire)
    Route::get('/status/index', \App\Http\Livewire\Statuses\StatusList::class)->name('status.index');





    Route::get('/reports', [ReportsController::class, 'pieChart'])->name('graphical.reports');
//    Route::post('/graphical-reports', [ReportsController::class, 'pieChart'])->name('graphical.reports');

    Route::get('/technology', \App\Http\Livewire\Technologies\TechnologyList::class)->name('technology.index');

    Route::get('/ventures', \App\Http\Livewire\Ventures\VentureList::class)->name('venture.index');

//file upload controller when editing
    Route::post('/document/upload', [FilesController::class, 'uploadFile'])->name('document.upload');

    //livewire routes
    //modules
    Route::get('/module/index', \App\Http\Livewire\Modules\ModuleList::class)->name('module.index');
    Route::get('/module/show/{id}', \App\Http\Livewire\Modules\ModuleShow::class)->name('module.show');
//offices
    Route::get('/office/index', \App\Http\Livewire\Office\ResponsibleOffice::class)->name('office.index');

    // Roles & Permissions Management
    Route::get('/roles', \App\Http\Livewire\Roles\RoleList::class)->name('roles.index');
    Route::get('/permissions', \App\Http\Livewire\Permissions\PermissionList::class)->name('permissions.index');
    Route::get('/user-roles', \App\Http\Livewire\Users\UserRoleManager::class)->name('user-roles.index');

});
