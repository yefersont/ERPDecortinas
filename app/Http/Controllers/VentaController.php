<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Cotizacione;
use App\Http\Controllers\DeudorController;
use App\Models\Deudore;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['ventas'] = Venta::with('cotizacione')->get();

        // Calcular la suma de Valortotal_coti de todas las cotizaciones
        $datos['totalVentas'] = $datos['ventas']->sum(function ($venta) {
            return $venta->cotizacione->Valortotal_coti;
        });
    
        // Retornar la vista con los datos
        return view('ventas.index', $datos);

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
         // Validar la entrada
         $request->validate([
             'cotizacion_id' => 'required|exists:cotizaciones,idCotizaciones',
             'Abono_deudor' => 'required|numeric|min:0', // Validar que el abono es numérico y no negativo
         ]);
     
         // Obtener la cotización asociada
         $cotizacion = Cotizacione::find($request->input('cotizacion_id'));
     
         if (!$cotizacion) {
             return redirect('cotizaciones')->with('mensajealerta', 'La cotización no existe.');
         }
     
         // Comprobar si ya existe una venta para esta cotización
         $existingSale = Venta::where('Cotizacion_venta', $request->input('cotizacion_id'))->first();
     
         if ($existingSale) {
             // Si ya existe, redirigir con un mensaje de error
             return redirect('cotizaciones')->with('mensajealerta', 'Esta cotización ya había sido registrada como venta.');
         }
     
         // Validar que el abono no exceda el valor total de la venta
         $valorTotal = $cotizacion->Valortotal_coti; // Asegúrate de que este campo existe en tu modelo
         $abono = $request->input('Abono_deudor');
     
         if ($abono > $valorTotal) {
             return redirect('cotizaciones')->with('mensajealerta', 'El abono no puede ser mayor a la venta.');
         }
         
        if ($abono <= 0) {
            return redirect('cotizaciones')->with('mensajealerta', 'El abono no puede ser $0.');
        }
     
         // Crear una nueva venta
         $venta = new Venta();
         $venta->Fecha_venta = now(); // Fecha actual
         $venta->Cotizacion_venta = $request->input('cotizacion_id'); // Id de la cotización
     
         // Guardar la venta
         $venta->save();
     
         // Preparar los datos para el DeudorController
         $deudorData = [
             'Abono_deudor' => $abono, // Capturar el abono del request
             'cotizacion_id' => $request->input('cotizacion_id'), // ID de la cotización
         ];
     
         // Llamar a la función store del DeudorController
         app(DeudoreController::class)->store(new Request($deudorData));
     
         // Redirigir con un mensaje de éxito
         return redirect('cotizaciones')->with('mensaje', 'Se registró la venta exitosamente y se actualizó el deudor.');
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

        Venta::destroy($id);
        return redirect('ventas')->with('mensajeerror','La Venta fue eliminada con exito!');

    }
}
