{{> head}}
{{> headerLogueado}}

{{> navSupervisor}}

<main class="container-fluid">
    <div id="main" class="row">

        {{#listaViajesActivos}}
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

        {{#comparacion}}
            <div class="window text-dark mx-3 col">
                <div>
                    <h1 class="mt-2">Contraste Presupuesto/Factura #{{id}}</h1>
                </div>
                <hr />
                {{> alerta}}
                <table class="table mb-4">
                    <h2>Comparación Costos</h2>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Estimado</th>
                            <th scope="col">Real</th>
                            <th scope="col">Diferencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td><b>Peaje</b></td>
                            <td>U$D{{costo_peaje_estimado}}</td>
                            <td>U$D{{costo_peaje}}</td>
                            <td>{{{ComparacionPeaje}}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td><b>Viaticos</b></td>
                            <td>U$D{{costo_viaticos_estimado}}</td>
                            <td>U$D{{costo_viaticos}}</td>
                            <td>{{{ComparacionViaticos}}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td><b>Hospedaje</b></td>
                            <td>U$D{{costo_hospedaje_estimado}}</td>
                            <td>U$D{{costo_hospedaje}}</td>
                            <td>{{{ComparacionHospedaje}}}</td>
                        </tr>
                        <tr class="align-middle">
                            <td><b>Extras</b></td>
                            <td>U$D{{extra_estimado}}</td>
                            <td>U$D{{extra}}</td>
                            <td>{{{ComparacionExtras}}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><b>TOTAL: </b></td>
                            <td><b>{{{Total}}}</b></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <h2>Comparación Viaje</h2>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Estimado</th>
                            <th scope="col">Real</th>
                            <th scope="col">Diferencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td><b>Combustible</b></td>
                            <td>{{combustible_estimado}}Lts.</td>
                            <td>{{combustible_real}}Lts.</td>
                            <td>{{ComparacionCombustible}}Lts.</td>
                        </tr>
                        <tr class="align-middle">
                            <td><b>Kilometros</b></td>
                            <td>{{km_estimado}}Km</td>
                            <td>{{km_real}}Km</td>
                            <td>{{ComparacionKilometros}}Km</td>
                        </tr>
                        <tr class="align-middle">
                            <td><b>Fecha de Carga</b></td>
                            <td>{{etd}}</td>
                            <td>{{fecha_carga}}</td>
                            <td></td>
                        </tr>
                        <tr class="align-middle">
                            <td><b>Fecha de Llegada</b></td>
                            <td>{{eta}}</td>
                            <td>{{fecha_llegada}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-3 text-end">
                    <a href="viajes" class="btn mt-2 btn-outline-success">Volver</a>
                </div>
            </div>
        {{/comparacion}}

    </div>
</main>

{{> footer}}