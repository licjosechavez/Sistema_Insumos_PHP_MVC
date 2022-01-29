<?php include_once "includes/header.php";
//$id_u = $_SESSION['nombre']

$conn = new mysqli('localhost', 'root', '', 'sis_venta');

$sql = "SELECT * FROM factura";
if ($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result);
    //echo "The total number of rows are: ".$rowcount; 
}

$sql2 = "SELECT * FROM proveedor";
if ($result2=mysqli_query($conn,$sql2)) {
    $rowcount2=mysqli_num_rows($result2);
    //echo "The total number of rows are: ".$rowcount; 
}



?>

<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">


		<!-- Pending Requests Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="ventas.php">
			<div class="card border-left-warning bg-white shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Egresos</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rowcount; ?></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_productos.php">
			<div class="card border-left-info shadow h-100 py-2 bg-white">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Insumos</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $data['productos']; ?></div>
								</div>
								
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-notes-medical fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_cliente.php">
			<div class="card border-left-success shadow h-100 py-2 bg-white">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Solicitantes</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['clientes']; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-hospital-user fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		

		

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_proveedor.php">
			<div class="card border-left-primary shadow h-100 py-2 bg-white">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Proveedores</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rowcount2; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user-tie fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		
		<div class="row mt-5"><br><br></div>
		<div class="col-lg-6">
			<div class="au-card m-b-30">
				<div class="au-card-inner">
					<h3 class="title-2 m-b-40">Productos con stock mínimo</h3>
					<canvas id="sales-chart"></canvas>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="au-card m-b-30">
				<div class="au-card-inner">
					<h3 class="title-2 m-b-40">Productos más entregados</h3>
					<canvas id="polarChart"></canvas>
				</div>
			</div>
		</div>
	</div>


</div>

<?php include_once "includes/footer.php"; ?>