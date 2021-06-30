use transporte;

INSERT INTO rol(descripcion) VALUES ("ADMINISTRADOR"),("CHOFER"), ("SUPERVISOR"), ("MECANICO");

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente) 
VALUES (33023745, "1987-07-15", "Pedro", "Alonso", "supervisor@gmail.com", "1234", 1, 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente) 
VALUES (346023745, "1990-11-05", "Juana", "Alfonso", "alfonsoa@gmail.com", "juanita22", 3, 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente) 
VALUES (3798945, "1988-10-25", "Franco", "Davila", "davilaf@gmail.com", "franquito", 2, 1);

Insert  into tipo_arrastre(descripcion) values ('tanque'),('acoplado'),('cisterna');

INSERT INTO `transporte`.`chofer` (`id_empleado`, `numero_licencia`) VALUES (3, 111111);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (3398945, "1978-12-02", "Pablo", "Oliva", "olivap@gmail.com", "oliva", null);
