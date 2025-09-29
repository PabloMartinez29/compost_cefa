<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\AprendizController;
use App\Http\Middleware\SetLocale; 

use App\Http\Controllers\FertilizerController;
use App\Http\Controllers\MachineryController;

Route::get('/', function () {
    return view('welcome');
})->middleware(SetLocale::class);

// Ruta general del dashboard que redirige según el rol
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } else {
            return redirect()->route('aprendiz.dashboard');
        }
    }
    return redirect()->route('login');
})->middleware(['auth']);

//Ruta de admin
Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    
    // Rutas de maquinaria
    Route::resource('machinery', MachineryController::class);
    Route::get('machinery/{machinery}/maintenance/create', [MachineryController::class, 'createMaintenance'])->name('machinery.maintenance.create');
    Route::post('machinery/{machinery}/maintenance', [MachineryController::class, 'storeMaintenance'])->name('machinery.maintenance.store');
    Route::get('machinery-maintenance', [MachineryController::class, 'indexMaintenance'])->name('machinery.maintenance.index');
    Route::get('machinery-maintenance/{maintenance}', [MachineryController::class, 'showMaintenance'])->name('machinery.maintenance.show');
    
    // Notification routes
    Route::get('notifications', [App\Http\Controllers\Admin\NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::post('notifications/approve-delete', [App\Http\Controllers\Admin\NotificationController::class, 'approveDelete'])->name('notifications.approve-delete');
    Route::post('notifications/reject-delete', [App\Http\Controllers\Admin\NotificationController::class, 'rejectDelete'])->name('notifications.reject-delete');
    Route::post('notifications/mark-read', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    
    // Rutas de residuos orgánicos
    Route::resource('admin/organic', App\Http\Controllers\Admin\OrganicController::class)->names([
        'index' => 'admin.organic.index',
        'create' => 'admin.organic.create',
        'store' => 'admin.organic.store',
        'show' => 'admin.organic.show',
        'edit' => 'admin.organic.edit',
        'update' => 'admin.organic.update',
        'destroy' => 'admin.organic.destroy',
    ]);
    
    // Rutas de bodega
    Route::get('admin/warehouse', [App\Http\Controllers\Admin\WarehouseController::class, 'index'])->name('admin.warehouse.index');
    Route::get('admin/warehouse/{type}', [App\Http\Controllers\Admin\WarehouseController::class, 'inventory'])->name('admin.warehouse.inventory');
});


//Ruta de aprendiz
Route::middleware(['auth', 'role:aprendiz'])->group(function(){
    Route::get('/aprendiz/dashboard', [AprendizController::class, 'index'])->name('aprendiz.dashboard');
    
    // Organic Waste Management Routes for Apprentices
    Route::resource('aprendiz/organic', App\Http\Controllers\Aprendiz\OrganicController::class)->names([
        'index' => 'aprendiz.organic.index',
        'create' => 'aprendiz.organic.create',
        'store' => 'aprendiz.organic.store',
        'show' => 'aprendiz.organic.show',
        'edit' => 'aprendiz.organic.edit',
        'update' => 'aprendiz.organic.update',
        'destroy' => 'aprendiz.organic.destroy',
    ]);
    
    // Rutas para solicitudes de permisos
    Route::post('aprendiz/organic/{organic}/request-edit', [App\Http\Controllers\Aprendiz\OrganicController::class, 'requestEditPermission'])
        ->name('aprendiz.organic.request-edit');
    Route::post('aprendiz/organic/{organic}/request-delete', [App\Http\Controllers\Aprendiz\OrganicController::class, 'requestDeletePermission'])
        ->name('aprendiz.organic.request-delete');
    
    // Rutas de notificaciones para aprendices
    Route::get('aprendiz/notifications', [App\Http\Controllers\Aprendiz\NotificationController::class, 'getNotifications'])->name('aprendiz.notifications.get');
    Route::post('aprendiz/notifications/mark-read', [App\Http\Controllers\Aprendiz\NotificationController::class, 'markAsRead'])->name('aprendiz.notifications.mark-read');

    // Warehouse Classification Routes for Apprentices
    Route::get('aprendiz/warehouse', [App\Http\Controllers\Aprendiz\WarehouseController::class, 'index'])->name('aprendiz.warehouse.index');
    Route::get('aprendiz/warehouse/{type}', [App\Http\Controllers\Aprendiz\WarehouseController::class, 'inventory'])->name('aprendiz.warehouse.inventory');
});

//rutas de abono

Route::get('/admin/create', function () {
    // Lógica para mostrar el formulario de creación de administrador
    return view('admin.create');
})->name('admin.create');

require __DIR__.'/auth.php';


