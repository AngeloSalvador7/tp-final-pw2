<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
	<script src="public/js/bootstrap.min.js"></script>

	<title>Transporte UNLAM - Home</title>
</head>

<body>
	
	<header class="container-fluid bg-dark text-warning pt-3">
		<div class="row">
			<div class="col-5 text-left mb-2">
				<a><img src="../images/bandmember.png" width="90px" height="90px"></a>
			</div>
			<div class="col-7 d-flex flex-wrap justify-content-end align-items-center my-2">
				<div class="btn-group-lg">
					<a href="#"><button class="btn btn-outline-warning m-1">
							Iniciar Sesion
						</button></a>
					<a href="#">
						<button class="btn btn-outline-warning m-1">Registrar</button></a>
				</div>
			</div>
		</div>
	</header>

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

	<footer>
		<div class="container bottom_border">
			<div class="row">
				<div class="col-sm-4 col-md col-sm-4 col-12 col">
					<h5 class="headin5_amrc col_white_amrc pt2">Acerca de</h5>
					<p class="mb10">
						Proyecto desarrollado en PHP, para la materia Programación Web 2
						de la Universidad Nacional de La Matanza
					</p>
					<p><i class="fa fa-location-arrow"></i>Trabajo Remoto</p>
					<p><i class="fa fa-phone"></i> +91-9999878398</p>
					<p>
						<i class="fas fa-envelope-square"></i>TransporteUnlam@outlook.com
					</p>
				</div>

				<div class="col-sm-4 col-md col-6 col">
					<h5 class="headin5_amrc col_white_amrc pt2">Integrantes</h5>
					<ul class="footer_ul_amrc">
						<li>
							<p>Gonzalo Elias Fernandez</p>
						</li>
						<li>
							<p>Marcelo Andres Zelaya</p>
						</li>
						<li>
							<p>Angelo Salvador Ordoñez Garcia</p>
						</li>
						<li>
							<p>Sebastian Trillo Da Silva</p>
						</li>
						<li>
							<p>Agustina Luciana Gimenez</p>
						</li>
					</ul>
				</div>

				<div class="col-sm-4 col-md col-6 col">
					<h5 class="headin5_amrc col_white_amrc pt2">Docentes</h5>
					<ul class="footer_ul_amrc">
						<li>
							<p>D`Aranno Facundo Nahuel</p>
						</li>
						<li>
							<p>Sosa, Omar</p>
						</li>
						<li>
							<p>Rusticcini Alejandro</p>
						</li>
					</ul>
				</div>

				<div class="col-sm-4 col-md col-12 col">
					<h5 class="headin5_amrc col_white_amrc pt2">Repositorios</h5>
					<div class="contenedorDeAmbos align-items-center">
						<ul class="footer_ul2_amrc">
							<li>
								<i class="github fab fa-github fa-3x"></i>
								<a href="https://github.com/" class="link-ligth" target="_blank ">Transporte UNLAM.</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<p class="text-center">
			Copyright @2021 | Designed With by Transporte UNLAM.
		</p>

		<ul class="social_footer_ul">
			<li>
				<a target="_blank " href="https://es-la.facebook.com/ "><i class="fab fa-facebook-f"></i></a>
			</li>
			<li>
				<a target="_blank " href="https://www.instagram.com/?hl=es-la "><i class="fab fa-instagram"></i></a>
			</li>
			<li>
				<a target="_blank " href="https://twitter.com/?lang=es "><i class="fab fa-twitter"></i></a>
			</li>
			<li>
				<a target="_blank " href="https://linkedIn.com "><i class="fab fa-linkedin"></i></a>
			</li>
		</ul>
	</footer>
</body>

</html>