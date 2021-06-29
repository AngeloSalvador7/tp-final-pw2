use transporte;

INSERT INTO rol(descripcion) VALUES ("ADMINISTRADOR"),("CHOFER"), ("SUPERVISOR"), ("MECANICO");

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (33023745, "1987-07-15", "Pedro", "Alonso", "supervisor@gmail.com", "1234", 1);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (346023745, "1990-11-05", "Juana", "Alfonso", "alfonsoa@gmail.com", "juanita22", 3);

Insert  into tipo_arrastre(descripcion) values ('tanque'),('acoplado'),('cisterna');

INSERT INTO `transporte`.`cliente` (`id`, `denominacion`, `razon_social`, `cuit`, `direccion`, `telefono`, `email`) 
VALUES (1, 'Empresa', 'Choclos S.A', 11111, 'test', 'test', 'test');

INSERT INTO `transporte`.`chofer` (`id_empleado`, `numero_licencia`) VALUES (3, 111111);

INSERT INTO `transporte`.`vehiculo` (`id`, `marca`, `modelo`, `patente`, `motor`, `chasis`, `km_recorrido`, `id_tipo`) 
VALUES (1, 'test', 'test', 'test', 'test', 'test', 0, 1);

INSERT INTO `transporte`.`carga` (`id`, `peso_neto`, `hazard`, `imo_class`, `imo_sclass`, `reefer`, `temperatura`, `id_tipo`) 
VALUES (1, 80, 1, 1, 1, 0, 1, 2);

INSERT INTO `transporte`.`viaje` (`id`, `origen`, `destino`, `fecha_carga`, `eta`, `etd`, `fecha_llegada`, `estado`, `km_estimado`, `km_real`, `combustible_estimado`, `combustible_real`, `id_chofer`, `id_tractor`, `id_arrastre`, `id_carga`, `id_cliente`) 
VALUES (1, 'test', 'test', '19990605', '19990607', '19990605', '19990607', 'Pendiente', 0, 0, 0, 0, 3, 1, 1, 1, 1);

INSERT INTO `transporte`.`presupuesto` (`id`, `id_viaje`, `costo_peaje_estimado`, `costo_viaticos_estimado`, `costo_hospedaje_estimado`, `extra_estimado`)
VALUES (1, 1, 10000, 5000, 500, 30);

INSERT INTO empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol) 
VALUES (3398945, "1978-12-02", "Pablo", "Oliva", "olivap@gmail.com", "oliva", null);
