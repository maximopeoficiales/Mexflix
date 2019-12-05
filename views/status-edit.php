
<?php
$status_controller = new StatusController();
if ($_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST["crud"])) {
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
        /* cuando un elemento esta disabled no se puede usar su dato
        por lo cual creas un hidden con el mismo dato*/
        $template_status = '
        <h2 class="p1">Editar Status</h2>
        <form method="post" class="item">

            <div class="p_25">
                <input type="text" placeholder="status_id" value="%s" disabled required>

                <input type="hidden" name="status_id" value="%s">
            
            </div>
            <div class="p_25">
                <input type="text" name="status" placeholder="status" value="%s" required>

            </div>
            <div class="p_25">
                <input class="button edit" type="submit" value="Editar">
                <input type="hidden" name="r"  value="status-edit">
                <input type="hidden" name="crud"  value="set">
            </div>
            
        </form>
        
        ';

        printf(
            $template_status,
            $status[0]["status_id"],
            $status[0]["status_id"],
            $status[0]["status"]
        );
    }
} else if ($_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Admin' && $_POST["crud"] == "set") {
    /* se crea array que se usara para enviar datos */
    $save_status = array(
        'status_id' => $_POST['status_id'],
        'status' => $_POST['status']
    );
    /* ejecuto y guardo el query */
    $status = $status_controller->set($save_status);
    
    $template = '
    <div class="container">
        <p class="item edit">Status <b>%s</b> salvado</p>
    </div>

    <script>
        window.onload = function () {
            reloadPage("status");
        }
    </script>
    ';

    /* usaremos printf para reemplazar %s con el parametro */
    printf($template, $_POST['status']);
} else {
    /* vista para acceso no autorizado */
    $controller = new ViewController();
    $controller->load_view("error401");
}
?>