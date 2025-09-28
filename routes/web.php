<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\AprendizController;
use App\Http\Middleware\SetLocale; 

use App\Http\Controllers\FertilizerController;

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
});


//Ruta de aprendiz
Route::middleware(['auth', 'role:aprendiz'])->group(function(){
    Route::get('/aprendiz/dashboard', [AprendizController::class, 'index'])->name('aprendiz.dashboard');
    
    // Organic Waste Management Routes for Apprentices
    Route::resource('aprendiz/organic', AprendizOrganicController::class)->names([
        'index' => 'aprendiz.organic.index',
        'create' => 'aprendiz.organic.create',
        'store' => 'aprendiz.organic.store',
        'show' => 'aprendiz.organic.show',
        'edit' => 'aprendiz.organic.edit',
        'update' => 'aprendiz.organic.update',
        'destroy' => 'aprendiz.organic.destroy',
    ]);

    // Warehouse Classification Routes for Apprentices
    Route::get('aprendiz/warehouse', [AprendizWarehouseController::class, 'index'])->name('aprendiz.warehouse.index');
    Route::get('aprendiz/warehouse/{type}', [AprendizWarehouseController::class, 'inventory'])->name('aprendiz.warehouse.inventory');
});

//rutas de abono

Route::get('/admin/create', function () {
    // Lógica para mostrar el formulario de creación de administrador
    return view('admin.create');
})->name('admin.create');

require __DIR__.'/auth.php';


