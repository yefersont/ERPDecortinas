<?php

namespace App\Http\Controllers;

use App\Models\Deudore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Cotizacione;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\Facades\DB;

class DeudoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $datos['deudores'] = Deudore::all();


        
        return view('deudores.index',$datos);
        //
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
        $request->validate([
            'Abono_deudor' => 'required|numeric|min:0',
            'cotizacion_id' => 'required|exists:cotizaciones,idCotizaciones',
        ]);

        $cotizacion = Cotizacione::find($request->input('cotizacion_id'));

        if (!$cotizacion) {
            return redirect()->back()->with('mensajeerror', 'La cotización no existe.');
        }

        // Obtener la cédula del cliente de la cotización
        $cedulaCliente = $cotizacion->Cedula_cli_coti;

        // Crear el deudor directamente, sin buscar si ya existe
        $deudor = new Deudore();


        
        $deudor->Cedula_deudor = $cedulaCliente;
        $deudor->Valor_venta_deudor = $cotizacion->idCotizaciones;  // El valor total de la cotización como la deuda
        $deudor->Abono_deudor = $request->input('Abono_deudor');  // El abono inicial
        $deudor->Fecha_abono_deudor = now();  // La fecha actual para el abono inicial

        
        $deudor->save();
        // Redirigir con un mensaje de éxito
        return redirect()->route('deudores.index')->with('mensaje', 'El deudor y el abono fueron registrados correctamente.');


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
    public function update(Request $request, $id)
    {
        // Validar la entrada
        $request->validate([
            'Segundo_Abono_deudor' => 'required|numeric|min:0',
        ]);
    
        // Buscar el deudor
        $deudor = Deudore::findOrFail($id);
    
        // Actualizar valores
        $abonoNuevo = $request->input('Segundo_Abono_deudor');
        $deudor->Abono_deudor += $abonoNuevo; // Sumar el nuevo abono
        $deudor->Fecha_abono_deudor = now(); // Actualizar la fecha al día actual
        $deudor->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('deudores.index')->with('mensaje', 'El abono fue registrado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
