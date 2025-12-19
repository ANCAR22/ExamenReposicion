<?php

namespace Controllers\ControladorDatosTareas;

use Controllers\PublicController;
use Dao\DaoTareas\DatosTareas as dt;
use Views\Renderer;

class DatosTareas extends PublicController
{
    public function run(): void
    {
        $viewData = [];
        $viewData["DatosTareas"] = dt::obtenerDatos();
        $viewData["total"] = count($viewData["DatosTareas"]);
        Renderer::render("VistaDatosTareas/ListaTarea", $viewData);
    }
}
