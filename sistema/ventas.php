<?php include_once "includes/header.php"; 

//$uu="chavezdrive";
$id_u = $_SESSION['nombre']
//echo $id_u;
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de Egresos</h1>
		<? //echo $id_u; ?>
		<a href="nueva_venta.php" class="btn btn-primary">Nuevo</a>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>Id</th>
							<th>Fecha</th>
						
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						require "../conexion.php";
						$query = mysqli_query($conexion, "SELECT nofactura, fecha,codcliente, totalfactura, estado FROM factura ORDER BY nofactura ASC");
						mysqli_close($conexion);
						$cli = mysqli_num_rows($query);

						if ($cli > 0) {
							while ($dato = mysqli_fetch_array($query)) {
						?>
								<tr>
									<td><?php echo $dato['nofactura']; ?></td>
									<td><?php echo $dato['fecha']; ?></td>
								
									<td>
										<button type="button" class="btn btn-info view_factura" cl="<?php echo $dato['codcliente'];  ?>" f="<?php echo $dato['nofactura']; ?>" id_u="<?php echo $id_u; ?>">Ver</button>
									</td>
								</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>



</div>
<!-- /.container-fluid -->

<?php include_once "includes/footer.php"; ?>