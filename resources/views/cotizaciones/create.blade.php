<div class="modal fadebd-example-modal-lg" id="createModalCotizaciones" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Registrar Cotizacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/cotizaciones') }}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="input1" class="form-label">Cedula del Cliente</label>
                            <input type="text" id="input1" name="Cedula_cli_coti" class="form-control w-75" placeholder="Ingrese Cedula..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="input2" class="form-label">Fecha de cotizacion</label>
                            <input type="date" id="input2" name="Fecha_coti" class="form-control w-95" required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="input3" class="form-label">Radicado</label>
                            <input type="text" id="input3" name="Radicado_coti" class="form-control w-50" placeholder="Numero de radicado" required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="input4" class="form-label">Alto</label>
                            <input type="text" data-input-numerico id="input4" name="Alto_coti" class="form-control w-95" placeholder="Ingrese alto..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="input5" class="form-label">Ancho</label>
                            <input type="text" data-input-numerico id="input5" name="Ancho_coti" class="form-control w-95" placeholder="Ingrese ancho..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="input6" class="form-label">Producto</label>
                            <select id="input6" name="Tp_producto_coti" class="form-select w-100" required>
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
                            <label for="input7" class="form-label">Mando</label>
                            <select id="input7" name="Mando_coti" class="form-select w-100" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="Izquierdo" >Izquierdo</option>
                                <option value="Derecho" >Derecho</option>

                            </select>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="input8" class="form-label">Valor</label>
                            <input type="text" data-input-numerico id="input8" name="Valortotal_coti" class="form-control w-95" placeholder="Ingrese valor..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>


                        <script>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('input7');

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
                    <button type="submit" class="btn btn-success"> Registrar </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

