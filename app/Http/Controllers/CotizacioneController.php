<?php

namespace App\Http\Controllers;

use App\Models\Cotizacione;
use App\Models\Cliente;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Asegúrate de importar Log


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
    { // Añade un mensaje de depuración
        Log::info('Entrando a la función store');

        $datos = $request->all();
        Log::info('Datos recibidos', $datos);

        // Buscar el cliente por su número de cédula
        $cliente = Cliente::where('Cedula_cli', $datos['Cedula_cli_coti'])->first();

        if (!$cliente) {
            // Si el cliente no existe, redirigir con un mensaje de error
            Log::error('Cliente no encontrado', ['Cedula_cli_coti' => $datos['Cedula_cli_coti']]);
            return redirect()->back()->withErrors(['Cedula_cli_coti' => 'Cliente no encontrado.']);
        }

        Log::info('Cliente encontrado', ['idClientes' => $cliente->idClientes]);

        // Asegurarse de que todos los datos necesarios estén presentes
        $camposNecesarios = ['Fecha_coti', 'Radicado_coti', 'Alto_coti', 'Ancho_coti', 'Tp_producto_coti', 'Mando_coti', 'Valortotal_coti'];
        foreach ($camposNecesarios as $campo) {
            if (!isset($datos[$campo])) {
                Log::error('Campo faltante', ['campo' => $campo]);
                return redirect()->back()->withErrors(['campo_faltante' => "El campo {$campo} es requerido."]);
            }
        }

        $cotizacionData = [
            'Cedula_cli_coti' => $cliente->idClientes, // Usar el idClientes del cliente encontrado
            'Fecha_coti' => $datos['Fecha_coti'],
            'Radicado_coti' => $datos['Radicado_coti'],
            'Alto_coti' => $datos['Alto_coti'],
            'Ancho_coti' => $datos['Ancho_coti'],
            'Tp_producto_coti' => $datos['Tp_producto_coti'],
            'Mando_coti' => $datos['Mando_coti'],
            'Valortotal_coti' => $datos['Valortotal_coti'],
        ];

        Log::info('Datos de la cotización', $cotizacionData);

        // Insertar la cotización
        Cotizacione::create($cotizacionData);

        Log::info('Cotización insertada');

        // Redirigir con un mensaje de éxito
        return redirect('cotizaciones')->with('mensaje', 'La cotización se registró con éxito.');    }


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
