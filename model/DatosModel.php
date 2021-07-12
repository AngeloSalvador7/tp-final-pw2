<?php
class DatosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getVehiculos()
    {
        return $this->database->query("SELECT * FROM vehiculo");
    }

    public function getVehiculoById($id)
    {
        return $this->database->query("SELECT * FROM vehiculo WHERE id=$id");
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
                AND VJ.estado NOT IN ('Pendiente', 'En Curso', 'Cancelado')
        GROUP BY
            YEAR(VJ.fecha_carga), MONTH(VJ.fecha_carga)"
        );
    }

    public function rendVehiculoKm($id)
    {
        $resParcial = $this->database->query(
            "SELECT
            SV.fecha,
            SUM(VJ.km_real) AS 'kilometros',
            SUM(VJ.combustible_real) AS 'combustible',
            COUNT(*) AS 'viajes'
        FROM
            viaje VJ
                JOIN vehiculo VH ON VJ.id_arrastre = VH.id OR VJ.id_tractor = VH.id
                JOIN service SV ON VH.id = SV.id_vechiculo
        WHERE
            SV.fecha >= VJ.fecha_llegada
                AND VH.id = $id
        GROUP BY
            SV.fecha"
        );

        $resFinal = [];

        foreach ($resParcial as $numFila => $fila) {
            if ($numFila == 0) {
                $resFinal[$numFila]['promedioKm'] = $fila['kilometros'] / $fila['viajes'];
                $resFinal[$numFila]['promedioCombustible'] = $fila['combustible'] / $fila['viajes'];
            } else {
                $resFinal[$numFila]['promedioKm'] =
                    ($fila['kilometros'] - $resParcial[$numFila - 1]['kilometros']) /
                    ($fila['viajes'] - $resParcial[$numFila - 1]['viajes']);

                $resFinal[$numFila]['promedioCombustible'] =
                    ($fila['combustible'] - $resParcial[$numFila - 1]['combustible']) /
                    ($fila['viajes'] - $resParcial[$numFila - 1]['viajes']);
            }

            $resFinal[$numFila]['fecha'] = $fila['fecha'];
        }

        return $resFinal;
    }
}
