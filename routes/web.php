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
    
    // Rutas de mantenimiento de maquinaria
    Route::get('machinery-maintenance', [MachineryController::class, 'indexMaintenance'])->name('machinery.maintenance.index');
    Route::get('machinery-maintenance/create', [MachineryController::class, 'createMaintenance'])->name('machinery.maintenance.create');
    Route::post('machinery-maintenance', [MachineryController::class, 'storeMaintenance'])->name('machinery.maintenance.store');
    Route::get('machinery/{machinery}/maintenance', [MachineryController::class, 'showMaintenance'])->name('machinery.maintenance.show');
});


//Ruta de aprendiz
Route::middleware(['auth', 'role:aprendiz'])->group(function(){
    Route::get('/aprendiz/dashboard', [AprendizController::class, 'index'])->name('aprendiz.dashboard');
});

//rutas de abono

Route::get('/admin/create', function () {
    // Lógica para mostrar el formulario de creación de administrador
    return view('admin.create');
})->name('admin.create');

require __DIR__.'/auth.php';


