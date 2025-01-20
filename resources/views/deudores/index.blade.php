

@include('inc.header')

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">


<main id="main-section">


    <div class="titulo">
        <h2>Deudores</h2>
        <a><ion-icon name="notifications-circle-outline"></ion-icon> <span>Notificaciones</span></a>
    </div>
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <table id="tablas">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Valor de venta</th>
                    <th>Abono</th>
                    <th>Fecha de abono</th>
                    <th>Restante</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deudores as $deudor)
                    @php
                        $restante = $deudor->cotizacione->Valortotal_coti - $deudor->Abono_deudor;
                        $estado = $restante == 0 ? 'Pagado' : 'Pendiente';
                        $fechaFormateada = \Carbon\Carbon::parse($deudor->Fecha_abono_deudor)->format('Y-m-d'); // Formatear la fecha
                    @endphp
                    <tr>
                        <td>{{ $deudor->cliente->Nombre_cli . " " . $deudor->cliente->Apellidos_cli }}</td>
                        <td>{{ "$ " . number_format($deudor->cotizacione->Valortotal_coti, 0, '.', ',') }}</td>
                        <td>{{ "$ " . number_format($deudor->Abono_deudor, 0, '.', ',') }}</td>
                        <td>{{ $fechaFormateada }}</td>
                        <td>
                            {{ "$ " . number_format($restante, 0, '.', ',') }}
                        </td>
                        <td class="{{ $estado == 'Pagado' ? 'text-success' : 'text-danger' }}">
                            {{ $estado }}
                        </td>
                        <td>
                            <!-- Condición para deshabilitar el botón si el estado es "Pagado" -->
                            <button 
                                type="button" 
                                class="btn btn-success" 
                                data-bs-toggle="modal" 
                                data-bs-target="#exampleModal{{ $deudor->idDeudores }}"
                                {{ $estado == 'Pagado' ? 'disabled' : '' }}  <!-- Aquí se deshabilita si el estado es 'Pagado' -->
                            
                                <ion-icon name="checkmark-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>


                    <div class="modal fade" id="exampleModal{{ $deudor->idDeudores }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cantidad del abono</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('deudores.update',$deudor->idDeudores)}}" method="POST">
                                    @method('PUT')    
                                    @csrf

                                    <div class="modal-body">
                                        <div class="input-group flex-nowrap">
                                            <input type="text" name="Segundo_Abono_deudor" id="Segundo_abono" class="form-control w-75" placeholder="$" aria-describedby="addon-wrapping" required>
                                            <div class="invalid-feedback">Por favor complete el campo</div>
                                        </div>                  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <input type="hidden" name="deudor_id" value="{{ $deudor->idDeudor }}">
                                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Estás seguro de que deseas registrar como venta?')">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sumarRestante = () => {
                let totalRestante = 0;

                // Seleccionar todas las filas de la tabla
                const filas = document.querySelectorAll('#tablas tbody tr');

                filas.forEach(fila => {
                    // Seleccionar la celda de la columna "Restante" (índice 4 en este caso)
                    const celdaRestante = fila.querySelectorAll('td')[4];

                    if (celdaRestante) {
                        // Obtener el valor numérico eliminando caracteres no deseados
                        const valor = parseInt(celdaRestante.textContent.replace(/[^0-9]/g, ''), 10);
                        if (!isNaN(valor)) {
                            totalRestante += valor; // Sumar el valor
                        }
                    }
                });

                return totalRestante;
            };

            // Llamar a la función para sumar el "Restante"
            const totalRestante = sumarRestante();

            // Insertar el total en el elemento <h3 class="mb-0 text-success">
            const totalRestanteElement = document.querySelector('.container h3.mb-0.text-success');
            if (totalRestanteElement) {
                totalRestanteElement.textContent = `$ ${totalRestante.toLocaleString('es-CO')}`;
            }
        });
    </script>



    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded shadow">
            <span class="fs-5">Total deuda</span>
            <h3 class="mb-0 text-success"></h3>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>


    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputAbono = document.querySelectorAll('#Segundo_abono');
        const forms = document.querySelectorAll('form');

        // Formatear el valor mientras se escribe
        inputAbono.forEach(input => {
            input.addEventListener('input', (event) => {
                let valor = event.target.value.replace(/[^0-9]/g, '');
                if (valor) {
                    valor = parseInt(valor, 10).toLocaleString('es-CO', {
                        style: 'currency',
                        currency: 'COP',
                        minimumFractionDigits: 0
                    });
                }
                event.target.value = valor;
            });

            // Formatear correctamente al salir del campo
            input.addEventListener('blur', (event) => {
                let valor = event.target.value.replace(/[^0-9]/g, '');
                if (valor) {
                    valor = parseInt(valor, 10).toLocaleString('es-CO', {
                        style: 'currency',
                        currency: 'COP',
                        minimumFractionDigits: 0
                    });
                }
                event.target.value = valor;
            });
        });

        // Limpiar el formato antes de enviar el formulario
        forms.forEach(form => {
            form.addEventListener('submit', (event) => {
                inputAbono.forEach(input => {
                    const valorSinFormato = input.value.replace(/[$,.]/g, ''); // Elimina símbolos y puntos
                    input.value = valorSinFormato; // Establece el valor limpio en el campo
                });
            });
        });
    });
    </script>

</main>
