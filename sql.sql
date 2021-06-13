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

create table tractor(
	id int not null,
	marca varchar(50) not null,
    modelo varchar(50) not null,
    patente varchar(50) not null unique,
    motor varchar(50) not null,
    chasis varchar(50) not null,
    primary key (id)
);

create table tipo_arrastre(
	id int auto_increment,
    descripcion varchar(50) not null,
    primary key (id)
);

create table arrastre(
	id int not null,
	id_tipo int not null,
    patente varchar(50) not null unique,
    chasis varchar(50) not null,
    primary key (id),
	foreign key(id_tipo) references tipo_arrastre(id)
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








