<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatoExamen;
use App\Models\Examen;

class DatoExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Principal
    public function index()
    {
        $datosExamenes = DatoExamen::with('examen')->get();
        return view('datos_examenes.index', compact('datosExamenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Creacion de datos de examenes
    public function create()
    {
        $examenes = Examen::all();
        return view('datos_examenes.create', compact('examenes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //
    public function store(Request $request)
    {
        $request->validate([
            'examen_id' => 'required|exists:examenes,id',
            'nombre' => 'required|max:255',
            'tipo_dato' => 'required|in:numérico,texto',
            'unidad_medida' => 'nullable|max:100',
            'rango_min' => 'nullable|numeric',
            'rango_max' => 'nullable|numeric',
        ]);

        DatoExamen::create($request->all());

        return redirect()->route('datos_examenes.index')->with('success', 'Dato de examen creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //
    public function show(DatoExamen $datoExamen)
    {
        return view('datos_examenes.show', compact('datoExamen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //
    public function edit(DatoExamen $datoExamen)
    {
        $examenes = Examen::all();
        return view('datos_examenes.edit', compact('datoExamen', 'examenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatoExamen $datoExamen)
    {
        $request->validate([
            'examen_id' => 'required|exists:examenes,id',
            'nombre' => 'required|max:255',
            'tipo_dato' => 'required|in:numérico,texto',
            'unidad_medida' => 'nullable|max:100',
            'rango_min' => 'nullable|numeric',
            'rango_max' => 'nullable|numeric',
        ]);

        $datoExamen->update($request->all());

        return redirect()->route('datos_examenes.index')->with('success', 'Dato de examen actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatoExamen $datoExamen)
    {
        $datoExamen->delete();

        return redirect()->route('datos_examenes.index')->with('success', 'Dato de examen eliminado correctamente');
    }
}
