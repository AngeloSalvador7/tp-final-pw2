{{> head}}
{{> headerLogueado}}

{{> navSupervisor}}

{{#vistaVehiculos}}
    {{>vehiculos}}
{{/vistaVehiculos}}

{{#vistaAgregarVehiculo}}
    {{>agregarVehiculo}}
{{/vistaAgregarVehiculo}}

{{#vistaModificarVehiculo}}
    {{>editarVehiculo}}
{{/vistaModificarVehiculo}}

{{#vistaModificacionDeVehiculo}}
    {{>modificarVehiculo}}
{{/vistaModificacionDeVehiculo}}

{{> footer}}