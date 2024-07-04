@include('inc.header')

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">

<main id="main-section">
    @if( Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
        </div>
    @endif

    @if( Session::has('mensajeerror'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ Session::get('mensajeerror')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
        </div>
    @endif

    <div class="titulo">
        <h2>Clientes</h2>
        <a><ion-icon name="notifications-circle-outline"></ion-icon> <span>Notificaciones</span></a>
    </div>

    <div class="div-boton">
        <button type="button" class="btn btn-success btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#createModal">Nuevo Cliente +</button>
    </div>

    @include('clientes.table')

    @include('clientes.create')
    @include('clientes.edit')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>

    <script>
    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var nombre = $(this).data('nombre');
            var apellidos = $(this).data('apellidos');
            var cedula = $(this).data('cedula');
            var telefono = $(this).data('telefono');
            var direccion = $(this).data('direccion');

            $('#editModal input[name="Nombre_cli"]').val(nombre);
            $('#editModal input[name="Apellidos_cli"]').val(apellidos);
            $('#editModal input[name="Cedula_cli"]').val(cedula);
            $('#editModal input[name="Telefono_cli"]').val(telefono);
            $('#editModal input[name="Direccion_cli"]').val(direccion);
            $('#editModal form').attr('action', '/clientes/' + id);
        });
    });
</script>

</main>
