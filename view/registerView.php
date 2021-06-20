{{> head}}
{{> header}}
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form action="register/registerEmployee" method="POST" >
                    <div class="form-group">
                        <h2 class="mt-3">Create account</h2>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="dni">Numero de documento</label>
                        <input id="dni" type="number" name="dni" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupName">Nombre</label>
                        <input id="signupName" type="text"  class="form-control" name="nombre">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupSurname">Apellido</label>
                        <input id="signupSurname" type="text"  class="form-control" name="apellido">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupEmail">Email</label>
                        <input id="signupEmail" type="text"  class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupPassword">Clave</label>
                        <input id="signupPassword" type="text"  class="form-control" name="clave">
                    </div>
                    <div class="form-group">
                        <button  class="btn btn-info btn-block mt-4 mb-4">Create your account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{> footer}}
