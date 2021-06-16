{{> head}}
{{> header}}

        <form action="register/registerEmployee
        index.php?module=register&action=registerEmployee" method="POST"  >
            <input type="number" name="dni">
            <input type="date" name="fecha_nacimiento">
            <input type="text" name="nombre">
            <input type="text" name="apellido">
            <input type="text" name="email">
            <input type="text" name="clave">
            <button>Registrarse</button>
        </form>

{{> footer}}
