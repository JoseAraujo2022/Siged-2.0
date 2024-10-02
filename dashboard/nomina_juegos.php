<?php require_once "vistas/parte_superior.php" ?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Consulta de Nómina de Juegos
                </h6>
            </div>
            <br>

            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="nombre" class="col-form-label">Juego-Evento:</label>
                        <select type="text" class="form-control" id="evento">
                            <option value="">Seleccione</option>
                            <option value="I Bolivarianos 1938- COL">I Bolivarianos 1938- Col</option>
                            <option value="I Juegos Panamericanos- ARG">I Juegos Panamericanos- Arg</option>
                            <option value="I Juegos Sudamericanos- Bol">I Juegos Sudamericanos- Bol</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="" class="col-form-label">Año:</label>
                        <input type="text" class="form-control" id=""></input>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div style="text-align: center">
                        <button type="submit" id="btnGuardar" class="btn btn-success">Consultar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--FIN del cont principal-->
    <?php require_once "vistas/parte_inferior.php" ?>