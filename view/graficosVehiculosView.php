{{> head}}
{{> headerLogueado}}
<script src="public/js/vehiculosChart.js"></script>
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
            <form action="datos/vehiculos/" method="GET" class="d-flex mt-3">
                <label for="vehiculo" class="mt-2 me-3">Vehiculo:</label>
                <select class="form-select" id="vehiculo" name="vehiculo">
                    <option selected hidden disabled>Seleccione un Vehiculo</option>
                    {{#vehiculos}}
                        <option value="{{id}}">{{marca}} - {{modelo}} - {{patente}}</option>
                    {{/vehiculos}}
                    {{#seleccionado}}
                        <option value="{{id}}" selected hidden>{{marca}} - {{modelo}} - {{patente}}</option>
                    {{/seleccionado}}
                </select>
                <button type="submit" class="btn btn-outline-info ms-2">Buscar</button>
            </form>
            <div class="m-3">
                <div id="chart_vehiculo"></div>
            </div>
        </div>
    </div>
</main>

{{> footer}}