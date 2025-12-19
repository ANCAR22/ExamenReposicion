<section class="container"
>
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

    <form action="index.php?page=ControladoresDatosTareas-FormDatosTarea&mode={{mode}}&id_tarea={{id_tarea}}" method="post">
        <div>
            <label for="id_tarea">Id de Tarea:</label><br/>
            <input type="text" name="id_tarea" id="id_tarea" value="{{id_tarea}}" readonly />
            <input type="hidden" name="vlt" value="{{token}}" >
        </div><br/>
        <div>
            <label for="descripcion">Descripcion:</label><br/>
            <input type="text" size="60" name="descripcion" id="descripcion" value="{{descripcion}}" {{readonly}} />
        </div><br/>
        <div>
            <label for="estado">Estado:</label><br/>
            <input type="text" size="20" name="estado" id="estado" value="{{estado}}" {{readonly}} />
        </div><br/>
        <div>
            <label for="fecha_limite">Fecha Limite:</label><br/>
            <input type="date" name="fecha_limite" id="fecha_limite" value="{{fecha_limite}}" {{readonly}}/>
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
            window.location.assign("index.php?page=ControladoresDatosTareas-DatosTareas");
        })
    })
</script>