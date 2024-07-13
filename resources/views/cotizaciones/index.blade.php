@include('inc.header')

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">

<main id="main-section">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(Session::has('mensajeerror'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ Session::get('mensajeerror')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="titulo">
        <h2>Cotizaciones</h2>
        <a><ion-icon name="notifications-circle-outline"></ion-icon> <span>Notificaciones</span></a>
    </div>

    <div class="div-boton">
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#createModalCotizaciones">New cotizacion</button>
    </div>

    @include('cotizaciones.create')
    <div class="table-container">
        <table id="tablas">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Ancho</th>
                    <th>Alto</th>
                    <th>Mando</th>
                    <th>Producto</th>
                    <th>Valor total </th>
                    <th>Fecha de cotizacion</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cotizaciones as $cotizacion)
                    <tr>
                        <td>{{ $cotizacion -> cliente -> Nombre_cli." ".$cotizacion -> cliente -> Apellidos_cli }}</td>
                        <td>{{ $cotizacion -> Ancho_coti }} </td>
                        <td>{{ $cotizacion -> Alto_coti }}</td>
                        <td>{{ $cotizacion -> Mando_coti }}</td>
                        <td>{{ $cotizacion -> Tipo_producto -> Nombre_tp }}</td>
                        <td>{{ "$ ".number_format($cotizacion->Valortotal_coti, 0, '.', ',') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cotizacion->Fecha_coti)->format('d/m/Y') }}</td>
                        <td>
                            <button type="button" class="btn btn-success"> <ion-icon name="reader-outline"></ion-icon> </button>
                            <button type="button" class="btn btn-warning edit-btn" data-id="" data-bs-toggle="modal" data-bs-target="#editModal"><ion-icon name="create-outline"></ion-icon></button>
                            <form action="" method="post" style="display: inline;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cotizacion?')"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</main>
