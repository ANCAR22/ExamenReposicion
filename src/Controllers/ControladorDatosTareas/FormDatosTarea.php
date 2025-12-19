<?php

namespace Controllers\ControladorDatosTareas;

use Utilities\Validators;
use Exception;
use Utilities\Site;
use Views\Renderer;
use Dao\DaoTareas\DatosTareas as dt;
use Controllers\PublicController;

const listaDatos = "index.php?page=ControladorDatosTareas-DatosTareas";
const formDatos = "VistaDatosTareas/FormDatosTarea";

class FormDatosTarea extends PublicController
{
    private $modes = [
        "INS" => "Nueva Tarea",
        "UPD" => "Editando Tarea %s",
        "DSP" => "Detalles de Tarea %s",
        "DEL" => "Eliminando Tarea %s",
    ];

    private string $validationToken = '';
    private string $mode = '';
    private array $errores = [];

    private int $tarea_id = 0;
    private string $titulo = "";
    private string $descripcion = "";
    private string $prioridad = "";
    private bool $completada = false;

    private function generarTokenDeValidacion()
    {
        $this->validationToken = md5(gettimeofday(true) . $this->name . rand(1000, 9999));
        $_SESSION[$this->name . "_token"] = $this->validationToken;
    }

    public function run(): void
    {
        try {
            $this->page_init();
            if ($this->isPostBack()) {
                $this->errores = $this->validarPostData();
                if (count($this->errores) === 0) {
                    try {
                        switch ($this->mode) {
                            case "INS":
                                $affectedRows = dt::crearDatosTareas(
                                    $this->titulo,
                                    $this->descripcion,
                                    $this->prioridad,
                                    $this->completada
                                );
                                if ($affectedRows > 0) {
                                    Site::redirectToWithMsg(listaDatos, "✅ Nueva tarea creada satisfactoriamente");
                                }
                                break;
                            case "UPD":
                                $affectedRows = dt::editarDatosTareas(
                                    $this->tarea_id,
                                    $this->titulo,
                                    $this->descripcion,
                                    $this->prioridad,
                                    $this->completada
                                );
                                if ($affectedRows > 0) {
                                    Site::redirectToWithMsg(listaDatos, "✅ Tarea actualizada satisfactoriamente");
                                }
                                break;
                            case "DEL":
                                $affectedRows = dt::eliminarDatosTareas($this->tarea_id);
                                if ($affectedRows > 0) {
                                    Site::redirectToWithMsg(listaDatos, "✅ Tarea eliminada satisfactoriamente");
                                }
                                break;
                        }
                    } catch (Exception $err) {
                        $this->errores[] = $err->getMessage();
                    }
                }
            }
            Renderer::render(formDatos, $this->preparar_datos_vista());
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(listaDatos, "❌ Sucedió un problema al cargar. Reintente nuevamente.");
        }
    }

    private function page_init()
    {
        if (isset($_GET["mode"]) && isset($this->modes[$_GET["mode"]])) {
            $this->mode = $_GET["mode"];
            if ($this->mode !== "INS") {
                if (!isset($_GET["id_tarea"])) {
                    throw new Exception("❌ Valor de id no es válido");
                }
                $tmpId = intval($_GET["id_tarea"]);
                $tmpDatos = dt::obtenerUnDato($tmpId);
                if (count($tmpDatos) == 0) {
                    throw new Exception("❌ No se encontró registro");
                }
                $this->tarea_id = $tmpDatos["tarea_id"];
                $this->titulo = $tmpDatos["titulo"];
                $this->descripcion = $tmpDatos["descripcion"];
                $this->prioridad = $tmpDatos["prioridad"];
                $this->completada = boolval($tmpDatos["completada"]);
            }
        } else {
            throw new Exception("❌ Valor de mode no es válido");
        }
    }

    private function validarPostData(): array
    {
        $errors = [];
        $this->validationToken = $_POST["vlt"] ?? "";
        if (isset($_SESSION[$this->name . "_token"]) && $_SESSION[$this->name . "_token"] !== $this->validationToken) {
            throw new Exception('❌ Error de validación de Token');
        }

        $this->tarea_id = intval($_POST["tarea_id"] ?? 0);
        $this->titulo = $_POST["titulo"] ?? "";
        $this->descripcion = $_POST["descripcion"] ?? "";
        $this->prioridad = $_POST["prioridad"] ?? "";
        $this->completada = isset($_POST["completada"]) ? 1 : 0;

        if (Validators::IsEmpty($this->titulo)) $errors[] = "❌ Título no puede ir vacío";
        if (Validators::IsEmpty($this->descripcion)) $errors[] = "❌ Descripción no puede ir vacía";
        if (Validators::IsEmpty($this->prioridad)) $errors[] = "❌ Prioridad no puede ir vacía";

        return $errors;
    }

    private function preparar_datos_vista()
    {
        $viewData = [];
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = $this->modes[$this->mode];
        if ($this->mode !== "INS") {
            $viewData["modeDsc"] = sprintf($viewData["modeDsc"], $this->titulo);
        }

        $viewData["tarea_id"] = $this->tarea_id;
        $viewData["titulo"] = $this->titulo;
        $viewData["descripcion"] = $this->descripcion;
        $viewData["prioridad"] = $this->prioridad;
        $viewData["completada"] = $this->completada;

        $viewData["errores"] = $this->errores;
        $viewData["hasErrores"] = count($this->errores) > 0;
        $viewData["codigoReadonly"] = $this->mode !== "INS" ? "readonly" : "";
        $viewData["readonly"] = in_array($this->mode, ["DSP", "DEL"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode === "DSP";

        $this->generarTokenDeValidacion();
        $viewData["token"] = $this->validationToken;

        return $viewData;
    }
}
