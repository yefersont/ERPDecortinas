<?php

namespace App\Http\Controllers;

use App\Models\Cotizacione;
use App\Models\Cliente;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class CotizacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $datos['cotizaciones'] = Cotizacione::all();
        $Tipo_producto = TipoProducto::all();
        return view('cotizaciones.index',$datos, compact('Tipo_producto'));
    
        
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
        $validatedData = $request->validate([
            'Cedula_cli_coti' => 'required',
            'Fecha_coti' => 'required|date',
            'Radicado_coti' => 'required',
            'Alto_coti' => 'required|numeric',
            'Ancho_coti' => 'required|numeric',
            'Tp_producto_coti' => 'required',
            'Mando_coti' => 'required',
            'Valortotal_coti' => 'required|numeric',
        ]);

        // Buscar el cliente por su número de cédula
        $cliente = Cliente::where('Cedula_cli', $validatedData['Cedula_cli_coti'])->first();

        if (!$cliente) {
            // Si el cliente no existe, redirigir con un mensaje de error
            return redirect()->back()->withErrors(['Cedula_cli_coti' => 'Cliente no encontrado.']);
        }

        $cotizacionData = [
            'Cedula_cli_coti' => $cliente->idClientes, // Usar el idClientes del cliente encontrado
            'Fecha_coti' => $validatedData['Fecha_coti'],
            'Radicado_coti' => $validatedData['Radicado_coti'],
            'Alto_coti' => $validatedData['Alto_coti'],
            'Ancho_coti' => $validatedData['Ancho_coti'],
            'Tp_producto_coti' => $validatedData['Tp_producto_coti'],
            'Mando_coti' => $validatedData['Mando_coti'],
            'Valortotal_coti' => $validatedData['Valortotal_coti'],
        ];

        // Insertar la cotización
        Cotizacione::insert($cotizacionData);

        // Redirigir con un mensaje de éxito
        return redirect('cotizaciones.index')->with('mensaje', 'La cotización se registró con éxito.');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
