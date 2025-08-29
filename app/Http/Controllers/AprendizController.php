<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use Illuminate\Http\Request;

class AprendizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aprendiz.dashboard'); //Redirigir al dashboard del aprendiz
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
    public function show(Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aprendiz $aprendiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aprendiz $aprendiz)
    {
        //
    }
}
