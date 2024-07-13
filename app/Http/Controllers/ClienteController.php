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
        //$cliente = Cliente::findOrFail($id);
        //return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $datoscliente = Cliente::findOrFail($id);

        $datoscliente -> Nombre_cli = $request->get('Nombre_cli');
        $datoscliente -> Apellidos_cli = $request->get('Apellidos_cli');
        $datoscliente -> Cedula_cli = $request->get('Cedula_cli');
        $datoscliente -> Telefono_cli = $request->get('Telefono_cli');
        $datoscliente -> Direccion_cli = $request->get('Direccion_cli');

        $datoscliente->save();

        
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
