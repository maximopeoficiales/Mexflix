
<?php
$status_controller = new StatusController();
if ($_POST['r'] == 'status-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST["crud"])) {
    /* llena $status con los datos del query */
    $status = $status_controller->get($_POST['status_id']);
    /* si esta vacio */
    if (empty($status)) {
        $template = '
        <div class="container">
            <p class="item error">No existe el status_id <b>%s</b></p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("status");
            }
        </script>

        ';
        /* imprimo el template */
        printf($template, $_POST['status_id']);
    } else {

        $template_status = '
        <h2 class="p1">Eliminar Status</h2>
        <form method="post" class="item">
            <div class="p1 f2">
                ¿Estas seguro de eliminar el status:
                <mark class="p1">%s</mark>?
            </div>
            <div class="p_25">
                <input class="button delete" type="submit" value="SI">
                <input class="button add" type="button" value="NO"
                onclick="history.back()">
                <input type="hidden" name="status_id"  value="%s">
                <input type="hidden" name="r"  value="status-delete">
                <input type="hidden" name="crud"  value="del">
            </div>
            
        </form>
        
        ';

        printf(
            $template_status,
            $status[0]["status"],
            $status[0]["status_id"]
        );
    }
} else if ($_POST['r'] == 'status-delete' && $_SESSION['role'] == 'Admin' && $_POST["crud"] == "del") {
    
    /* lo obtiene del envio submit cuando le das "si" */
    /* ejecuto y guardo el query */
    $status = $status_controller->del($_POST['status_id']);
    
    $template = '
    <div class="container">
        <p class="item edit">Status <b>%s</b> eliminado</p>
    </div>

    <script>
        window.onload = function () {
            reloadPage("status");
        }
    </script>
    ';

    /* usaremos printf para reemplazar %s con el parametro */
    printf($template, $_POST['status_id']);
} else {
    /* vista para acceso no autorizado */
    $controller = new ViewController();
    $controller->load_view("error401");
}
?>