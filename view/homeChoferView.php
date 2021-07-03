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

    <div id="main" class="row text-white">


        <div class="info col-12 col-sm-2 bg-dark p-0">

            <div class="mt-3 me-3 text-white text-end">
                <button class="btn btn-outline-gray rounded"></button>
            </div>

            <div class="text-center text-white mb-5">
                <h3 class="mb-3"></h3>
            </div>

        </div>

        <div class="window col-12 col-sm-9 text-dark">
            <h1 class="mt-2">Chofer</h1>
            <hr/>

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