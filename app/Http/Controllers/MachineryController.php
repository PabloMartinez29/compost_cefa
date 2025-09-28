<?php

namespace App\Http\Controllers;

use App\Models\Machinery;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MachineryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machineries = Machinery::latest()->paginate(10);
        return view('admin.machinery.index', compact('machineries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.machinery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'location' => 'required|string|max:150',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'serial' => 'required|string|max:100|unique:machineries,serial',
            'start_func' => 'required|date|before_or_equal:today',
            'maint_freq' => 'required|string|max:100',
        ], [
            'name.required' => 'El nombre de la maquinaria es obligatorio.',
            'name.max' => 'El nombre no debe exceder 150 caracteres.',
            'location.required' => 'La ubicación es obligatoria.',
            'location.max' => 'La ubicación no debe exceder 150 caracteres.',
            'brand.required' => 'La marca es obligatoria.',
            'brand.max' => 'La marca no debe exceder 100 caracteres.',
            'model.required' => 'El modelo es obligatorio.',
            'model.max' => 'El modelo no debe exceder 100 caracteres.',
            'serial.required' => 'El número de serie es obligatorio.',
            'serial.max' => 'El número de serie no debe exceder 100 caracteres.',
            'serial.unique' => 'Este número de serie ya está registrado.',
            'start_func.required' => 'La fecha de inicio de funcionamiento es obligatoria.',
            'start_func.date' => 'La fecha de inicio debe ser una fecha válida.',
            'start_func.before_or_equal' => 'La fecha de inicio no puede ser futura.',
            'maint_freq.required' => 'La frecuencia de mantenimiento es obligatoria.',
            'maint_freq.max' => 'La frecuencia de mantenimiento no debe exceder 100 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Machinery::create($request->all());
            
            return redirect()->route('machinery.index')
                ->with('success', 'Maquinaria registrada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar la maquinaria: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Machinery $machinery)
    {
        return view('admin.machinery.show', compact('machinery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machinery $machinery)
    {
        return view('admin.machinery.edit', compact('machinery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machinery $machinery)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'location' => 'required|string|max:150',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'serial' => 'required|string|max:100|unique:machineries,serial,' . $machinery->id,
            'start_func' => 'required|date|before_or_equal:today',
            'maint_freq' => 'required|string|max:100',
        ], [
            'name.required' => 'El nombre de la maquinaria es obligatorio.',
            'name.max' => 'El nombre no debe exceder 150 caracteres.',
            'location.required' => 'La ubicación es obligatoria.',
            'location.max' => 'La ubicación no debe exceder 150 caracteres.',
            'brand.required' => 'La marca es obligatoria.',
            'brand.max' => 'La marca no debe exceder 100 caracteres.',
            'model.required' => 'El modelo es obligatorio.',
            'model.max' => 'El modelo no debe exceder 100 caracteres.',
            'serial.required' => 'El número de serie es obligatorio.',
            'serial.max' => 'El número de serie no debe exceder 100 caracteres.',
            'serial.unique' => 'Este número de serie ya está registrado.',
            'start_func.required' => 'La fecha de inicio de funcionamiento es obligatoria.',
            'start_func.date' => 'La fecha de inicio debe ser una fecha válida.',
            'start_func.before_or_equal' => 'La fecha de inicio no puede ser futura.',
            'maint_freq.required' => 'La frecuencia de mantenimiento es obligatoria.',
            'maint_freq.max' => 'La frecuencia de mantenimiento no debe exceder 100 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $machinery->update($request->all());
            
            return redirect()->route('machinery.index')
                ->with('success', 'Maquinaria actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la maquinaria: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machinery $machinery)
    {
        try {
            $machinery->delete();
            
            return redirect()->route('machinery.index')
                ->with('success', 'Maquinaria eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar la maquinaria: ' . $e->getMessage());
        }
    }

    /**
     * Get machinery statistics for dashboard
     */
    public function getStats()
    {
        $total = Machinery::count();
        $operational = Machinery::whereHas('maintenances', function($query) {
            $query->where('created_at', '>=', now()->subDays(30));
        })->count();
        $needsMaintenance = $total - $operational;

        return [
            'total' => $total,
            'operational' => $operational,
            'needs_maintenance' => $needsMaintenance
        ];
    }

    /**
     * Show the form for registering machinery maintenance
     */
    public function createMaintenance()
    {
        $machineries = Machinery::orderBy('name')->get();
        return view('admin.machinery.maintenance', compact('machineries'));
    }

    /**
     * Store a newly created maintenance record
     */
    public function storeMaintenance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'machinery_id' => 'required|exists:machineries,id',
            'date' => 'required|date|before_or_equal:today',
            'type' => 'required|in:O,M',
            'description' => 'required|string|max:1000',
            'responsible' => 'required|string|max:150',
        ], [
            'machinery_id.required' => 'Debe seleccionar una maquinaria.',
            'machinery_id.exists' => 'La maquinaria seleccionada no existe.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser válida.',
            'date.before_or_equal' => 'La fecha no puede ser futura.',
            'type.required' => 'Debe seleccionar el tipo de registro.',
            'type.in' => 'El tipo de registro no es válido.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no debe exceder 1000 caracteres.',
            'responsible.required' => 'El responsable es obligatorio.',
            'responsible.max' => 'El nombre del responsable no debe exceder 150 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Maintenance::create($request->all());
            
            return redirect()->route('machinery.maintenance.create')
                ->with('success', 'Registro de mantenimiento creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el registro: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show maintenance history for a specific machinery
     */
    public function showMaintenance(Machinery $machinery)
    {
        $maintenances = $machinery->maintenances()->orderBy('date', 'desc')->paginate(10);
        return view('admin.machinery.maintenance-history', compact('machinery', 'maintenances'));
    }

    /**
     * Display a listing of all maintenance records
     */
    public function indexMaintenance()
    {
        $maintenances = Maintenance::with('machinery')
            ->orderBy('date', 'desc')
            ->paginate(15);
        
        $stats = [
            'total' => Maintenance::count(),
            'maintenance' => Maintenance::where('type', 'M')->count(),
            'operations' => Maintenance::where('type', 'O')->count(),
            'this_month' => Maintenance::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->count()
        ];

        return view('admin.machinery.maintenance-list', compact('maintenances', 'stats'));
    }
}

