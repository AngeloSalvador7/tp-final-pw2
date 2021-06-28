    {{> head}}
	{{> headerLogueado}}

	<nav class="navbar navbar-dark navbar-expand-lg">
		<div class="container-fluid">
			<ul class="navbar-nav navbar-expand-lg">
				<li class="nav-item active px-3">
					<a class="nav-link" href="home">Flota</a>
				</li>
				<li class="nav-item px-3">
					<a class="nav-link" href="home">Viajes</a>
				</li>
				<li class="nav-item px-3">
					<a class="nav-link" href="empleados">Empleados</a>
				</li>
				<li class="nav-item px-3">
					<a class="nav-link" href="home">Estadisticas</a>
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

				<ul class="opciones">
					<li><a class="text-white" href="empleados">Empleados</a></li>
					<li><a class="text-white" href="empleados/nuevosEmpleados">Nuevos empleados</a></li>
				</ul>

			</div>

			<div class="window col-12 col-sm-9 text-dark">
				<h1 class="mt-2">Editar empleados</h1>
				<hr />
                {{#empleado}}
                <div class="container">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <form action="empleados/guardarCambios" method="POST" >
                                    <div class="form-group">
                                        <label class="control-label" for="dni">Numero de documento</label>
                                        <input id="dni" type="number" name="dni" class="form-control" value="{{dni}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                                        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="form-control" value="{{fecha_nacimiento}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="signupName">Nombre</label>
                                        <input id="signupName" type="text"  class="form-control" name="nombre" value="{{nombre}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="signupSurname">Apellido</label>
                                        <input id="signupSurname" type="text"  class="form-control" name="apellido" value="{{apellido}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="">Rol</label><br>
                                        <select class="form-select" name="rol" id="lista">
                                            <option value="{{id_tipo}}" selected hidden>{{descripcion}}</option>
                                            {{#roles}}
                                            <option value="{{rol}}">{{descripcion}}</option>
                                            {{/roles}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="signupEmail">Email</label>
                                        <input id="signupEmail" type="text"  class="form-control" name="email" value="{{email}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="signupPassword">Clave</label>
                                        <input id="signupPassword" type="text"  class="form-control" name="clave" value="{{clave}}">
                                    </div>
                                    <div class="form-group">
                                        <button name="id_empleado" value="{{id}}" class="btn btn-info btn-block mt-4 mb-4">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    {{/empleado}}

                <h3>{{mensaje}}</h3>
			</div>

		</div>

	</main>
    {{> footer}}
