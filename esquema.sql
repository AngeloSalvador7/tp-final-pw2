drop database if exists transporte;
create database if not exists transporte;
use transporte;
create table rol(
	id int auto_increment,
    descripcion varchar(50) not null,
    primary key (id)
);

create table empleado(
	id int auto_increment,
    dni int not null unique,
    fecha_nacimiento date not null,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    email varchar(50) not null unique,
    clave varchar(50) not null,
    id_rol int not null,
    primary key (id),
    foreign key(id_rol) references rol(id)
);

create table chofer(
	id_empleado int not null,
    numero_licencia int not null,
    primary key (id_empleado),
    foreign key(id_empleado) references empleado(id)
);

create table tipo_arrastre(
	id int auto_increment,
    descripcion varchar(50) not null,
    primary key (id)
);

create table vehiculo(
	id int not null,
	marca varchar(50) not null,
    modelo varchar(50) not null,
    patente varchar(50) not null unique,
    motor varchar(50) not null,
    chasis varchar(50) not null,
    km_recorrido int not null,
    id_tipo int,
    foreign key(id_tipo) references tipo_arrastre(id),
    primary key (id)
);

create table carga(
	id int not null,
    peso_neto int not null,
    hazard bit(1) not null,
    imo_class int null,
    imo_sclass int null,
    reefer bit(1) not null,
    temperatura int not null,
	id_tipo int not null,
    primary key (id),
	foreign key(id_tipo) references tipo_arrastre(id)
);

create table cliente(
	id int auto_increment not null,
    denominacion varchar(50) not null,
    cuit int not null,
    direccion varchar(50) null,
    telefono varchar(50) null,
    email varchar(50) null,
    contacto_1 varchar(50) null,
    contacto_2 varchar(50) null,
    primary key (id)
);

create table viaje(
id int auto_increment not null,
origen varchar(50) not null,
destino varchar(50) not null,
fecha_carga date not null,
eta date not null,
etd date not null,
fecha_llegada date not null,
estado varchar(50) not null,
km_estimado int not null,
km_real int not null,
combustible_estimado int not null,
combustible_real int not null,
id_chofer int not null,
id_tractor int not null,
id_arrastre int not null,
id_carga int not null,
id_cliente int not null,
foreign key(id_chofer) references chofer(id_empleado),
foreign key(id_tractor) references vehiculo(id),
foreign key(id_arrastre) references vehiculo(id),
foreign key(id_carga) references carga(id),
foreign key(id_cliente) references cliente(id),
primary key (id)
);

create table factura(
id  int auto_increment not null,
id_viaje int not null,
costo_peaje double not null,
costo_viaticos double not null,
costo_hospedaje double not null,
extra double not null,
foreign key(id_viaje) references viaje(id),
primary key (id)
);

create table presupuesto(
id  int auto_increment not null,
id_viaje int not null,
costo_peaje_estimado double not null,
costo_viaticos_estimado double not null,
costo_hospedaje_estimado double not null,
extra_estimado double not null,
foreign key(id_viaje) references viaje(id),
primary key (id)
);

create table service(
id  int auto_increment not null,
fecha date not null,
costo double not null,
is_externo bit(1) not null,
detalle text not null,
id_mecanico int,
id_vechiculo int not null,
foreign key(id_vechiculo) references vehiculo(id),
foreign key(id_mecanico) references empleado(id),
primary key (id)
);


