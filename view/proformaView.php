{{> head}}
{{> headerLogueado}}

<nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav navbar-expand-lg">
            <li class="nav-item px-3">
                <a class="nav-link" href="proformas">Proformas</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="cargas">Cargas</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="clientes">Clientes</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="vehiculos">Vehiculos</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Estadisticas</a>
            </li>
        </ul>
    </div>
</nav>

<main>
    <div id="main">

        {{> proformasPartial}}

    </div>
</main>

{{> footer}}