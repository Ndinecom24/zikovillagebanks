<?php

use App\Http\Controllers\UserController;
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


//routes for ipp CRUD (Livewire)
    Route::get('/independent-producer/index', \App\Http\Livewire\Producers\ProducerList::class)->name('independent-producer.index');
    Route::get('/independent-producer/show/{id}', \App\Http\Livewire\Producers\ProducerShow::class)->name('independent-producer.show');


    //routes for user management (Livewire)
    Route::get('/users/index', \App\Http\Livewire\UserManagement\UserList::class)->name('user.index');
    Route::get('/users/show/{id}', \App\Http\Livewire\UserManagement\UserShow::class)->name('user.show');
    Route::post('search', [\App\Http\Controllers\UserController::class, 'getStaffDetails'])->name('user.search');
    Route::post('change', [UserController::class, 'changePassword'])->name('user.change.password');




    // Reports (Livewire)
    Route::get('/reports', \App\Http\Livewire\Reports\ReportsDashboard::class)->name('reports.index');

    // Provinces (Livewire)
    Route::get('/province/index', \App\Http\Livewire\Provinces\ProvinceList::class)->name('province.index');
    Route::get('/province/show/{id}/{district?}', \App\Http\Livewire\Provinces\ProvinceShow::class)->name('province.show');

    // Districts (Livewire)
    Route::get('/districts', \App\Http\Livewire\Districts\DistrictList::class)->name('district.index');

    // Connection Points / Substations (Livewire)
    Route::get('/connection-points', \App\Http\Livewire\ConnectionPoints\ConnectionPointList::class)->name('connection-point.index');


    // Statuses (Livewire)
    Route::get('/status/index', \App\Http\Livewire\Statuses\StatusList::class)->name('status.index');





    // graphical.reports now redirects to the unified reports page
    Route::get('/graphical-reports', function () { return redirect()->route('reports.index', ['activeTab' => 'charts']); })->name('graphical.reports');

    Route::get('/technology', \App\Http\Livewire\Technologies\TechnologyList::class)->name('technology.index');

    Route::get('/ventures', \App\Http\Livewire\Ventures\VentureList::class)->name('venture.index');

// File Manager (Livewire)
    Route::get('/files', \App\Http\Livewire\Files\FileManager::class)->name('files.index');

    // Document Management / Data Bin (Livewire)
    Route::get('/documents', \App\Http\Livewire\Documents\DocumentManager::class)->name('documents.index');

    // Task Management (Livewire)
    Route::get('/task-manager', \App\Http\Livewire\TaskManager\ProcessList::class)->name('task-manager.index');
    Route::get('/task-manager/process/{id}', \App\Http\Livewire\TaskManager\ProcessShow::class)->name('task-manager.show');

    //livewire routes
    //modules
    Route::get('/module/index', \App\Http\Livewire\Modules\ModuleList::class)->name('module.index');
    Route::get('/module/show/{id}', \App\Http\Livewire\Modules\ModuleShow::class)->name('module.show');
//offices
    Route::get('/office/index', \App\Http\Livewire\Office\ResponsibleOffice::class)->name('office.index');
    Route::get('/office/show/{id}', \App\Http\Livewire\Office\OfficeShow::class)->name('office.show');

    // Roles & Permissions Management
    Route::get('/roles', \App\Http\Livewire\Roles\RoleList::class)->name('roles.index');
    Route::get('/roles/show/{id}', \App\Http\Livewire\Roles\RoleShow::class)->name('roles.show');
    Route::get('/permissions', \App\Http\Livewire\Permissions\PermissionList::class)->name('permissions.index');
    Route::get('/user-roles', \App\Http\Livewire\Users\UserRoleManager::class)->name('user-roles.index');


    //clients
    Route::get('/clients', \App\Http\Livewire\Clients\Clients::class)->name('clients.index');
    Route::get('/clients/create', \App\Http\Livewire\Clients\ClientCreate::class)->name('clients.create');
    Route::get('/clients/show/{id}', \App\Http\Livewire\Clients\ClientShow::class)->name('clients.show');

});
