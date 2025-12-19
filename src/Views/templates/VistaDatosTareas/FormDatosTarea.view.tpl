<section class="container">
    <section class="deplth-2">
        <h2>{{modeDsc}}</h2>
    </section>
    {{if hasErrores}}
    <ul>
        {{foreach errores}}
        <li>{{this}}</li>
        {{endfor errores}}
    </ul>
    {{endif hasErrores}}

    <form action="index.php?page=ControladorDatosTareas-FormDatosTarea&mode={{mode}}&id_tarea={{tarea_id}}" method="post">
        <div>
            <label for="tarea_id">ID de Tarea:</label><br/>
            <input type="text" name="tarea_id" id="tarea_id" value="{{tarea_id}}" readonly />
            <input type="hidden" name="vlt" value="{{token}}">
        </div><br/>
        <div>
            <label for="titulo">Título:</label><br/>
            <input type="text" name="titulo" id="titulo" value="{{titulo}}" {{readonly}} />
        </div><br/>
        <div>
            <label for="descripcion">Descripción:</label><br/>
            <input type="text" name="descripcion" id="descripcion" value="{{descripcion}}" {{readonly}} />
        </div><br/>
        <div>
            <label for="prioridad">Prioridad:</label><br/>
            <input type="text" name="prioridad" id="prioridad" value="{{prioridad}}" {{readonly}} />
        </div><br/>
        <div>
            <label for="completada">Completada:</label><br/>
            <input type="checkbox" name="completada" id="completada" value="1" {{completada ? 'checked' : ''}} {{readonly}} placeholder="150"/>
        </div><br/>
        <div>
            <button id="btnCancelar">Cancelar</button>
            {{ifnot isDisplay}}
                <button id="btnConfirmar" type="submit">Confirmar</button>
            {{endifnot isDisplay}}
        </div>
    </form>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("btnCancelar").addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=ControladorDatosTareas-DatosTareas");
    });
});
</script>
