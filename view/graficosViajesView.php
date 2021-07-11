{{> head}}
{{> headerLogueado}}
<script src="public/js/viajesChart.js"></script>
{{> navSupervisor}}

<main class="container-fluid">
    <div id="main" class="row">
        <div class="info col-12 col-sm-2 bg-dark p-0">

            <div class="mt-3 me-3 text-white text-end">
                <button class="btn btn-outline-gray rounded"></button>
            </div>

            <div class="text-center text-white mb-5">
                <h3 class="mb-3"></h3>
            </div>

            <ul class="opciones">
                <li><a class="text-white" href="datos">Estadisticas Viajes</a></li>
                <li><a class="text-white" href="datos/vehiculos">Resumen Vehiculos</a></li>
            </ul>

        </div>
        <div class="window text-dark mx-3 col-12 col-sm-9">
            <div class="d-flex m-3">
                <div id="chart_ganancias"></div>
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
</main>

{{> footer}}