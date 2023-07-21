<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\RoleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/',[AdminController::class,'AdminLogin'])->name('admin.login');

Route::middleware(['auth','authadmin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class,'AdminUpdatePassword'])->name('admin.update.password');
});

Route::middleware(['auth','authagent'])->group(function () {
    Route::get('/agent/dashboard',[AgentController::class,'AgentDashboard'])->name('agent.dashboard');
});


// For Admin Property Rights

Route::middleware(['auth','authadmin'])->group(function () {

    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/type','AllType')->name('all.type');
        Route::get('/add/type','AddType')->name('add.type');
        Route::post('/store/type','StoreType')->name('store.type');
        Route::get('/edit/type/{id}','EditType')->name('edit.type');
        Route::post('/update/type','UpdateType')->name('update.type');
        Route::get('/delete/type/{id}','DeleteType')->name('delete.type');
    });
});


// For Admin Amenties
Route::middleware(['auth','authadmin'])->group(function () {

    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/amenitie','AllAmenitie')->name('all.amenitie');
        Route::get('/add/amenitie','AddAmenitie')->name('add.amenitie');
        Route::post('/store/amenitie','StoreAmenitie')->name('store.amenitie');
        Route::get('/edit/amenitie/{id}','EditAmenitie')->name('edit.amenitie');
        Route::post('/update/amenitie','UpdateAmenitie')->name('update.amenitie');
        Route::get('/delete/amenitie/{id}','DeleteAmenitie')->name('delete.amenitie');
    });
});

Route::middleware(['auth','authadmin'])->group(function () {

    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/permission','AllPermission')->name('all.permission');
        Route::get('/add/permission','AddPermission')->name('add.permission');
        Route::post('/store/permission','StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
        Route::post('/update/permission/{id}','UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');
        Route::get('/import/permission','importPermission')->name('import.permission');
        Route::get('/export','Export')->name('export');
        Route::post('/import','Import')->name('import');
    });
});

Route::middleware(['auth', 'authadmin'])->group(function () {

    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/role', 'AllRole')->name('all.role');
        Route::get('/add/role', 'AddRole')->name('add.role');
        Route::post('/store/role', 'StoreRole')->name('store.role');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/update/role/{id}', 'UpdateRole')->name('update.role');
        Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role');
        

        Route::get('/all/role/permission', 'AllRolePermission')->name('all.role.permission');
        Route::get('/add/role/permission', 'AddRolePermission')->name('add.role.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/admin/edit/role/permission/{id}', 'AdminEditRolePermission')->name('admin.edit.role.permission');
        Route::post('/admin/role/update/{id}', 'AdminRoleUpdate')->name('admin.role.update');
        Route::get('/admin/delete/role/{id}', 'AdminDeleteRole')->name('admin.delete.role');
    });
});


