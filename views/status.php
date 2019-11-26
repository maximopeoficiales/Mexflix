<?php
print('
  <h2 class="p1">Gestion de Status</h2>');
$status_controller = new StatusController();
/* guardo el select en una var */
$status = $status_controller->get();

/* si esta vacio los registros */
if (empty($status)) {
    print('
    <div class="container">
    <p class="item error">No hay datos en Status</p>
    </div>
    ');
} else {
    /* variable para generar mi html */
    /* hidden es oculto , cuando le de click enviara el value */
    $template_status = '
    <div class="item">
        <table>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th colspan="2">
                    <form  method="post">
                    <input type="hidden" name="r" value="status-add">
                    <input class="button add" type="submit" value="Agregar">
                    </form>
                </th>
            </tr>';
    for ($n = 0; $n < count($status); $n++) {
        /* recorrera el arreglo */
        /* r es el que se envia por la url y carga una pag
            el otro es porque envia un dato con el nombre status_id con el valor del array */
        $template_status .= '
            <tr>
                <td>' . $status[$n]['status_id'] . '</td>
                <td>' . $status[$n]['status'] . '</td>
                <td>
                <form  method="post">
                    <input type="hidden" name="r" value="status-edit">
                    <input type="hidden" name="status_id" value="' . $status[$n]['status_id'] . '">
                    <input class="button edit" type="submit" value="Editar">
                </form>
                </td>
            

                 <td>
                <form  method="post">
                    <input type="hidden" name="r" value="status-delete">
                    <input type="hidden" name="status_id" value="' . $status[$n]['status_id'] . '">
                    <input class="button delete" type="submit" value="Eliminar">
                </form>
                </td>
            </tr>
            
            ';
    }

    $template_status .= '
        </table>
    </div>
    ';
    echo($template_status);
}
