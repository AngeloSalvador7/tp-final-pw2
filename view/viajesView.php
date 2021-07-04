{{> head}}
{{> headerLogueado}}

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
                <li><a class="text-white" href="viajes">Viajes Activos</a></li>
                <li><a class="text-white" href="viajes/historico">Historico</a></li>
            </ul>

        </div>

        {{#listaViajesActivos}}
            <div class="window text-dark mx-3 col-12 col-sm-9">
                <div>
                    <h1 class="mt-2">Viajes Activos</h1>
                </div>
                <hr />
                {{> alerta}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cancelar</th>
                            <th scope="col">Nro. Viaje</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Fecha Llegada</th>
                            <th scope="col">Posicion</th>
                            <th scope="col">Gastos Realizados</th>
                            <th scope="col">Proforma</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{#viajes}}
                            <form action="viajes/cancelar" method="POST" id="V{{Viaje}}"></form>
                            <tr class="align-middle">
                                <td>
                                    <button type="submit" form="V{{Viaje}}" name="Viaje" value="{{Viaje}}" class="btn m-1 btn-outline-danger"><i class="fas fa-times-circle"></i></button>
                                </td>
                                <td>#{{Viaje}}</td>
                                <td>{{FechaCarga}}</td>
                                <td>{{FechaLlegada}}</td>
                                <td>{{Posicion}}</td>
                                <td>U$D {{Gastos}}</td>
                                <td>
                                    <a href="proformas/detalle/cod={{Viaje}}" class="btn m-1 btn-outline-secondary">Ver</a>
                                    <a href="viajes/comparacion/cod={{Viaje}}" class="btn m-1 btn-outline-secondary">Comparar</a>
                                </td>
                            </tr>
                        {{/viajes}}
                    </tbody>
                </table>
            </div>
        {{/listaViajesActivos}}

        {{#listaViajesHistorico}}
            <div class="window text-dark mx-3 col-12 col-sm-9">
                <div>
                    <h1 class="mt-2">Historia de viajes</h1>
                </div>
                <hr />
                {{> alerta}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nro. Viaje</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Fecha Llegada</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Gastos Realizados</th>
                            <th scope="col">Proforma</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{#viajes}}
                            <form action="viajes/cancelar" method="POST" id="V{{Viaje}}"></form>
                            <tr class="align-middle">
                                <td>#{{Viaje}}</td>
                                <td>{{FechaCarga}}</td>
                                <td>{{FechaLlegada}}</td>
                                <td>{{Estado}}</td>
                                <td>U$D {{Gastos}}</td>
                                <td>
                                    <a href="proformas/detalle/cod={{Viaje}}" class="btn m-1 btn-outline-secondary">Ver</a>
                                    <a href="viajes/comparacion/cod={{Viaje}}" class="btn m-1 btn-outline-secondary">Comparar</a>
                                </td>
                            </tr>
                        {{/viajes}}
                    </tbody>
                </table>
            </div>
        {{/listaViajesHistorico}}

    </div>
</main>

{{> footer}}