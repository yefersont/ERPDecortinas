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
        <h2>Clientes</h2>
        <a><ion-icon name="notifications-circle-outline"></ion-icon> <span>Notificaciones</span></a>
    </div>

    <div class="div-boton">
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#createModal">Nuevo Cliente +</button>
    </div>

    <div class="table-container">
        <table id="tablas">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->idClientes }}</td>
                        <td>{{ $cliente->Cedula_cli }}</td>
                        <td>{{ $cliente->Nombre_cli }}</td>
                        <td>{{ $cliente->Apellidos_cli }}</td>
                        <td>{{ $cliente->Telefono_cli }}</td>
                        <td>{{ $cliente->Direccion_cli }}</td>
                        <td>
                            <button type="button" class="btn btn-warning edit-btn" data-id="{{ $cliente->idClientes }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $cliente->idClientes }}"><ion-icon name="create-outline"></ion-icon></button>
                            <form action="{{ url('/clientes/'.$cliente->idClientes) }}" method="post" style="display: inline;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar al propietario?')"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $cliente->idClientes }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $cliente->idClientes }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $cliente->idClientes }}">Actualizar cliente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="{{ route('ActualizarCliente', $cliente->idClientes) }}" method="POST" class="row g-3 needs-validation" novalidate>
                                @method('PUT')
                                @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input01{{ $cliente->idClientes }}" class="form-label">Nombres</label>
                                                <input type="text" id="input01{{ $cliente->idClientes }}" name="Nombre_cli" class="form-control w-75" placeholder="Ingrese nombre..." required value="{{ $cliente->Nombre_cli }}">
                                                <div class="invalid-feedback">
                                                    Por favor complete el campo
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input2{{ $cliente->idClientes }}" class="form-label">Apellidos</label>
                                                <input type="text" id="input2{{ $cliente->idClientes }}" name="Apellidos_cli" class="form-control w-75" placeholder="Ingrese apellidos..." required value="{{ $cliente->Apellidos_cli }}">
                                                <div class="invalid-feedback">
                                                    Por favor complete el campo
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input3{{ $cliente->idClientes }}" class="form-label">Cedula</label>
                                                <input type="text" data-input-numerico id="input3{{ $cliente->idClientes }}" name="Cedula_cli" class="form-control w-75" placeholder="Ingrese numero de cedula..." required value="{{ $cliente->Cedula_cli }}">
                                                <div class="invalid-feedback">
                                                    Por favor complete el campo
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input4{{ $cliente->idClientes }}" class="form-label">Teléfono</label>
                                                <input type="text" data-input-numerico id="input4{{ $cliente->idClientes }}" name="Telefono_cli" class="form-control w-75" placeholder="Ingrese numero de celular..." required value="{{ $cliente->Telefono_cli }}">
                                                <div class="invalid-feedback">
                                                    Por favor complete el campo
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input5{{ $cliente->idClientes }}" class="form-label">Direccion</label>
                                                <input type="text" data-input-numerico id="input5{{ $cliente->idClientes }}" name="Direccion_cli" class="form-control w-75" placeholder="Ingrese direccion, barrio, etc.." required value="{{ $cliente->Direccion_cli }}">
                                                <div class="invalid-feedback">
                                                    Por favor complete el campo
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('clientes.create')
    @include('clientes.edit')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
</main>
