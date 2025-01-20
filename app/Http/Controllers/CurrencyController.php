<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    //

    public function index(){

        return view('divisas.index');
    }
    public function convertir(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cantidad' => 'required|numeric',
            'de' => 'required|string',
            'a' => 'required|string',
        ]);
    
        // API Key y URL
        $apiKey = '3369b3e626ae14b8f2b0b995';  
        $baseCurrency = $request->input('de');
        $targetCurrency = $request->input('a');
        $amount = $request->input('cantidad');
    
        // Llamar a la API por URL
        $response = Http::get("https://v6.exchangerate-api.com/v6/$apiKey/latest/$baseCurrency");
    
        if ($response->successful()) {
            $rates = $response->json()['conversion_rates'];
    
            // Verificar si la moneda de destino es válida
            $conversionRate = $rates[$targetCurrency] ?? null;
    
            if (!$conversionRate) {
                return back()->withErrors(['mensajeerror' => 'Moneda de destino no válida']);
            }
    
            // Realizar la conversión
            $resultado = $amount * $conversionRate;
    
            // Pasar el resultado a la vista
            return view('divisas.resultado', compact('amount', 'baseCurrency', 'targetCurrency', 'conversionRate', 'resultado'));
        }
    
        // Si la API no responde
        return back()->withErrors(['mensajeerror' => 'No se pudo conectar con la API de divisas.']);
    }
    
}
