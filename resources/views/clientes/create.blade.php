<div class="modal fadebd-example-modal-lg" id="createModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Registro de cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/clientes') }}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="input01" class="form-label">Nombres</label>
                            <input type="text" id="input01" name="Nombre_cli" class="form-control w-75" placeholder="Ingrese nombre..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input2" class="form-label">Apellidos</label>
                            <input type="text" id="input2" name="Apellidos_cli" class="form-control w-75" placeholder="Ingrese apellidos..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input3" class="form-label">Cedula</label>
                            <input type="text" data-input-numerico id="input3" name="Cedula_cli" class="form-control w-75" placeholder="Ingrese numero de cedula..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input4" class="form-label">Teléfono</label>
                            <input type="text" data-input-numerico id="input4" name="Telefono_cli" class="form-control w-75" placeholder="Ingrese numero de celular..." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input4" class="form-label">Direccion</label>
                            <input type="text" data-input-numerico id="input4" name="Direccion_cli" class="form-control w-75" placeholder="Ingrese direccion, barrio, etc.." required>
                            <div class="invalid-feedback">
                                Por favor complete el campo
                            </div>
                        </div>
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
