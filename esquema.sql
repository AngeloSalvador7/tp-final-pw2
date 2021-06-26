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
    id_rol int,
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
	id int auto_increment not null,
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

CREATE VIEW ProformaResumen
AS
SELECT 
	PRE.id AS 'Proforma',
    VJ.etd AS  'ETD',
    VJ.eta AS 'ETA',
    VJ.estado AS 'Estado',
    CL.razon_social AS 'Cliente',
    concat(EMP.apellido, ', ', EMP.nombre) AS 'Chofer',
    PRE.costo_peaje_estimado + PRE.costo_viaticos_estimado + PRE.costo_hospedaje_estimado + PRE.extra_estimado AS 'Costo'
FROM 
	presupuesto PRE 
		JOIN viaje VJ ON PRE.id_viaje = VJ.id
        JOIN cliente CL ON VJ.id_cliente = CL.id
        JOIN chofer CH ON VJ.id_chofer = CH.id_empleado
        JOIN empleado EMP ON CH.id_empleado = EMP.id;


CREATE VIEW ProformaCompleta
AS
SELECT 
	PRE.id AS 'Proforma',
    PRE.costo_peaje_estimado AS 'Peaje',
    PRE.costo_viaticos_estimado AS 'Viaticos',
    PRE.costo_hospedaje_estimado AS 'Hospedaje',
    PRE.extra_estimado AS 'Extras',
    PRE.costo_peaje_estimado + PRE.costo_viaticos_estimado + PRE.costo_hospedaje_estimado + PRE.extra_estimado AS 'Costo',
    VJ.origen AS 'Origen',
    VJ.destino AS 'Destino',
    VJ.etd AS  'ETD',
    VJ.eta AS 'ETA',
    VJ.estado AS 'Estado',
    VJ.km_estimado AS 'Kilometros',
    VJ.combustible_estimado AS 'Combustible',
    CL.denominacion AS 'Denominacion',
    CL.razon_social AS 'RazonSocial',
    CL.cuit AS 'CUIT',
    CL.direccion AS 'Direccion',
    CL.telefono AS 'Telefono',
    CL.email AS 'EmailCliente',
    concat(EMP.apellido, ', ', EMP.nombre) AS 'Chofer',
    EMP.dni AS 'DNI',
    EMP.email AS 'EmailChofer',
    CH.numero_licencia AS 'NumeroLicencia',
    TR.marca AS 'TMarca',
    TR.patente AS 'TPatente',
    TR.modelo AS 'TModelo',
    ARR.marca AS 'AMarca',
    ARR.patente AS 'APatente',
    ARR.modelo AS 'AModelo',
    CRG.peso_neto AS 'Peso',
    CRG.hazard AS 'Hazard',
    CRG.imo_class AS 'IMOClass',
    CRG.imo_sclass AS 'IMOSClass',
    CRG.reefer AS 'Reefer',
    concat(CRG.temperatura, '°C') AS 'Temperatura',
    TARR.descripcion AS 'TipoCarga'
FROM 
	presupuesto PRE 
		JOIN viaje VJ ON PRE.id_viaje = VJ.id
        JOIN cliente CL ON VJ.id_cliente = CL.id
        JOIN vehiculo TR ON VJ.id_tractor = TR.id
        JOIN vehiculo ARR ON VJ.id_arrastre = ARR.id
        JOIN carga CRG ON VJ.id_carga = CRG.id
        JOIN tipo_arrastre TARR ON CRG.id_tipo = TARR.id 
        JOIN chofer CH ON VJ.id_chofer = CH.id_empleado
        JOIN empleado EMP ON CH.id_empleado = EMP.id;
    