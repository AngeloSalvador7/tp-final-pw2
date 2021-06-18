use transporte;

INSERT INTO rol(descripcion) VALUES ("ADMINISTRADOR"),("CHOFER"), ("SUPERVISOR"), ("MECANICO");

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (33023745, "1987-07-15", "Pedro", "Alonso", "alonsop@gmail.com", "pokemon123", 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (346023745, "1990-11-05", "Juana", "Alfonso", "alfonsoa@gmail.com", "juanita22", 3);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (3798945, "1988-10-25", "Franco", "Davila", "davilaf@gmail.com", "franquito", null);