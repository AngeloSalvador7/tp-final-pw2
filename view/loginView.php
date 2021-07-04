{{> head}}
{{> header}}
<main class="container-fluid">
	<div class="portada text-white row align-items-center">
		<div class="ps-5 col-12 col-sm-6">
			<h1>Transporte UNLAM</h1>
			<h3>Transporte y distribución hecho simple</h3>
		</div>
		<div class="col-12 col-sm-5">
			<form action="login/validateEmployee" method="POST" class="text-white mx-5 mb-2" id="login">
				<div class="form-group">
					<label for="nombre">Email:</label>
					<input type="email" class="form-control" id="email" name="email" required />
				</div>
				<div class="form-group">
					<label for="numero">Contraseña:</label>
					<input type="password" class="form-control" id="clave" name="clave" required />
				</div>
				<button type="submit" class="btn btn-primary mt-3">
					Iniciar sesión
				</button>
			</form>
		</div>
		<div class="mx-5 col-11">
			{{> alerta}}
		</div>
	</div>
</main>

{{> footer}}