<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Paciente;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // MUestra todas las solicitudes
    public function index()
    {
        $solicitudes = Solicitud::with('paciente')->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Crear una nueva solicitud
    public function create()
    {
        $pacientes = Paciente::all();
        return view('solicitudes.create', compact('pacientes'));
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
            'codigo' => 'required|unique:solicitudes,codigo|max:20',
            'paciente_id' => 'required|exists:pacientes,id',
            'estado' => 'required|in:proceso,pausado,cancelado,finalizado',
            'tipo' => 'required|in:emergencia,rutina',
        ]);

        Solicitud::create($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //
    public function show(Solicitud $solicitud)
    {
        return view('solicitudes.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //
    public function edit(Solicitud $solicitud)
    {
        $pacientes = Paciente::all();
        return view('solicitudes.edit', compact('solicitud', 'pacientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //
    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'codigo' => 'required|max:20|unique:solicitudes,codigo,' . $solicitud->id,
            'paciente_id' => 'required|exists:pacientes,id',
            'estado' => 'required|in:proceso,pausado,cancelado,finalizado',
            'tipo' => 'required|in:emergencia,rutina',
        ]);

        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada correctamente');
    }
}
