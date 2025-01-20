

@include('inc.header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">

<main>

@if(Session::has('mensajeerror'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ Session::get('mensajeerror')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif




<h1>Ventas</h1>
    <div class="table-container">
        <table id="tablas">

            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Ancho</th>
                    <th>Alto</th>
                    <th>Mando</th>
                    <th>Producto</th>
                    <th>Fecha de venta</th>
                    <th>Valor </th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->cotizacione->cliente->Nombre_cli . " " . $venta->cotizacione->cliente->Apellidos_cli }}</td>
                        <td>{{ $venta->cotizacione->Ancho_coti }}</td>
                        <td>{{ $venta->cotizacione->Alto_coti }}</td>
                        <td>{{ $venta->cotizacione->Mando_coti }}</td>
                        <td>{{ $venta->cotizacione->Tipo_producto->Nombre_tp }}</td>
                        <td>{{ $venta->Fecha_venta->format('d/m/y')}}</td>
                        <td>{{ "$ " . number_format($venta->cotizacione->Valortotal_coti, 0, '.', ',') }}</td>
                        <td class="d-flex">



<!------- Boton eliminar ----------->
                            <form action="{{ url('/ventas/'.$venta -> idVentas) }}" method="post" style="display: inline;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Venta?')">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded shadow">
            <span class="fs-5">Total en ventas</span>
            <h3 class="mb-0 text-success">{{ "$ " . number_format($totalVentas, 0, '.', ',') }}</h3>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>

</main>
