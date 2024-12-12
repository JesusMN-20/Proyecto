<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadoExamen;
use App\Models\DetalleSolicitud;
use App\Models\DatoExamen;

class ResultadoExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = ResultadoExamen::with(['detalleSolicitud', 'datoExamen'])->get();
        return view('resultados_examenes.index', compact('resultados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleSolicitudes = DetalleSolicitud::all();
        $datosExamenes = DatoExamen::all();
        return view('resultados_examenes.create', compact('detalleSolicitudes', 'datosExamenes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'detalle_solicitud_id' => 'required|exists:detalle_solicitudes,id',
            'dato_examen_id' => 'required|exists:datos_examenes,id',
            'valor' => 'nullable',
        ]);

        ResultadoExamen::create($request->all());

        return redirect()->route('resultados_examenes.index')->with('success', 'Resultado de examen creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ResultadoExamen $resultadoExamen)
    {
        return view('resultados_examenes.show', compact('resultadoExamen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultadoExamen $resultadoExamen)
    {
        $detalleSolicitudes = DetalleSolicitud::all();
        $datosExamenes = DatoExamen::all();
        return view('resultados_examenes.edit', compact('resultadoExamen', 'detalleSolicitudes', 'datosExamenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultadoExamen $resultadoExamen)
    {
        $request->validate([
            'detalle_solicitud_id' => 'required|exists:detalle_solicitudes,id',
            'dato_examen_id' => 'required|exists:datos_examenes,id',
            'valor' => 'nullable',
        ]);

        $resultadoExamen->update($request->all());

        return redirect()->route('resultados_examenes.index')->with('success', 'Resultado de examen actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultadoExamen $resultadoExamen)
    {
        $resultadoExamen->delete();

        return redirect()->route('resultados_examenes.index')->with('success', 'Resultado de examen eliminado correctamente');
    }
}
