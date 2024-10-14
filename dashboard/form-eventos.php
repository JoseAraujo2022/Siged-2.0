<!--INICIO del cont principal-->
<?php require_once "vistas/parte_superior.php" ?>
<!--INICIO del cont principal-->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registro de Eventos deportivos</h6>
        </div>
        <form id="">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="fecha_inicio" class="col-form-label">Fecha inicio:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Fecha termina:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Pais:</label>
                        <input type="text" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Provincia:</label>
                        <input type="text" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Ciudad Sede:</label>
                        <input type="text" class="form-control" id="">
                    </div>
                </div>
                <br>
                <div class="modal-footer"></div>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Numérica inicial:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Numérica terminal:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Nominal inicial:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Nominal terminal:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                </div>
                <br>
                <div class="modal-footer"></div>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Fecha inauguracion:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Fecha clausura:</label>
                        <input type="date" class="form-control" id="">
                    </div>
                </div>
                <br>
                <div class="modal-footer"></div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="col-form-label">Notas</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>