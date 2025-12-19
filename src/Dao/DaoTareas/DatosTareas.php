<?php

namespace Dao\DaoTareas;

use Dao\Table;

class DatosTareas extends Table
{
    public static function obtenerDatos()
    {
        $sql = "SELECT * FROM tareas";
        return self::obtenerRegistros($sql, []);
    }

    public static function obtenerUnDato(int $tarea_id)
    {
        $sql = "SELECT * FROM tareas WHERE tarea_id = :tarea_id";
        return self::obtenerUnRegistro($sql, ["tarea_id" => $tarea_id]);
    }

    public static function crearDatosTareas(
        string $titulo,
        string $descripcion,
        string $prioridad,
        bool $completada
    ) {
        $sqlInsert = "INSERT INTO tareas (titulo, descripcion, prioridad, completada)
                      VALUES (:titulo, :descripcion, :prioridad, :completada)";
        $insertData = [
            "titulo" => $titulo,
            "descripcion" => $descripcion,
            "prioridad" => $prioridad,
            "completada" => $completada
        ];
        return self::executeNonQuery($sqlInsert, $insertData);
    }

    public static function editarDatosTareas(
        int $tarea_id,
        string $titulo,
        string $descripcion,
        string $prioridad,
        bool $completada
    ) {
        $sqlUpdate = "UPDATE tareas
                      SET titulo=:titulo, descripcion=:descripcion, prioridad=:prioridad, completada=:completada
                      WHERE tarea_id=:tarea_id";
        $updateData = [
            "tarea_id" => $tarea_id,
            "titulo" => $titulo,
            "descripcion" => $descripcion,
            "prioridad" => $prioridad,
            "completada" => $completada
        ];
        return self::executeNonQuery($sqlUpdate, $updateData);
    }

    public static function eliminarDatosTareas(int $tarea_id)
    {
        $sqlDelete = "DELETE FROM tareas WHERE tarea_id=:tarea_id";
        return self::executeNonQuery($sqlDelete, ["tarea_id" => $tarea_id]);
    }
}
