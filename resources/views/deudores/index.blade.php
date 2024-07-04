

@include('inc.header')
<main id="main-section">

<h1>Deudores</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Cedula</th>
                <th>Valor de venta</th>
                <th>Abono </th>
                <th>Fecha de abono</th>
            </tr>
        </thead>

        <tbody>
            @foreach($deudores as $deudor)
                <tr>
                    <td>{{ $deudor -> idDeudor }}</td>
                    <td>{{ $deudor -> Cedula_deudor }}</td>
                    <td>{{ $deudor -> Valor_venta_deudor }}</td>
                    <td>{{ $deudor -> Abono_deudor }}</td>
                    <td>{{ $deudor ->Fecha_abono_deudor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
