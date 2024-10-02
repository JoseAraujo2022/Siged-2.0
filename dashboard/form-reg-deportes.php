<!--INICIO del cont principal-->
<?php require_once "vistas/parte_superior.php" ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registro de Deportes</h6>
        </div>
        <form id="">
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="nombre" class="col-form-label">Nombre del evento</label>
                        <select type="text" class="form-control" id="evento">
                            <option value="">Selecciona el Nombre</option>
                            <option value="I Bolivarianos 1938- COL">I Bolivarianos 1938- Col</option>
                            <option value="I Juegos Panamericanos- ARG">I Juegos Panamericanos- Arg</option>
                            <option value="I Juegos Sudamericanos- Bol">I Juegos Sudamericanos- Bol</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="fecha_inicio" class="col-form-label">Fecha inicio:</label>
                        <label type="date" class="form-control" id="">25/12/2005</label>
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Fecha termina:</label>
                        <label type="date" class="form-control" id="">25/12/2006</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Pais:</label>
                        <label type="text" class="form-control" id="">Bolivia</label>
                    </div>
                    <div class="col-4">
                        <label for="" class="col-form-label">Ciudades Sedes:</label>
                        <label type="text" class="form-control" id="">Bogota</label>
                    </div>
                </div>
                <br>
                <div class="modal-footer"></div>
                <label for="" class="col-form-label">Deportes</label>
                <table class="table table-bordered" id="tablaPersonas" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="21%" height="33">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>Lista de Deportes a Seleccionar</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </td>
                            <td width="24%"><select name="cmb_deporte" size="10" multiple="multiple" id="cmb_deporte"
                                    style="width: 150px">
                                    <option value="1">Ajedrez</option>
                                    <option value="9">BADMINTON</option>
                                    <option value="4">Badminton</option>
                                    <option value="5">Baile Deportivo</option>
                                    <option value="7">Balonmano</option>
                                    <option value="8">Beisbol</option>
                                    <option value="10">Bolos</option>
                                    <option value="12">Bridge</option>
                                    <option value="13">Buceo</option>
                                    <option value="14">Canotaje</option>
                                    <option value="48">COE</option>
                                    <option value="2">Escalada</option>
                                    <option value="17">Esgrima</option>
                                    <option value="18">Esqui Nautico</option>
                                    <option value="19">Fisico Culturismo</option>
                                    <option value="21">Gimnasia</option>
                                    <option value="23">Hockey Cesped</option>
                                    <option value="25">Judo</option>
                                    <option value="26">Karate</option>
                                    <option value="29">Motociclismo</option>
                                    <option value="52">Natacion Aguas Abiertas</option>
                                    <option value="53">Natacion Carreras</option>
                                    <option value="51">Natacion Clavados</option>
                                    <option value="49">NINGUNO</option>
                                    <option value="50">No Participa</option>
                                    <option value="24">Patinaje</option>
                                    <option value="31">Pelota Nacional</option>
                                    <option value="32">Pentatlon</option>
                                    <option value="33">Racquetbol</option>
                                    <option value="34">Remo</option>
                                    <option value="35">Rugby</option>
                                    <option value="36">Softball</option>
                                    <option value="37">Squash</option>
                                    <option value="38">Surf</option>
                                    <option value="39">Taekwondo</option>
                                    <option value="41">Tenis de Mesa</option>
                                    <option value="43">Tiro</option>
                                    <option value="42">Tiro con Arco</option>
                                    <option value="44">Triatlon</option>
                                    <option value="47">Vela</option>
                                    <option value="45">Voleibol</option>
                                    <option value="46">Wushu</option>
                                </select></td>
                            <td width="10%">
                                <p>
                                    <input type="button" class="form-control"  name="btn2" id="btn2" value=">"
                                        onclick="agregarItem('cmb_deporte','cmb_asignados', true,0);deportes_seleccionados++;//cargarOpciones('cmb_asignados','cmb_deportes')">
                                </p>
                                <p>
                                    <input type="button" class="form-control"  name="btn3" id="btn3" value="<"
                                        onclick="agregarItem('cmb_asignados','cmb_deporte', true,0);deportes_seleccionados--; ">
                                </p>
                                <p>&nbsp;</p>
                            </td>
                            <td width="18%">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>Deportes asignados</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </td>
                            <td width="27%"><select name="cmb_asignados[]" size="10" multiple="multiple"
                                    id="cmb_asignados" style="width:  150px;">
                                    <option value="3">Atletismo</option>
                                    <option value="6">BILLAR</option>
                                    <option value="11">Boxeo</option>
                                    <option value="15">Ciclismo</option>
                                    <option value="16">Ecuestre</option>
                                    <option value="20">Futbol</option>
                                    <option value="22">Golf</option>
                                    <option value="27">Lev. de Pesas</option>
                                    <option value="28">Lucha</option>
                                    <option value="30">Natacion</option>
                                    <option value="40">Tenis</option>
                                </select> </td>
                        </tr>
                    </tbody>
                </table>
                <tr>
                    <label for="" class="col-form-label">Asignar Escenarios</label>
                    <div class="row"></div>
                    <input type="button" class="btn btn-primary" name="agregar" id="button" value="Agregar fila"
                        onclick="agregarFilaEscenario('grd_escenarios');">
                    <input type="button" class="btn btn-danger btnBorrar" name="eliminar" id="button"
                        value="Eliminar fila" onclick="eliminarFila('grd_escenarios','chkseleccion')">
                    <span style="font-weight: bold;">Nota: </span><span>Si modifica la lista de deportes
                        asignados se perderan los datos de escenarios ingresados</span>
                </tr>
                <br>
                <br>
                <div class="modal-footer">
                    <div style="text-align: center">
                        <button type="submit" id="btnGuardar" class="btn btn-success">Grabar</button>
                        <button type="button" class="btn btn-danger btnBorrar">Eliminar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>