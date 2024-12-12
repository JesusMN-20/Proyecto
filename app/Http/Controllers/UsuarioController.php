<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('Usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
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
            'nombre_completo' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:usuarios,cedula',
            'cargo' => 'required|in:bionalista,auxiliar,doctor,visitante',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:8',
        ]);

        Usuario::create([
            'nombre_completo' => $request->nombre_completo,
            'cedula' => $request->cedula,
            'cargo' => $request->cargo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return view('usuarios.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($usuario)
    {
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:usuarios,cedula,' . $usuario->id,
            'cargo' => 'required|in:bionalista,auxiliar,doctor,visitante',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:8',
        ]);

        $usuario->update([
            'nombre_completo' => $request->nombre_completo,
            'cedula' => $request->cedula,
            'cargo' => $request->cargo,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'usuario eliminado correctamente');
    }
}
