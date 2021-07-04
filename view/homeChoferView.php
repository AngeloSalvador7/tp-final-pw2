{{> head}}
{{> headerLogueado}}

<nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav navbar-expand-lg">
            <li class="nav-item active px-3">
                <a class="nav-link" href="home">{{nombre}}</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="">Viajes</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="">Empleados</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="">Estadisticas</a>
            </li>
        </ul>
    </div>
</nav>

<main class="container-fluid">

    <div id="main">

        <div class="window text-dark">
            <h1 class="mt-2">Chofer</h1>
            <hr/>
          
            {{#vistaActualizarDatosViaje}}
            {{>actualizarDatosProforma}}
            {{/vistaActualizarDatosViaje}}

            {{#completarLicencia}}
            {{>ingresarLicencia}}
            {{/completarLicencia}}

            {{#editarLicencia}}
            {{>editarLicencia}}
            {{/editarLicencia}}
        </div>
    </div>
  
</main>

{{> footer}}