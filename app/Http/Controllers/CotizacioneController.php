<?php

namespace App\Http\Controllers;

use App\Models\Cotizacione;
use App\Models\Cliente;
use App\Models\TipoProducto;
use App\Models\Deudore;
use App\Models\Venta;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Asegúrate de importar Log
use Illuminate\Support\Facades\DB;


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
         // Validación de datos
         $request->validate([
             'Cedula_cli_coti' => 'required|numeric',  // La cédula debe ser un número
             'Tp_producto_coti' => 'required|integer',
             'Ancho_coti' => 'required|numeric',
             'Alto_coti' => 'required|numeric',
             'Mando_coti' => 'required|string',
             'Valortotal_coti' => 'required|integer',
             'Fecha_coti' => 'required|date',
             'Radicado_coti' => 'required|integer',
         ]);
     
         // Buscar el cliente por cédula
         $cliente = Cliente::where('Cedula_cli', $request->Cedula_cli_coti)->first();
     
         // Si el cliente no existe, retornamos un error
         if (!$cliente) {
             return redirect()->back()->with('mensajeerror', 'Cliente no encontrado con la cédula proporcionada.');
         }
     
         // Crear la cotización usando el idClientes
         $cotizacion = new Cotizacione();
         $cotizacion->Cedula_cli_coti = $cliente->idClientes;  // Usamos el idClientes, no la cédula
         $cotizacion->Tp_producto_coti = $request->Tp_producto_coti;
         $cotizacion->Ancho_coti = $request->Ancho_coti;
         $cotizacion->Alto_coti = $request->Alto_coti;
         $cotizacion->Mando_coti = $request->Mando_coti;
         $cotizacion->Valortotal_coti = $request->Valortotal_coti;
         $cotizacion->Fecha_coti = $request->Fecha_coti;
         $cotizacion->Radicado_coti = $request->Radicado_coti;
     
         // Guardar la cotización
         $cotizacion->save();
     
         // Redirigir a la lista de cotizaciones con un mensaje de éxito
         return redirect()->route('cotizaciones.index')->with('mensaje', 'Cotización registrada correctamente.');
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
        

        $datoscoti = Cotizacione::findOrFail($id);

        $datoscoti -> Cedula_cli_coti = $request->get('Cedula_cli_coti');
        $datoscoti -> Fecha_coti = $request->get('Fecha_coti');
        $datoscoti -> Radicado_coti = $request->get('Radicado_coti');
        $datoscoti -> Alto_coti = $request->get('Alto_coti');
        $datoscoti -> Ancho_coti = $request->get('Ancho_coti');
        $datoscoti -> Tp_producto_coti = $request->get('Tp_producto_coti');
        $datoscoti -> Mando_coti = $request->get('Mando_coti');
        $datoscoti -> Valortotal_coti =  $request->get('Valortotal_coti');

        $datoscoti->save();

        return redirect('cotizaciones')->with('mensaje','La cotizacion fue actualizada con éxito!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Cotizacione::destroy($id);
        return redirect('cotizaciones')->with('mensajeerror','La cotizacion fue eliminada con exito!');
    }
}
