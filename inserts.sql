use transporte;

INSERT INTO rol(descripcion) VALUES ("ADMINISTRADOR"),("CHOFER"), ("SUPERVISOR"), ("MECANICO");

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente)
VALUES (33023745, "1987-07-15", "Pedro", "Alonso", "admin@gmail.com", "1234", 1, 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente)
VALUES (346023745, "1990-11-05", "Juana", "Alfonso", "chofer@gmail.com", "1234", 2, 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente)
VALUES (3798942, "1988-10-25", "Franco", "Davila", "supervisor@gmail.com", "1234", 3, 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol, vigente)
VALUES (3398945, "1978-12-02", "Pablo", "Oliva", "mecanico@gmail.com", "1234", 4, 1);


Insert  into tipo_arrastre(descripcion) values ('Tanque'),('Acoplado'),('Cisterna'),('Araña'),('Jaula'),('Granel'),('CarCarrier');