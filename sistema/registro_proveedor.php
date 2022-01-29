<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['email']) || empty($_POST['CBU']) ) {
        $alert = '<div class="alert alert-danger" role="alert">
                        Todo los campos son obligatorios
                    </div>';
    } else {
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $Direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $CBU = $_POST['CBU'];
        $usuario_id = $_SESSION['idUser'];
        $query = mysqli_query($conexion, "SELECT * FROM proveedor where contacto = '$contacto'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El CUIT ya esta registrado
                    </div>';
        }else{
        

        $query_insert = mysqli_query($conexion, "INSERT INTO proveedor(proveedor,contacto,telefono,direccion,email,CBU,usuario_id) values ('$proveedor', '$contacto', '$telefono', '$Direccion','$email','$CBU','$usuario_id')");
        //echo $query_insert;
        if ($query_insert) {
            $alert = '<div class="alert alert-primary" role="alert">
                        Proveedor Registrado
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                       Error al registrar proveedor
                    </div>';
        }
        }
    }
}
mysqli_close($conexion);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Nuevo Proveedor</h1>
     <a href="lista_proveedor.php" class="btn btn-info">Regresar</a>
   </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Ingrese nombre" name="proveedor" id="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contacto">CUIT(sin guiones)</label>
                        <input type="number" placeholder="Ingrese CUIT" name="contacto" id="contacto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="number" placeholder="Ingrese teléfono" name="telefono" id="telefono" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" placeholder="Ingrese Direccion" name="direccion" id="direcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" placeholder="Ingrese Email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="CBU">CBU</label>
                        <input type="number" placeholder="Ingrese CBU" name="CBU" id="CBU" class="form-control">
                    </div>
                    <input type="submit" value="Guardar Proveedor" class="btn btn-success">
                    <a href="lista_proveedor.php" class="btn btn-danger">Regresar</a>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>