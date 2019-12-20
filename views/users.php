<?php
print('
  <h2 class="p1">Gestion de Usuarios</h2>');
$users_controller = new UsersController();
/* guardo el select en una var */ 
$users = $users_controller->get();

/* si esta vacio los registros */
if (empty($users)) {
    print('
    <div class="container">
    <p class="item error">No hay datos en usuarios</p>
    </div>
    ');
} else {
    /* variable para generar mi html */
    /* hidden es oculto , cuando le de click enviara el value */
    $template_users = '
    <div class="item">
        <table>
            <tr>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Cumpleaños</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th colspan="2">
                    <form  method="post">
                    <input type="hidden" name="r" value="user-add">
                    <input class="button add" type="submit" value="Agregar">
                    </form>
                </th>
            </tr>';
    for ($n = 0; $n < count($users); $n++) {
        /* recorrera el arreglo */
        /* r es el que se envia por la url y carga una pag
            el otro es porque envia un dato con el nombre users_id con el valor del array */
        $template_users .= '
            <tr>
                <td>' . $users[$n]['user'] . '</td>
                <td>' . $users[$n]['email'] . '</td>
                <td>' . $users[$n]['name'] . '</td>
                <td>' . $users[$n]['birthday'] . '</td>
                <td>' . $users[$n]['pass'] . '</td>
                <td>' . $users[$n]['role'] . '</td>
                <td>
                <form  method="post">
                    <input type="hidden" name="r" value="user-edit">
                    <input type="hidden" name="user" value="' . $users[$n]['user'] . '">
                    <input class="button edit" type="submit" value="Editar">
                </form>
                </td>
            

                 <td>
                <form  method="post">
                    <input type="hidden" name="r" value="user-delete">
                    <input type="hidden" name="user" value="' . $users[$n]['user'] . '">
                    <input class="button delete" type="submit" value="Eliminar">
                </form>
                </td>
            </tr>
            
            ';
    }

    $template_users .= '
        </table>
    </div>
    ';
    echo($template_users);
}
