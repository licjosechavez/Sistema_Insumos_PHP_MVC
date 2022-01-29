 <?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <  0 || empty($_POST['cantidad'] || $_POST['cantidad'] <  0)) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $codigo = $_POST['codigo'];
      $proveedor = $_POST['proveedor'];
      $producto = $_POST['producto'];
      $precio = $_POST['precio'];
      $cantidad = $_POST['cantidad'];
      $usuario_id = $_SESSION['idUser'];

      $query_insert = mysqli_query($conexion, "INSERT INTO producto(codigo, proveedor,descripcion,precio,existencia,usuario_id) values ('$codigo','$proveedor', '$producto', '$precio', '$cantidad','$usuario_id')");
      if ($query_insert) {
        $alert = '<div class="alert alert-success" role="alert">
                Insumo guardado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el insumo
              </div>';
      }
    }
  }
  ?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Nuevo Insumo</h1>
     <a href="lista_productos.php" class="btn btn-info">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <div class="card">
         
         <div class="card-body">
           <form action="" method="post" autocomplete="off">
             <?php echo isset($alert) ? $alert : ''; ?>
             <div class="form-group">
               <label for="codigo">Código</label>
               <input type="text" placeholder="Ingrese código" name="codigo" id="codigo" class="form-control">
             </div>
             <div class="form-group">
               <label>Proveedor</label>
               <?php
                $query_proveedor = mysqli_query($conexion, "SELECT codproveedor, proveedor FROM proveedor ORDER BY proveedor ASC");
                $resultado_proveedor = mysqli_num_rows($query_proveedor);
                mysqli_close($conexion);
                ?>

               <select id="proveedor" name="proveedor" class="form-control">
                 <?php
                  if ($resultado_proveedor > 0) {
                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                      // code...
                  ?>
                     <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                 <?php
                    }
                  }
                  ?>
               </select>
             </div>
             <div class="form-group">
               <label for="producto">Producto</label>
               <input type="text" placeholder="Ingrese nombre del insumo" name="producto" id="producto" class="form-control">
             </div>
           <div class="form-group">
               <label for="precio">Precio</label>
               <input type="text" placeholder="Ingrese precio" value="1" class="form-control" name="precio" id="precio">
             </div>
             <div class="form-group">
               <label for="cantidad">Cantidad</label>
               <input type="number" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad">
             </div>
             <input type="submit" value="Guardar Insumo" class="btn btn-success">
             <a href="lista_productos.php" class="btn btn-danger">Regresar</a>
           </form>
         </div>
       </div>
     </div>
   </div>


 </div>
 <!-- /.container-fluid -->
 <?php include_once "includes/footer.php"; ?>