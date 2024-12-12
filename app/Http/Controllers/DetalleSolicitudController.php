<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleSolicitud;
use App\Models\Solicitud;
use App\Models\Examen;

class DetalleSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalles = DetalleSolicitud::with(['solicitud', 'examen'])->get();
        return view('detalle_solicitudes.index', compact('detalles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitudes = Solicitud::all();
        $examenes = Examen::all();
        return view('detalle_solicitudes.create', compact('solicitudes', 'examenes'));
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
            'solicitud_id' => 'required|exists:solicitudes,id',
            'examen_id' => 'required|exists:examenes,id',
        ]);

        DetalleSolicitud::create($request->all());

        return redirect()->route('detalle_solicitudes.index')->with('success', 'Detalle de solicitud creado correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleSolicitud $detalleSolicitud)
    {
        return view('detalle_solicitudes.show', compact('detalleSolicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleSolicitud $detalleSolicitud)
    {
        $solicitudes = Solicitud::all();
        $examenes = Examen::all();
        return view('detalle_solicitudes.edit', compact('detalleSolicitud', 'solicitudes', 'examenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleSolicitud $detalleSolicitud)
    {
        $request->validate([
            'solicitud_id' => 'required|exists:solicitudes,id',
            'examen_id' => 'required|exists:examenes,id',
        ]);

        $detalleSolicitud->update($request->all());

        return redirect()->route('detalle_solicitudes.index')->with('success', 'Detalle de solicitud actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleSolicitud $detalleSolicitud)
    {
        $detalleSolicitud->delete();

        return redirect()->route('detalle_solicitudes.index')->with('success', 'Detalle de solicitud eliminado correctamente');
    }
}
