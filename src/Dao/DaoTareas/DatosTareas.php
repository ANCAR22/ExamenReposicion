<?php

namespace Dao\DaoTareas;

use Dao\Table;

class DatosTareas extends Table
{
    public static function obtenerDatos()
    {
        $sql = "select * from DatosTareas";
        return self::obtenerRegistros($sql, []);
    }

    public static function obtenerUnDato(int $id_tarea)
    {
        $sql = "Select * from DatosTareas where id_tarea=:id_tarea";
        return self::obtenerUnRegistro($sql, ["id_tarea" => $id_tarea]);
    }

    public static function crearDatosTareas(
        string $titulo,
        string $descripcion,
        string $fecha_vencimiento,
        bool $completada
    ) {
        $sqlinsert = "insert into DatosTareas (titulo, descripcion, fecha_vencimiento, completada)
                    values (:titulo, :descripcion, :fecha_vencimiento, :completada)";

        $insertData = [
            "titulo" => $titulo,
            "descripcion" => $descripcion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "completada" => $completada
        ];

        return self::executeNonQuery($sqlinsert, $insertData);
    }

    public static function editarDatosTareas(
        int $id_tarea,
        string $titulo,
        string $descripcion,
        string $fecha_vencimiento,
        bool $completada
    ) {
        $sqlUpdate = "update DatosTareas set titulo=:titulo, descripcion=:descripcion, fecha_vencimiento=:fecha_vencimiento, completada=:completada
        where id_tarea=:id_tarea";
        $updateData = [
            "id_tarea" => $id_tarea,
            "titulo" => $titulo,
            "descripcion" => $descripcion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "completada" => $completada
        ];

        return self::executeNonQuery($sqlUpdate, $updateData);
    }

    public static function eliminarDatosTareas(int $id_tarea)
    {
        $sqlDelete = "delete from DatosTareas where id_tarea=:id_tarea";
        return self::executeNonQuery($sqlDelete, ["id_tarea" => $id_tarea]);
    }
}
