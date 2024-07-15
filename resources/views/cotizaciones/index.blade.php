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
                    <th>Fecha de cotización</th>
                    <th>Valor total </th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cotizaciones as $cotizacion)
                    <tr>
                        <td>{{ $cotizacion->cliente->Nombre_cli . " " . $cotizacion->cliente->Apellidos_cli }}</td>
                        <td>{{ $cotizacion->Ancho_coti }} </td>
                        <td>{{ $cotizacion->Alto_coti }}</td>
                        <td>{{ $cotizacion->Mando_coti }}</td>
                        <td>{{ $cotizacion->Tipo_producto->Nombre_tp }}</td>
                        <td>{{ \Carbon\Carbon::parse($cotizacion->Fecha_coti)->format('d/m/Y') }}</td>
                        <td>{{ "$ " . number_format($cotizacion->Valortotal_coti, 0, '.', ',') }}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-success me-2" data-bs-toggle="tooltip" title="Registrar Venta">
                                <ion-icon name="reader-outline"></ion-icon>
                            </button>
                            <button type="button" class="btn btn-warning me-2 edit-btn" data-id="{{ $cotizacion->idCotizaciones }}" data-bs-toggle="modal" data-bs-target="#updateModalCotizaciones{{ $cotizacion->idCotizaciones }}">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                            <form action="{{ url('/cotizaciones/'.$cotizacion -> idCotizaciones) }}" method="post" style="display: inline;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cotización?')">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Ventana modal actualizar-->
    <div class="modal fadebd-example-modal-lg" id="updateModalCotizaciones{{ $cotizacion->idCotizaciones }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateModalLabel{{ $cotizacion->idCotizaciones }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateModalLabel">Actualizar Cotizacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ActualizarCotizacion', $cotizacion->idCotizaciones) }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @method('PUT')    
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="input1{{$cotizacion->idCotizaciones}}" class="form-label">Cedula del Cliente</label>
                                <input type="text" id="input1{{ $cotizacion->idCotizaciones }}" name="Cedula_cli_coti" class="form-control w-75" placeholder="Ingrese Cedula..." required value="{{ $cotizacion->Cedula_cli_coti }}">
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="input2{{ $cotizacion->idCotizaciones }}" class="form-label">Fecha de cotizacion</label>
                                <input type="date" id="input2{{ $cotizacion->idCotizaciones }}" name="Fecha_coti" class="form-control w-95" required value="{{ \Carbon\Carbon::parse($cotizacion->Fecha_coti)->format('d/m/Y') }}">
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="input3{{ $cotizacion->idCotizaciones }}" class="form-label">Radicado</label>
                                <input type="text" id="input3{{ $cotizacion->idCotizaciones }} " name="Radicado_coti" class="form-control w-50" placeholder="Numero de radicado" required value="{{ $cotizacion ->Radicado_coti }}">
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label for="input4{{ $cotizacion->idCotizaciones }}" class="form-label">Alto</label>
                                <input type="text" data-input-numerico id="input4{{ $cotizacion->idCotizaciones }}" name="Alto_coti" class="form-control w-95" placeholder="Ingrese alto..." required value="{{ $cotizacion -> Alto_coti }}">
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="input5{{ $cotizacion->idCotizaciones }}" class="form-label">Ancho</label>
                                <input type="text" data-input-numerico id="input5{{ $cotizacion->idCotizaciones }}" name="Ancho_coti" class="form-control w-95" placeholder="Ingrese ancho..." required value="{{ $cotizacion-> Ancho_coti }}">
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input6{{ $cotizacion->idCotizaciones }}" class="form-label">Producto</label>
                                <select id="input6{{ $cotizacion->idCotizaciones }}" name="Tp_producto_coti" class="form-select w-100" required value="{{ $cotizacion -> Tipo_producto -> Nombre_tp }}">
                                    <option value="" disabled selected>Seleccione una opción...</option>
                                @foreach($Tipo_producto as $tp_producto)
                                    <option value="{{ $tp_producto -> idTipo_producto }}">{{ $tp_producto -> Nombre_tp }}</option> 
                                @endforeach       
                                </select>    
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="input7{{ $cotizacion->idCotizaciones }}" class="form-label">Mando</label>
                                <select id="input7{{$cotizacion->idCotizaciones}}" name="Mando_coti" class="form-select w-100" required>
                                    <option value="" disabled selected>Seleccione...</option>
                                    <option value="Izquierdo" >Izquierdo</option>
                                    <option value="Derecho" >Derecho</option>

                                </select>
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input8{{ $cotizacion->idCotizaciones }}" class="form-label">Valor</label>
                                <input type="text" data-input-numerico id="input8{{ $cotizacion->idCotizaciones }}" name="Valortotal_coti" class="form-control w-95" placeholder="Ingrese valor..." required value="{{ '$ ' . number_format($cotizacion->Valortotal_coti, 0, '.', ',') }}">
                                <div class="invalid-feedback">
                                    Por favor complete el campo
                                </div>
                            </div>


                            <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const input = document.getElementById('input8');

                            input.addEventListener('input', function() {
                                // Get cursor position
                                let cursorPosition = this.selectionStart;
                                
                                // Get the length of the input before formatting
                                let originalLength = this.value.length;

                                // Remove non-numeric characters
                                let value = this.value.replace(/[^0-9]/g, '');
                                if (value === '') return;

                                // Format the number as currency without decimals
                                let numberValue = parseInt(value);
                                let formattedValue = new Intl.NumberFormat('es-CO', { 
                                    style: 'currency', 
                                    currency: 'COP', 
                                    minimumFractionDigits: 0 
                                }).format(numberValue);

                                // Update the input value with the formatted value
                                this.value = formattedValue;

                                // Calculate the new cursor position
                                let newLength = this.value.length;
                                cursorPosition = newLength - (originalLength - cursorPosition);

                                // Set the cursor position back to where it was
                                this.setSelectionRange(cursorPosition, cursorPosition);
                            });

                            const form = input.closest('form');
                            form.addEventListener('submit', function() {
                                let rawValue = input.value.replace(/[^0-9]/g, '');
                                input.value = rawValue;
                            });
                        });
                        </script>
                        </div>
                                            
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"> Actuzalizar </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cancelar</button>
                    </div>
                </form>
            </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>

</main>
