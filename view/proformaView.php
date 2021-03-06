{{> head}}
{{> headerLogueado}}

{{> navSupervisor}}

<main class="container-fluid">
    <div id="main" class="row">
        {{#listaProformas}}
            <div class="info col-12 col-sm-2 bg-dark p-0">

                <div class="mt-3 me-3 text-white text-end">
                    <button class="btn btn-outline-gray rounded"></button>
                </div>

                <div class="text-center text-white mb-5">
                    <h3 class="mb-3"></h3>
                </div>

                <ul class="opciones">
                    <li><a class="text-white" href="proformas">Proformas Vigentes</a></li>
                    <li><a class="text-white" href="proformas/historico">Historico</a></li>
                </ul>

            </div>
            <div class="window text-dark mx-3 col-12 col-sm-9">
                <div>
                    <a href="proformas/nueva" class="btn mt-2 btn-outline-success float-end">Cargar Proforma</a>
                    <h1 class="mt-2">Proformas</h1>
                </div>
                <hr />
                {{> alerta}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Ver</th>
                            <th scope="col">Nro. Proforma</th>
                            <th scope="col">ETD</th>
                            <th scope="col">ETA</th>
                            <th scope="col">Carga</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Chofer</th>
                            <th scope="col">Presupuesto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{#proformas}}
                            <form action="proformas/eliminar" method="POST" id="P{{Proforma}}"></form>
                            <tr class="align-middle">
                                <td><a href="proformas/detalle/cod={{Proforma}}" class="btn m-1 btn-outline-info"><i class="fas fa-eye"></i></a></td>
                                <td>#{{Proforma}}</td>
                                <td>{{ETD}}</td>
                                <td>{{ETA}}</td>
                                <td>{{Carga}}</td>
                                <td>{{Cliente}}</td>
                                <td>{{Chofer}}</td>
                                <td>U$D {{Costo}}</td>
                                <td>
                                    <a href="proformas/edicion/cod={{Proforma}}" class="btn m-1 btn-outline-secondary">Editar</a>
                                    <button type="submit" form="P{{Proforma}}" name="proforma" value="{{Proforma}}" class="btn m-1 btn-outline-danger">Borrar</button>
                                </td>
                            </tr>
                        {{/proformas}}
                    </tbody>
                </table>
            </div>
        {{/listaProformas}}

        {{#listaProformasHistorico}}
            <div class="info col-12 col-sm-2 bg-dark p-0">

                <div class="mt-3 me-3 text-white text-end">
                    <button class="btn btn-outline-gray rounded"></button>
                </div>

                <div class="text-center text-white mb-5">
                    <h3 class="mb-3"></h3>
                </div>

                <ul class="opciones">
                    <li><a class="text-white" href="proformas">Proformas Vigentes</a></li>
                    <li><a class="text-white" href="proformas/historico">Historico</a></li>
                </ul>

            </div>
            <div class="window text-dark mx-3 col-12 col-sm-9">
                <div>
                    <h1 class="mt-2">Historico de Proformas</h1>
                </div>
                <hr />
                {{> alerta}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Ver</th>
                            <th scope="col">Nro. Proforma</th>
                            <th scope="col">ETD</th>
                            <th scope="col">ETA</th>
                            <th scope="col">Carga</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Chofer</th>
                            <th scope="col">Presupuesto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{#proformas}}
                            <form action="proformas/eliminar" method="POST" id="P{{Proforma}}"></form>
                            <tr class="align-middle">
                                <td><a href="proformas/detalle/cod={{Proforma}}" class="btn m-1 btn-outline-info"><i class="fas fa-eye"></i></a></td>
                                <td>#{{Proforma}}</td>
                                <td>{{ETD}}</td>
                                <td>{{ETA}}</td>
                                <td>{{Carga}}</td>
                                <td>{{Cliente}}</td>
                                <td>{{Chofer}}</td>
                                <td>U$D {{Costo}}</td>
                                <td>
                                    <button type="submit" form="P{{Proforma}}" name="proforma" value="{{Proforma}}" class="btn m-1 btn-outline-danger">Borrar</button>
                                </td>
                            </tr>
                        {{/proformas}}
                    </tbody>
                </table>
            </div>
        {{/listaProformasHistorico}}


        {{#detalleProforma}}
            <div class="window text-dark mx-3 col">
                <div>
                    <a href="proformas" class="btn mt-2 btn-outline-success float-end">Volver</a>
                    <a href="proformas/exportarPdf?viaje={{codigoProforma}}" class="btn mt-2  btn-outline-info float-end me-3"  target="_blank">Exportar a PDF</a>
                    <h1 class="mt-2">Informaci??n de Proforma Nro: #{{codigoProforma}}</h1>
                </div>
                <hr />
                {{> alerta}}
                {{#proforma}}
                    <div class="d-flex flex-wrap justify-content-between p-4 bg-gris">
                        <h2 class="flex-basis mb-0">Presupuesto</h2>
                        <hr class="text-white flex-basis">
                        <div>
                            <strong>Peajes: </strong>U$D{{Peaje}}
                        </div>
                        <div>
                            <strong>Viaticos: </strong>U$D{{Viaticos}}
                        </div>
                        <div>
                            <strong>Hospedaje: </strong>U$D{{Hospedaje}}
                        </div>
                        <div>
                            <strong>Extras: </strong>U$D{{Extras}}
                        </div>
                        <div>
                            <strong>Tarifa: </strong>U$D{{Tarifa}}
                        </div>
                        <div>
                            <strong>TOTAL: </strong>U$D{{Costo}}
                        </div>
                    </div>


                    <div class="d-flex flex-wrap justify-content-between p-4 bg-grisClaro">
                        <h2 class="flex-basis mb-0">Viaje</h2>
                        <hr class="text-white flex-basis">
                        <div>
                            <strong>Origen: </strong>{{Origen}}
                        </div>
                        <div>
                            <strong>Destino: </strong>{{Destino}}
                        </div>
                        <div>
                            <strong>ETD: </strong>{{ETA}}
                        </div>
                        <div>
                            <strong>ETA: </strong>{{ETA}}
                        </div>
                        <div>
                            <strong>Kilometros Estimados: </strong>{{Kilometros}}Km.
                        </div>
                        <div>
                            <strong>Combustible Estimados: </strong>{{Combustible}}Lts.
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between p-4 bg-gris">
                        <h2 class="flex-basis mb-0">Cliente</h2>
                        <hr class="text-white flex-basis">
                        <div>
                            <strong>Denominacion: </strong>{{Denominacion}}
                        </div>
                        <div>
                            <strong>Razon Social: </strong>{{RazonSocial}}
                        </div>
                        <div>
                            <strong>CUIT: </strong>{{CUIT}}
                        </div>
                        <div>
                            <strong>Direccion: </strong>{{Direccion}}
                        </div>
                        <div>
                            <strong>Telefono: </strong>{{Telefono}}
                        </div>
                        <div>
                            <strong>Email: </strong>{{EmailCliente}}
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between p-4 bg-grisClaro">
                        <h2 class="flex-basis mb-0">Chofer</h2>
                        <hr class="text-white flex-basis">
                        <div>
                            <strong>Apellido y Nombre: </strong>{{Chofer}}
                        </div>
                        <div>
                            <strong>DNI: </strong>{{DNI}}
                        </div>
                        <div>
                            <strong>Email: </strong>{{EmailChofer}}
                        </div>
                        <div>
                            <strong>Licencia: </strong>{{NumeroLicencia}}
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between p-4 bg-gris">
                        <h2 class="flex-basis mb-0">Vehiculos</h2>
                        <hr class="text-white flex-basis">
                        <div class="flex-fill">
                            <div class="d-flex flex-wrap justify-content-between me-sm-4">
                                <h3 class="flex-basis mb-0 text-center">Tractor</h3>
                                <hr class="text-white flex-basis">
                                <div>
                                    <strong>Marca: </strong>{{TMarca}}
                                </div>
                                <div>
                                    <strong>Patente: </strong>{{TPatente}}
                                </div>
                                <div>
                                    <strong>Modelo: </strong>{{TModelo}}
                                </div>
                            </div>
                        </div>

                        <div class="flex-fill">
                            <div class="d-flex flex-wrap justify-content-between ms-sm-4">
                                <h3 class="flex-basis mb-0 text-center">Arrastre</h3>
                                <hr class="text-white flex-basis">
                                <div>
                                    <strong>Patente: </strong>{{APatente}}
                                </div>
                                <div>
                                    <strong>Marca: </strong>{{AMarca}}
                                </div>
                                <div>
                                    <strong>Modelo: </strong>{{AModelo}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between p-4 bg-grisClaro mb-4">
                        <h2 class="flex-basis mb-0">Carga</h2>
                        <hr class="text-white flex-basis">
                        <div>
                            <strong>Peso Neto: </strong>{{Peso}}Kg
                        </div>
                        <div>
                            <strong>Descripci??n: </strong>{{DescripcionCarga}}
                        </div>
                        <div>
                            <strong>Hazard: </strong>{{Hazard}}
                        </div>
                        <div>
                            <strong>IMO Class: </strong>{{IMOClass}}
                        </div>
                        <div>
                            <strong>IMO Sub-Class: </strong>{{IMOSClass}}
                        </div>
                        <div>
                            <strong>Reefer: </strong>{{Reefer}}
                        </div>
                        <div>
                            <strong>Temperatura: </strong>{{Temperatura}}
                        </div>
                        <div>
                            <strong>Tipo de Carga: </strong>{{TipoCarga}}
                        </div>
                    </div>
                {{/proforma}}
                <div class="text-center mb-4 back" >
                    <img src="/proformas/mostrarQr/id_viaje={{codigoProforma}}"/>
                </div>
            </div>
        {{/detalleProforma}}

        {{#formNuevaProforma}}
            <div class="col">
                <form action="proformas/generar" method="POST" class="row m-5" id="formProforma">
                    {{> alerta}}
                    <h2 class="col-12">Presupuesto</h2>
                    <hr class="col-12">

                    <div class="form-group col-12 col-md-4">
                        <label for="Peaje" class="mb-1">Estimado Peaje:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">U$D</span>
                            <input type="number" class="form-control" id="Peaje" name="Peaje">
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="Viaticos" class="mb-1">Estimado Viaticos:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">U$D</span>
                            <input type="number" class="form-control" id="Viaticos" name="Viaticos">
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="Hospedaje" class="mb-1">Estimado Hospedaje:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">U$D</span>
                            <input type="number" class="form-control" id="Hospedaje" name="Hospedaje">
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Extras" class="mb-1">Estimado Extras:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">U$D</span>
                            <input type="number" class="form-control" id="Extras" name="Extras">
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Tarifa" class="mb-1">Tarifa:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">U$D</span>
                            <input type="number" class="form-control" id="Tarifa" name="Tarifa">
                        </div>
                    </div>

                    <hr class="col-12">
                    <h2 class="col-12">Viaje</h2>
                    <hr class="col-12">

                    <div class="form-group col-12 col-md-6">
                        <label for="Origen" class="mb-1">Origen:</label>
                        <input type="text" class="form-control mb-3" id="Origen" name="Origen">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Destino" class="mb-1">Destino:</label>
                        <input type="text" class="form-control mb-3" id="Destino" name="Destino">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="ETD" class="mb-1">ETD:</label>
                        <input type="date" class="form-control mb-3" id="ETD" name="ETD">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="ETA" class="mb-1">ETA:</label>
                        <input type="date" class="form-control mb-3" id="ETA" name="ETA">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Kilometros" class="mb-1">Kilometros Estimados:</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="Kilometros" name="Kilometros">
                            <span class="input-group-text">Km.</span>
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Combustible" class="mb-1">Combustible Estimados:</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="Combustible" name="Combustible">
                            <span class="input-group-text">Lts.</span>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="Chofer" class="mb-1">Chofer:</label>
                        <select name="Chofer" id="Chofer" class="form-select mb-3">
                            <option value="" selected disabled hidden>Chofer Responsable:</option>
                            {{#Choferes}}
                                <option value="{{IdChofer}}">{{InfoChofer}}</option>
                            {{/Choferes}}
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Tractor" class="mb-1">Tractor:</label>
                        <select name="Tractor" id="Tractor" class="form-select mb-3">
                            <option value="" selected disabled hidden>Tractor a utilizar:</option>
                            {{#Tractores}}
                                <option value="{{IdTractor}}">{{InfoTractor}}</option>
                            {{/Tractores}}
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="Arrastre" class="mb-1">Arrastre:</label>
                        <select name="Arrastre" id="Arrastre" class="form-select mb-3">
                            <option value="" selected disabled hidden>Arrastre a utilizar:</option>
                            {{#Arrastres}}
                                <option value="{{IdArrastre}}">{{InfoArrastre}}</option>
                            {{/Arrastres}}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="Carga" class="mb-1">Carga:</label>
                        <select name="Carga" id="Carga" class="form-select mb-3">
                            <option value="" selected disabled hidden>Carga llevada:</option>
                            {{#Cargas}}
                                <option value="{{id}}">{{InfoCarga}}</option>
                            {{/Cargas}}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="Cliente" class="mb-1">Cliente:</label>
                        <select name="Cliente" id="Cliente" class="form-select mb-3">
                            <option value="" selected disabled hidden>Cliente Contratante:</option>
                            {{#Clientes}}
                                <option value="{{IdCliente}}">{{InfoCliente}}</option>
                            {{/Clientes}}
                        </select>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between m-1">
                        <a href="/" class="mr-auto btn btn-primary">Volver</a>
                        <button type="submit" class="btn btn-primary">Cargar</button>
                    </div>
                </form>
            </div>
        {{/formNuevaProforma}}



        {{#formActProforma}}
        <div class="col">
            <form action="proformas/modificar" method="POST" class="row m-5" id="formProforma">
                {{> alerta}}
                <h2 class="col-12">Presupuesto</h2>
                <hr class="col-12">

                <div class="form-group col-12 col-md-4">
                    <label for="Peaje" class="mb-1">Estimado Peaje:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">U$D</span>
                        <input type="number" class="form-control" id="Peaje" name="Peaje" value="{{Peaje}}">
                    </div>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label for="Viaticos" class="mb-1">Estimado Viaticos:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">U$D</span>
                        <input type="number" class="form-control" id="Viaticos" name="Viaticos" value="{{Viaticos}}">
                    </div>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label for="Hospedaje" class="mb-1">Estimado Hospedaje:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">U$D</span>
                        <input type="number" class="form-control" id="Hospedaje" name="Hospedaje" value="{{Hospedaje}}">
                    </div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Extras" class="mb-1">Estimado Extras:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">U$D</span>
                        <input type="number" class="form-control" id="Extras" name="Extras" value="{{Extras}}">
                    </div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Tarifa" class="mb-1">Tarifa:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">U$D</span>
                        <input type="number" class="form-control" id="Tarifa" name="Tarifa" value="{{Tarifa}}">
                    </div>
                </div>

                <hr class="col-12">
                <h2 class="col-12">Viaje</h2>
                <hr class="col-12">

                <div class="form-group col-12 col-md-6">
                    <label for="Origen" class="mb-1">Origen:</label>
                    <input type="text" class="form-control mb-3" id="Origen" name="Origen" value="{{Origen}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Destino" class="mb-1">Destino:</label>
                    <input type="text" class="form-control mb-3" id="Destino" name="Destino" value="{{Destino}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="ETD" class="mb-1">ETD:</label>
                    <input type="date" class="form-control mb-3" id="ETD" name="ETD" value="{{ETD}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="ETA" class="mb-1">ETA:</label>
                    <input type="date" class="form-control mb-3" id="ETA" name="ETA" value="{{ETA}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Kilometros" class="mb-1">Kilometros Estimados:</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="Kilometros" name="Kilometros" value={{Kilometros}}>
                        <span class="input-group-text">Km.</span>
                    </div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Combustible" class="mb-1">Combustible Estimados:</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="Combustible" name="Combustible" value={{Combustible}}>
                        <span class="input-group-text">Lts.</span>
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="Chofer" class="mb-1">Chofer:</label>
                    <select name="Chofer" id="Chofer" class="form-select mb-3">
                        <option value="" selected disabled hidden>Chofer Responsable:</option>
                        {{#IdChofer}}
                            <option value="{{IdChofer}}" selected>{{Chofer}} (DNI: {{DNI}})</option>
                        {{/IdChofer}}
                        {{#Choferes}}
                            <option value="{{IdChofer}}">{{InfoChofer}}</option>
                        {{/Choferes}}
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Tractor" class="mb-1">Tractor:</label>
                    <select name="Tractor" id="Tractor" class="form-select mb-3">
                        <option value="" selected disabled hidden>Tractor a utilizar:</option>
                        {{#IdTractor}}
                            <option value="{{IdTractor}}" selected>{{TMarca}} - {{TModelo}} - {{TPatente}}</option>
                        {{/IdTractor}}
                        {{#Tractores}}
                            <option value="{{IdTractor}}">{{InfoTractor}}</option>
                        {{/Tractores}}
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Arrastre" class="mb-1">Arrastre:</label>
                    <select name="Arrastre" id="Arrastre" class="form-select mb-3">
                        <option value="" selected disabled hidden>Arrastre a utilizar:</option>
                        {{#IdArrastre}}
                            <option value="{{IdArrastre}}" selected>{{AMarca}} - {{AModelo}} - {{APatente}}</option>
                        {{/IdArrastre}}
                        {{#Arrastres}}
                            <option value="{{IdArrastre}}">{{InfoArrastre}}</option>
                        {{/Arrastres}}
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="Carga" class="mb-1">Carga:</label>
                    <select name="Carga" id="Carga" class="form-select mb-3">
                        <option value="" selected disabled hidden>Carga llevada:</option>
                        {{#IdCarga}}
                            <option value="{{IdCarga}}" selected>{{IdCarga}}: {{Peso}}Kg - {{DescripcionCarga}}</option>
                        {{/IdCarga}}
                        {{#Cargas}}
                            <option value="{{id}}">{{InfoCarga}}</option>
                        {{/Cargas}}
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="Cliente" class="mb-1">Cliente:</label>
                    <select name="Cliente" id="Cliente" class="form-select mb-3">
                        <option value="" selected disabled hidden>Cliente Contratante:</option>
                        {{#IdCliente}}
                            <option value="{{IdCliente}}" selected hidden>{{RazonSocial}} (CUIT: {{CUIT}})</option>
                        {{/IdCliente}}
                        {{#Clientes}}
                            <option value="{{IdCliente}}">{{InfoCliente}}</option>
                        {{/Clientes}}
                    </select>
                </div>


                <div class="d-flex flex-wrap justify-content-between m-1">
                    <a href="/" class="mr-auto btn btn-primary">Volver</a>
                    <button type="submit" name='Proforma' value={{Proforma}} class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
        {{/formActProforma}}
    </div>
</main>

{{> footer}}