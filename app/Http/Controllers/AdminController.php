<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Machinery;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener estadísticas de maquinaria
        $totalMachinery = Machinery::count();
        $machineryStats = [
            'total' => $totalMachinery,
            'operational' => $totalMachinery > 0 ? ceil($totalMachinery * 0.8) : 0, // Aproximación del 80%
            'needs_maintenance' => $totalMachinery > 0 ? floor($totalMachinery * 0.2) : 0 // Aproximación del 20%
        ];

        return view('admin.dashboard', compact('machineryStats')); //Redirigir al dashboard del aministrador//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
