<?php
$users_controller = new UsersController();
if ($_POST['r'] == 'user-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST["crud"])) {
    /* llena $status con los datos del query */
    $user = $users_controller->get($_POST['user']);
    /* si esta vacio */
    if (empty($user)) {
        $template = '
        <div class="container">
            <p class="item error">No existe el Usuario <b>%s</b></p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("usuarios");
            }
        </script>

        ';
        /* imprimo el template */
        printf($template, $_POST['user']);
    } else {

        $template_user = '
        <h2 class="p1">Eliminar Usuario</h2>
        <form method="post" class="item">
            <div class="p1 f2">
                ¿Estas seguro de eliminar el Usuario:
                <mark class="p1">%s</mark>?
            </div>
            <div class="p_25">
                <input class="button delete" type="submit" value="SI">
                <input class="button add" type="button" value="NO"
                onclick="history.back()">
                <input type="hidden" name="user"  value="%s">
                <input type="hidden" name="r"  value="user-delete">
                <input type="hidden" name="crud"  value="del">
            </div>
            
        </form>
        
        ';

        printf(
            $template_user,
            $user[0]["user"],
            $user[0]["user"]
        );
    }
} else if ($_POST['r'] == 'user-delete' && $_SESSION['role'] == 'Admin' && $_POST["crud"] == "del") {
    
    /* lo obtiene del envio submit cuando le das "si" */
    /* ejecuto y guardo el query */
    $user = $users_controller->del($_POST['user']);
    
    $template = '
    <div class="container">
        <p class="item delete">Usuario <b>%s</b> eliminado</p>
    </div>

    <script>
        window.onload = function () {
            reloadPage("usuarios");
        }
    </script>
    ';

    /* usaremos printf para reemplazar %s con el parametro */
    printf($template, $_POST['user']);
} else {
    /* vista para acceso no autorizado */
    $controller = new ViewController();
    $controller->load_view("error401");
}
?>