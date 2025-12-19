<section class="py-4 px-4 depth-2">
    <h2>Lista de Tareas</h2>
</section> 
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Fecha Limite</th>
                <th><a href="index.php?page=ControladoresDatosTareas-FormDatosTarea&mode=INS">Nuevo</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach DatosTareas}}
            <tr>
                <td>{{id_tarea}}</td>
                <td>{{descripcion}}</td>
                <td>{{estado}}</td>
                <td>{{fecha_limite}}</td>
                <td>
                    <a href="index.php?page=ControladoresDatosTareas-FormDatosTarea&mode=UPD&id_tarea={{id_tarea}}">Editar</a>&nbsp;    
                    <a href="index.php?page=ControladoresDatosTareas-FormDatosTarea&mode=DEL&id_tarea={{id_tarea}}">Eliminar</a>&nbsp;
                    <a href="index.php?page=ControladoresDatosTareas-FormDatosTarea&mode=DSP&id_tarea={{id_tarea}}">Ver</a>&nbsp;
                </td>
            </tr>
            {{endfor DatosTareas}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="right">
                    <strong>Registros de tareas: {{total}}</strong>
                </td>
            </tr>       
        </tfoot>
    </table>
</section>