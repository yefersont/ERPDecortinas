
@include('inc.header')

<main id="main-section">
    <h1>Resultado de la Conversión</h1>
    <p>Cantidad: {{ $amount }} {{ $baseCurrency }}</p>
    <p>Tasa de cambio: 1 {{ $baseCurrency }} = {{ $conversionRate }} {{ $targetCurrency }}</p>
    <p>Resultado: {{ $resultado }} {{ $targetCurrency }}</p>
    <a href="/divisas">Volver</a>
</main>
