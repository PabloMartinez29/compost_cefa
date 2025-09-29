<?php

namespace App\Http\Controllers\Aprendiz;

use App\Http\Controllers\Controller;
use App\Models\Organic;
use App\Models\WarehouseClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organics = Organic::orderBy('created_at', 'desc')->get();
        return view('aprendiz.organic.index', compact('organics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aprendiz.organic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:Kitchen,Beds,Leaves,CowDung,ChickenManure,PigManure,Other',
            'weight' => 'required|numeric|min:0.01',
            'delivered_by' => 'required|string|max:100',
            'received_by' => 'required|string|max:100',
            'notes' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('organics', 'public');
        }

        // Agregar el ID del usuario que crea el registro
        $data['created_by'] = auth()->id();

        $organic = Organic::create($data);

        // Crear movimiento automático en bodega de clasificación
        WarehouseClassification::create([
            'date' => $data['date'],
            'type' => $data['type'],
            'movement_type' => 'entry', // Entrada automática
            'weight' => $data['weight'],
            'notes' => 'Entrada automática desde registro de residuos orgánicos',
            'processed_by' => $data['received_by'],
            'img' => $data['img'] // Misma imagen si existe
        ]);

        return redirect()->route('aprendiz.organic.index')->with('success', 'Residuo orgánico registrado y clasificado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organic $organic)
    {
        return view('aprendiz.organic.show', compact('organic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organic $organic)
    {
        return view('aprendiz.organic.edit', compact('organic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organic $organic)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:Kitchen,Beds,Leaves,CowDung,ChickenManure,PigManure,Other',
            'weight' => 'required|numeric|min:0.01',
            'delivered_by' => 'required|string|max:100',
            'received_by' => 'required|string|max:100',
            'notes' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('img')) {
            // Delete old image
            if ($organic->img) {
                Storage::disk('public')->delete($organic->img);
            }
            $data['img'] = $request->file('img')->store('organics', 'public');
        }

        $organic->update($data);

        return redirect()->route('aprendiz.organic.index')->with('success', 'Residuo orgánico actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organic $organic)
    {
        // Delete image if exists
        if ($organic->img) {
            Storage::disk('public')->delete($organic->img);
        }

        $organic->delete();

        return redirect()->route('aprendiz.organic.index')->with('success', 'Residuo orgánico eliminado exitosamente!');
    }
}
