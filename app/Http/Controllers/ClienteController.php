<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['clientes'] = Cliente::all();
        return view('clientes.index',$datos);
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
        $datos = request()->except('_token');
        Cliente::insert($datos);
        return redirect('clientes')->with('mensaje','El cliente fue agregado con exito!!.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.index', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cliente = request()->except(['_token','_method']);

        $cliente = Cliente::findOrFail($id);
        $cliente->Nombre_cli = $request->Nombre_cli;
        $cliente->Apellidos_cli = $request->Apellidos_cli;
        $cliente->Cedula_cli = $request->Cedula_cli;
        $cliente->Telefono_cli = $request->Telefono_cli;
        $cliente->Direccion_cli = $request->Direccion_cli;
        $cliente->save();
    
        return redirect('clientes')->with('mensaje','Cliente actualizado con éxito!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Cliente::destroy($id);
        return redirect('clientes')->with('mensajeerror','El cliente fue eliminado.');
    }
}
