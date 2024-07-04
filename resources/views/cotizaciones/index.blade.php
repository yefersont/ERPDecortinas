

@include('inc.header')
<main>

<h1>Cotizaciones</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Cedula</th>
                <th>Ancho</th>
                <th>Alto</th>
                <th>Mando</th>
                <th>Valor total </th>
                <th>Fecha de cotizacion</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cotizaciones as $cotizacion)
                <tr>
                    <td>{{ $cotizacion -> idCotizaciones }}</td>
                    <td>{{ $cotizacion -> Cedula_cli_coti }}</td>
                    <td>{{ $cotizacion -> Ancho_coti }} </td>
                    <td>{{ $cotizacion -> Alto_coti }}</td>
                    <td>{{ $cotizacion -> Mando_coti }}</td>
                    <td>{{ $cotizacion -> Valortotal_coti }}</td>
                    <td>{{ $cotizacion -> Fecha_coti }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
