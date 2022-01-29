<?php
	session_start();
	if(empty($_SESSION['active']))
	{
		header('location: ../');
	}

	include "../../conexion.php";
	$id_u = $_GET['id_u'];
	//$id_usuario = $_SESSION['idusuario']:
	//echo $nombre_u;
	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		echo "No es posible generar la factura.";
	}else{
		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];

		$id_u = $_REQUEST['id_u'];

		$consultau = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario='$id_u' ");
		$resultadou = mysqli_fetch_assoc($consultau);


		$consulta = mysqli_query($conexion, "SELECT * FROM configuracion");
		$resultado = mysqli_fetch_assoc($consulta);


		$ventas = mysqli_query($conexion, "SELECT * FROM factura WHERE nofactura = $noFactura");
		$result_venta = mysqli_fetch_assoc($ventas);
		$clientes = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $codCliente");
		$result_cliente = mysqli_fetch_assoc($clientes);
		$productos = mysqli_query($conexion, "SELECT d.nofactura, d.codproducto, d.cantidad, p.codproducto, p.descripcion, p.precio FROM detallefactura d INNER JOIN producto p ON d.nofactura = $noFactura WHERE d.codproducto = p.codproducto");
		
		
		
		
		
		require_once 'fpdf/fpdf.php';
	

		$pdf = new FPDF('P', 'cm', array(21, 29.7));
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetMargins(1, 2, 5);
		$pdf->SetTitle("Egreso");
		$pdf->SetFont('Arial', 'B', 15);
		
		$pdf->Ln();
		$pdf->image("img/logo_insumos.png", 12, 1, 7, 'PNG');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(10, 2.3, utf8_decode("Hospital de Clínicas | Sec. Administrativa"), 0, 1, 'C');
		//$pdf->Cell(10, 1, utf8_decode("Secretaría. Administrativa"), 0, 0, 'C');
		//$pdf->SetMargins(1, 5, 15);
		$pdf->Cell(9, 1, "____________________________________________________________________________", 0, 1, 'L');
		
		$pdf->SetFont('Arial', 'B', 11);
		
		$pdf->Ln();
		//$pdf->Cell(2, 1, "Nro. de egreso: ", 0, 1, 'L');
		//$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->Cell(1, 1, "Nro. de Egreso: ".$noFactura, 0, 1, 'L');
		$pdf->Cell(1, 1, "Fecha y hora: ".$result_venta['fecha'], 0, 1, 'L');

		$pdf->Cell(0, 0, "_____________________________", 0, 1, 'L');
		$pdf->Ln();
		$pdf->Cell(2, 2, "Datos del solicitante", 0, 1, 'L');

		$pdf->SetFont('Arial', 'B', 8);
		
		$pdf->Cell(5, 0, "Area", 0, 0, 'L');
		$pdf->Cell(5, 0, "Responsable", 0, 0, 'L');
		$pdf->Cell(5, 0, utf8_decode("Teléfono interno"), 0, 0, 'L');
		$pdf->Cell(5, 0, utf8_decode("Celular"), 0, 1, 'L');
		$pdf->SetFont('Arial', '', 8);
		if ($_GET['cl'] == 1) {
		$pdf->Cell(5, 1, utf8_decode("Público en general"), 0, 0, 'L');
		$pdf->Cell(5, 1, utf8_decode("-------------------"), 0, 0, 'L');
		$pdf->Cell(5, 1, utf8_decode("-------------------"), 0, 1, 'L');
		}else{
		$pdf->Cell(5, 1, utf8_decode($result_cliente['dni']), 0, 0, 'L');
		$pdf->Cell(5, 1, utf8_decode($result_cliente['nombre']), 0, 0, 'L');
		$pdf->Cell(5, 1, utf8_decode($result_cliente['telefono']), 0, 0, 'L');
		$pdf->Cell(1, 1, utf8_decode($result_cliente['direccion']), 0, 1, 'L');
		}
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(2, 2, "Detalle de Insumos", 0, 1, 'L');
		//$pdf->Ln();
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(12, 0, 'Insumo', 0, 0, 'L');
		$pdf->Cell(10, 0, 'Cantidad', 0, 0, 'L');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 8);
		while ($row = mysqli_fetch_assoc($productos)) {
			$pdf->Ln();
			$pdf->Cell(0, 0, "__________________________________________________________________________________________________________", 0, 1, 'L');

			$pdf->Cell(13, 1, utf8_decode($row['descripcion']), 0, 0, 'L');
			$pdf->Cell(2, 1, $row['cantidad'], 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(0, 0, "__________________________________________________________________________________________________________", 0, 1, 'L');

			
		}
		

		$pdf->Ln();
		//$pdf->SetFont('Arial', 'B', 10);

		//$pdf->Cell(76, 5, 'Total: ' . number_format($result_venta['totalfactura'], 2, '.', ','), 0, 1, 'R');
		//$pdf->Ln();
		$pdf->SetFont('Arial', '', 12);
		
		$pdf->Cell(0, 6, utf8_decode("...................................."), 0, 1, 'L');
		$pdf->Cell(0, -5, utf8_decode("       Resp. Insumos"), 0, 0, 'L');
		//$pdf->Cell(0, -5, $id_u, 0, 0, 'L');

		$pdf->Cell(0, -6, utf8_decode("........................................"), 0, 1, 'R');
		$pdf->Cell(0, 7, utf8_decode($result_cliente['nombre']), 0, 0, 'R');
		
		$pdf->Output("egreso.pdf", "I");
		}

?>
