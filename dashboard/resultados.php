<!--INICIO del cont principal-->
<?php require_once "vistas/parte_superior.php" ?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registro detallado de Resultados de Eventos Deportivos
                </h6>
            </div>
            <br>

            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="nombre" class="col-form-label">Juego-Evento</label>
                        <select type="text" class="form-control" id="evento">
                            <option value="">Seleccione</option>
                            <option value="I Bolivarianos 1938- COL">I Bolivarianos 1938- Col</option>
                            <option value="I Juegos Panamericanos- ARG">I Juegos Panamericanos- Arg</option>
                            <option value="I Juegos Sudamericanos- Bol">I Juegos Sudamericanos- Bol</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="nombre" class="col-form-label">Deporte</label>
                        <select type="text" class="form-control" id="evento">
                            <option value="">Seleccione </option>
                            <option value="">Atletismo</option>
                            <option value="">Billar</option>
                            <option value="">Boxeo</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="">
                    <table class="table table-bordered" id="tablaPersonas" width="100%" cellspacing="0">
                        <tr>
                            <div class="row"></div>
                            <input type="button" class="btn btn-primary" name="agregar" id="button" value="Agregar"
                                onclick="agregarFilaEscenario('grd_escenarios');">
                            <input type="button" class="btn btn-danger btnBorrar" name="eliminar" id="button"
                                value="Eliminar" onclick="eliminarFila('grd_escenarios','chkseleccion')">

                        </tr>
                        <br><br>
                        <thead>
                            <tr>
                                <th>--</th>
                                <th>Deporte</th>
                                <th>Deportista</th>
                                <th>Fecha</th>
                                <th>División-Prueba-Modalidad</th>
                                <th>Marcas</th>
                                <th>Oro</th>
                                <th>Plata</th>
                                <th>Bronce</th>
                                <th>Posicion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>$320,800</td>
                                <td>2</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="modal-footer">
                    <div style="text-align: center">
                        <button type="submit" id="btnGuardar" class="btn btn-success">Grabar</button>
                        <button type="button" class="btn btn-danger btnBorrar">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--FIN del cont principal-->
    <?php require_once "vistas/parte_inferior.php" ?>