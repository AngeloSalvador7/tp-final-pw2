USE transporte;
insert into rol(descripcion)
values ('admin'),
       ('supervisor'),
       ('chofer'),
       ('mecanico');
insert into empleado(dni, fecha_nacimiento, nombre, apellido, email, clave, id_rol)
values (1111, 20201010, 'admin', 'admin', 'admin@gmail.com', 1234, 1),
       (2222, 20201010, 'supervisor', 'supervisor', 'supervisor@gmail.com', 1234, 2),
       (3333, 20201010, 'chofer', 'chofer', 'chofer@gmail.com', 1234, 3),
       (4444, 20201010, 'mecanico', 'mecanico', 'mecanico@gmail.com', 1234, 4),
       (5555, 20201010, 'sinrol', 'sinrol', 'sinrol@gmail.com', 1234, null);