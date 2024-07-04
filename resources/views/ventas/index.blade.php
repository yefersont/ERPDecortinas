

@include('inc.header')
<main>

<h1>Ventas</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#id </th>
                <th scope="col">Fecha de venta</th>
                <th scope="col">Cotizacion_venta</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta -> idVentas }}</td>
                    <td>{{ $venta -> Fecha_venta}}</td>
                    <td>{{ $venta -> Cotizacion_venta }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
