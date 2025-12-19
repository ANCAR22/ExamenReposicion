<section class="py-4 px-4 depth-2">
    <h2>Lista de Tareas</h2>
</section> 
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Prioridad</th>
                <th>Completada</th>
                <th><a href="index.php?page=ControladorDatosTareas-FormDatosTarea&mode=INS">Nuevo</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach DatosTareas}}
            <tr>
                <td>{{tarea_id}}</td>
                <td>{{titulo}}</td>
                <td>{{descripcion}}</td>
                <td>{{prioridad}}</td>
                <td>{{completada}}</td>
                <td>
                    <a href="index.php?page=ControladorDatosTareas-FormDatosTarea&mode=UPD&id_tarea={{tarea_id}}">Editar</a>&nbsp;
                    <a href="index.php?page=ControladorDatosTareas-FormDatosTarea&mode=DEL&id_tarea={{tarea_id}}">Eliminar</a>&nbsp;
                    <a href="index.php?page=ControladorDatosTareas-FormDatosTarea&mode=DSP&id_tarea={{tarea_id}}">Ver</a>&nbsp;
                </td>
            </tr>
            {{endfor DatosTareas}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="right">
                    <strong>Total Tareas: {{total}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</section>

