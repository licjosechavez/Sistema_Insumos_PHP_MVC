<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if ($dni != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM cliente where dni = '$dni'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El solicitante ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO cliente(dni,nombre,telefono,direccion, usuario_id) values ('$dni', '$nombre', '$telefono', '$direccion', '$usuario_id')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Solicitante registrado
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nuevo Solicitante</h1>
        <a href="lista_cliente.php" class="btn btn-info">Regresar</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <?php echo isset($alert) ? $alert : ''; ?>
                        <div class="form-group">
                            <label for="dni">Área</label>
                            <input type="text" placeholder="Ingrese área" name="dni" id="dni" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre del responsable</label>
                            <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Tel. interno</label>
                            <input type="number" placeholder="Ingrese teléfono" name="telefono" id="telefono" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Celular</label>
                            <input type="text" placeholder="Ingrese celular" name="direccion" id="direccion" class="form-control">
                        </div>
                        <input type="submit" value="Guardar Solicitante" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>