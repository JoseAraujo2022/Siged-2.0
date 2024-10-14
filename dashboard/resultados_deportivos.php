<?php require_once "vistas/parte_superior.php" ?>
<!--INICIO del cont principal-->

<div class="container-fluid">
        <style>
            .medal {
                color: gold;
                margin-right: 5px;
            }

            details {
                margin-bottom: 20px;
            }

            summary {
                cursor: pointer;
                font-weight: bold;
                font-size: 20px;

            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .event-logo {
                width: 30px;
                height: 30px;
                margin-right: 10px;
                vertical-align: middle;
            }

            h1 {
                margin: 0 0 20px 0;
            }

            .bold {
                font-weight: bold;
            }

            .nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .nav-items {
                display: flex;
                gap: 20px;
            }

            .nav-item {
                text-decoration: none;
                color: black;
            }

            .dropdown::after {
                content: "▼";
                font-size: 0.7em;
                margin-left: 5px;
            }

            .buttons {
                display: flex;
                gap: 10px;
            }

            .btn {
                padding: 10px 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                text-decoration: none;
                color: black;
            }

            .btn-primary {
                padding: 8px 16px;
                background-color: #00a86b;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .medal-card {
                background-color: white;
                border: 1px solid #e0e0e0;
                border-radius: 5px;
                padding: 20px;
                margin-top: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .medal-icon {
                font-size: 24px;
                margin-right: 10px;
            }
        </style>
		<div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="nav">
                <div class="nav-items">
                    <div class="buttons">
                        <a href="tabla_persona.php" class="btn">← Volver</a>
                        <a href="tabla_persona.php" class="btn btn-primary">Información personal</a>
                        <a href="tabla_deportistas.php" class="btn btn-primary">Ayudas y becas</a>
                        <a href="resultados_deportivos.php" class="btn btn-primary">Resultados deportivos</a>
                    </div>
                </div>
                <a href="#" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Editar datos
                </a>
            </nav>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div style="margin: 25px;">NEISI PATRICIA DAJOMES BARRERA</div>
                </div>
            </div>
            <main>
                <div class="medal-card">
                    <span class="medal-icon" role="img" aria-label="Medalla de oro">🥇</span>
                    <span>3</span>
                </div>
            </main>
            <details>
                <summary>JUEGOS REGIONALES</summary>
                <br>
                <table>
                    <tr>
                        <td>
                            <img src="https://conpaas.einzelnet.com/services/sportsservice/api/media/287eadd638c36516c14a93bb9fcbedda760199b0"
                                alt="Logo Juegos Bolivarianos" class="event-logo">
                            2022
                        </td>
                        <td>XIX Juegos Bolivarianos, Valledupar 2...</td>
                        <td>🏅 2</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>julio 4<br>15:30 - 18:00</td>
                        <td>Halterofilia<br>81kg Dos Tiempos - Mujeres</td>
                        <td>Final<br>Grupo A</td>
                        <td>1</td>
                        <td>140</td>
                        <td>Oro<br>2022-07-04</td>
                        <td>🏅</td>
                    </tr>
                    <tr>
                        <td>julio 4<br>15:30 - 18:00</td>
                        <td>Halterofilia<br>81kg Arrancada - Mujeres</td>
                        <td>Final<br>Grupo A</td>
                        <td>1</td>
                        <td>115</td>
                        <td>Oro<br>2022-07-04</td>
                        <td>🏅</td>
                    </tr>
                </table>
            </details>

            <details>
                <summary>JUEGOS OLÍMPICOS</summary>
                <br>
                <table>
                    <tr>
                        <td>
                            <img src="https://conpaas.einzelnet.com/services/sportsservice/api/media/549abe57336e3ade07771340f2187932133dfd15"
                                alt="Logo Juegos Olímpicos" class="event-logo">
                            2021
                        </td>
                        <td>XXXII Juegos Olímpicos de Verano Tokio 2020</td>
                        <td>🏅</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>agosto 1<br>05:50 - 07:40</td>
                        <td>Halterofilia<br>Mujeres 76kg</td>
                        <td>Final<br>Grupo A</td>
                        <td>1</td>
                        <td>263</td>
                        <td>Oro<br>2021-08-01</td>
                        <td>🏅</td>
                    </tr>
                </table>
            </details>
        </div>
    </div>
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>