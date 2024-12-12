<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examen;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Muestra todos los examenes;
    public function index()
    {
        $examenes = Examen::all();
        return view('examnes.index', compact('examenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Crea un nuevo examen
    public function create()
    {
        return view('examenes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Guardar nuevo examen
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:1000',
        ]);

        Examen::create($request->all());

        return redirect()->route('examenes.index')->with('success', 'Examen creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Mostrar un unico examen
    public function show(Examen $examen)
    {
        return view('examenes.show', compact('examen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Formulario para edictar examen
    public function edit(Examen $examen)
    {
        return view('examenes.edit',compact('examen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Actualizar 
    public function update(Request $request, Examen $examen)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:1000',
        ]);

        $examen->update($request->all());

        return redirect()->route('examenes.index')->with('success', 'Examen actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Eliminar un examen
    public function destroy(Examen $examen)
    {
        $examen->delete();

        return redirect()->route('examenes.index')->with('success', 'Examen eliminado correctamente');
    }
}
