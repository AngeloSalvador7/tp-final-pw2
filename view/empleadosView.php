    {{> head}}
	{{> headerLogueado}}

	<nav class="navbar navbar-dark navbar-expand-lg">
		<div class="container-fluid">
			<ul class="navbar-nav navbar-expand-lg">
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
				<h1 class="mt-2">Empleados</h1>
				<hr />
				<table class="table">
					<thead>
						<tr>
							<th scope="col">DNI</th>
							<th scope="col">Fecha Nacimiento</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                        </tr>
					</thead>
					<tbody>
                    {{#empleados}}
						<tr>
							<td>{{dni}}</td>
							<td>{{fecha_nacimiento}}</td>
							<td>{{nombre}}</td>
                            <td>{{apellido}}</td>
                            <td>{{email}}</td>
                            <td>{{descripcion}}
                            <form name="form" method="post" action="empleados/asignarRol">

                                <select name="rol" id="lista">
                                    <option value="" selected disabled hidden>Elija Rol</option>
                                    {{#roles}}
                                    	<option value="{{rol}}">{{descripcion}}</option>
                                    {{/roles}}
                                </select>

                                <button class="btn btn-outline-danger m-1" type="submit" name="empleado" value="{{id}}">Guardar</button>
                            </form>
                            </td>
                        </tr>
                    {{/empleados}}
					</tbody>
				</table>
                <h3>{{mensaje}}</h3>
			</div>

		</div>

	</main>
    {{> footer}}
