{{> header}}

        <form action="register/registerEmployee" method="POST">
            <input type="number" name="dni">
            <input type="text" name="fecha_nacimiento">
            <input type="text" name="nombre">
            <input type="text" name="apellido">
            <input type="text" name="email">
            <input type="text" name="clave">
            <button>Registrarse</button>
        </form>

{{> footer}}
