<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Mostrar todos los pacientes
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Crear un nuevo paciente
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Guardar un nuevo paciente
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|max:255',
            'cedula' => 'required|unique:paciente,cedula|max:20',
            'edad' => 'required|integer',
            'afiliacion' => 'required|in:militar,afiliado,pna,empleado',
            'sexo' => 'required|in:masculino,femenino',
        ]);

        paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success','Paciente creado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Mostrar un paciente en especifico
    public function show($paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //formulario para editar un paciente
    public function edit($paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Actualizar un paciente
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre_completo' => 'required|max:255',
            'cedula' => 'required|max:20|unique:pacientes,cedula,' . $paciente->id,
            'edad' => 'required|integer',
            'afiliacion' => 'required|in:militar,afiliado,pna,empleado',
            'sexo' => 'required|in:masculino,femenino',
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Eliminar un paciente
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente');
    }
}
