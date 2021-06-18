    {{> header}}

	<nav class="navbar navbar-dark navbar-expand-lg">
		<div class="container-fluid">
			<ul class="navbar-nav navbar-expand-lg">
				<li class="nav-item active px-3">
					<a class="nav-link" href="#">Flota</a>
				</li>
				<li class="nav-item px-3">
					<a class="nav-link" href="#">Viajes</a>
				</li>
				<li class="nav-item px-3">
					<a class="nav-link" href="#">Empleados</a>
				</li>
				<li class="nav-item px-3">
					<a class="nav-link" href="#">Estadisticas</a>
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
					<li><a class="text-white" href="perfil">Calendario service</a></li>
					<li><a class="text-white" href="perfil/ir-a-mis-grupos">Camiones</a></li>
					<li><a class="text-white" href="perfil/notificaciones">Choferes</a></li>
				</ul>

			</div>

			<div class="window col-12 col-sm-9 text-dark">
				<h1 class="mt-2">Camiones</h1>
				<hr />
				<table class="table">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Marca</th>
							<th scope="col">Modelo</th>
							<th scope="col">Patente</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>IVECO</td>
							<td>Cursor</td>
							<td>AA123CD</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>IVECO</td>
							<td>Cursor</td>
							<td>BD111A</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>SCANIA</td>
							<td>G320</td>
							<td>AD144CU</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>

	</main>
    {{> footer}}
