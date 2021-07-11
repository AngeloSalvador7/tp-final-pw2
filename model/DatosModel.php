<?php
class DatosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function numeroViajesPorEstado()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad, estado FROM viaje GROUP BY estado");
    }

    public function promedioGanancias($year)
    {
        return $this->database->query(
        "SELECT 
            SUM(
                PRE.costo_peaje_estimado + PRE.costo_viaticos_estimado + PRE.costo_hospedaje_estimado + PRE.extra_estimado  + PRE.tarifa
            ) AS 'ingresos',
            SUM(
                FC.costo_peaje + FC.costo_viaticos + FC.costo_hospedaje + FC.extra
            ) AS 'gastos',
            SUM(
                (PRE.costo_peaje_estimado + PRE.costo_viaticos_estimado + PRE.costo_hospedaje_estimado + PRE.extra_estimado  + PRE.tarifa) 
                -
                (FC.costo_peaje + FC.costo_viaticos + FC.costo_hospedaje + FC.extra)
            ) AS 'ganancias',
            MONTH(VJ.fecha_carga) AS 'mes'
        FROM 
            presupuesto PRE
                JOIN viaje VJ ON PRE.id_viaje = VJ.id
                JOIN factura FC ON FC.id_viaje = VJ.id
        WHERE
            VJ.fecha_carga IS NOT NULL
                AND YEAR(VJ.fecha_carga) = $year
        GROUP BY
            YEAR(VJ.fecha_carga), MONTH(VJ.fecha_carga)"
        );
    }
}
