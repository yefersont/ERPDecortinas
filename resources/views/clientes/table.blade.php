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
                            <button type="button" class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $cliente->idClientes }}" data-nombre="{{ $cliente->Nombre_cli }}" data-apellidos="{{ $cliente->Apellidos_cli }}" data-cedula="{{ $cliente->Cedula_cli }}" data-telefono="{{ $cliente->Telefono_cli }}" data-direccion="{{ $cliente->Direccion_cli }}"><ion-icon name="create-outline"></ion-icon></button>
                            <form action="{{ url('/clientes/'.$cliente->idClientes) }}" method="post" style="display: inline;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar al propietario?')"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>