<?php require_once "vistas/parte_superior.php" ?>
<!--conexion de base datos--->
<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT ID_TIPOJUEGO, DESCRIPCION FROM tb_tipo_juego";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<title>Consulta de Nómina de Juegos</title>
<style>
    h1 {
        color: #4a4a4a;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select,
    input[type="number"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button:hover {
        background-color: #45a049;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 15px;
        border: 1px solid #888;
        width: 90%;
        max-width: 1000px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    #searchInput {
        margin-bottom: 10px;
        width: 100%;
        padding: 8px;
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Consulta de Nómina de Juegos</h6>
        </div>
        <div class="card-body">
            <form id="consultaForm" method="post">
                <div class="row">
                    <div class="col-4 form-group">
                        <label for="juegoEvento">Juego-Evento:</label>
                        <select id="juegoEvento" name="juegoEvento" required>
                            <option selected disabled>Seleccione un evento</option>
                                <?php
                                foreach ($data as $valores):
                                    echo '<option value="' . $valores["ID_TIPOJUEGO"] . '">' . $valores["DESCRIPCION"] . '</option>';
                                endforeach;
                                ?>
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="ano">Año:</label>
                        <input type="number" id="ano" required min="1900" max="2099" step="1">
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Consultar</button>
            </form>
        </div>
    </div>

    <div id="resultadosModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Resultados de la Consulta</h2>
            <input type="text" id="searchInput" placeholder="Buscar en la tabla...">
            <button class="btn btn-success" id="downloadPdf">Descargar PDF</button>
            <table id="resultadosTabla" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Juegos</th>
                        <th>País</th>
                        <th>Deporte</th>
                        <th>Prueba</th>
                        <th>Marca</th>
                        <th>Oro</th>
                        <th>Plata</th>
                        <th>Bronce</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="resultadosBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('consultaForm');
    const modal = document.getElementById('resultadosModal');
    const closeBtn = document.querySelector('.close');
    const searchInput = document.getElementById('searchInput');
    const downloadBtn = document.getElementById('downloadPdf');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const juegoEvento = document.getElementById('juegoEvento').value;
        const ano = document.getElementById('ano').value;

        const resultados = [
            { nombre: "Juan Pérez", juegos: juegoEvento, pais: "Ecuador", deporte: "Atletismo", prueba: "100m", marca: "9.95s", oro: 1, plata: 0, bronce: 0 },
            { nombre: "María González", juegos: juegoEvento, pais: "Colombia", deporte: "Natación", prueba: "200m libre", marca: "1:54.25", oro: 0, plata: 1, bronce: 0 },
            { nombre: "Carlos Rodríguez", juegos: juegoEvento, pais: "Venezuela", deporte: "Judo", prueba: "-73kg", marca: "Victoria", oro: 0, plata: 0, bronce: 1 }
        ];

        mostrarResultados(resultados);
        modal.style.display = "block";
    });

    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = (event) => { if (event.target == modal) modal.style.display = "none"; }

    function mostrarResultados(resultados) {
        const tbody = document.getElementById('resultadosBody');
        tbody.innerHTML = resultados.map(r => `
            <tr>
                <td>${r.nombre}</td>
                <td>${r.juegos}</td>
                <td>${r.pais}</td>
                <td>${r.deporte}</td>
                <td>${r.prueba}</td>
                <td>${r.marca}</td>
                <td>${r.oro}</td>
                <td>${r.plata}</td>
                <td>${r.bronce}</td>
                <td>${r.oro + r.plata + r.bronce}</td>
            </tr>
        `).join('');
    }

    searchInput.addEventListener('keyup', function () {
        const filter = searchInput.value.toUpperCase();
        Array.from(document.querySelectorAll('#resultadosTabla tbody tr')).forEach(row => {
            row.style.display = row.innerText.toUpperCase().includes(filter) ? '' : 'none';
        });
    });

    downloadBtn.addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');
        doc.autoTable({ html: '#resultadosTabla' });
        doc.save('resultados_juegos.pdf');
    });
</script>

<?php require_once "vistas/parte_inferior.php" ?>