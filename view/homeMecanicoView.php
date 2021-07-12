{{> head}}
{{> headerLogueado}}
<nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav navbar-expand-lg">
            <li class="nav-item active px-3">
                <a class="nav-link" href="home">{{nombre}}</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="home">Home</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="mecanico/service">Service</a>
            </li>
        </ul>
    </div>
</nav>

{{#vistaAccionesService}}
    {{>acionesService}}
{{/vistaAccionesService}}

{{#vistaAgregarService}}
    {{>agregarService}}
{{/vistaAgregarService}}

{{#vistaModificarService}}
    {{>modificarService}}
{{/vistaModificarService}}

{{> footer}}