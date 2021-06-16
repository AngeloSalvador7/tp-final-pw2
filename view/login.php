
{{> header}}

	<header class="container-fluid bg-dark text-warning pt-3">
		<div class="row">
			<div class="col-5 text-left mb-2">
				<a><img src="public/images/bandmember.png" width="90px" height="90px" alt="Logo"></a>
			</div>
			<div class="col-7 d-flex flex-wrap justify-content-end align-items-center my-2">
				<div class="btn-group-lg">
					<a href="#"><button class="btn btn-outline-warning m-1"> Iniciar Sesion </button></a>
					<a href="#"><button class="btn btn-outline-warning m-1"> Registrar </button></a>
				</div>
			</div>
		</div>
	</header>

	<main class="container-fluid">
		<div class="portada text-white row align-items-center">
			<div class="ps-5 col-12 col-sm-6">
				<h1>Transporte UNLAM</h1>
				<h3>Transporte y distribución hecho simple</h3>
			</div>

			<div class="col-12 col-sm-5">
				<form action="#" method="POST" class="text-white mx-5 mb-2" id="demo">
					<div class="form-group">
						<label for="nombre">Email:</label>
						<input type="email" class="form-control" id="nombre" name="nombre" required />
					</div>
					<div class="form-group">
						<label for="numero">Contraseña:</label>
						<input type="password" class="form-control" id="numero" name="numero" required />
					</div>
					<button type="submit" class="btn btn-primary mt-3">
						Iniciar sesión
					</button>
				</form>
			</div>
		</div>
	</main>

{{> footer}}