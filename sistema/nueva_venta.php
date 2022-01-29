<?php include_once "includes/header.php";
$id_u = $_SESSION['nombre'] ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Nuevo Egreso</h1>
     <a href="ventas.php" class="btn btn-info">Regresar</a>
   </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <h4 class="text-center">Datos del solicitante</h4>
            <!--    <a href="registro_cliente.php" class="btn btn-primary btn_new_cliente"><i class="fas fa-user-plus"></i> Nuevo solicitante</a> -->
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" name="form_new_cliente_venta" id="form_new_cliente_venta">
                        <input type="hidden" name="action" value="addCliente">
                        <input type="hidden" id="idcliente" value="1" name="idcliente" required>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Área</label>
                                    <input type="text" name="dni_cliente" id="dni_cliente" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Responsable</label>
                                    <input type="text" name="nom_cliente" id="nom_cliente" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Tel. interno</label>
                                    <input type="number" name="tel_cliente" id="tel_cliente" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" name="dir_cliente" id="dir_cliente" class="form-control" disabled required>
                                </div>

                            </div>
                            <div id="div_registro_cliente" style="display: none;">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h4 class="text-center">Datos del egreso</h4>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> USUARIO</label>
                        <p style="font-size: 16px; text-transform: uppercase; color: #1897e0;"><?php echo $_SESSION['nombre']; ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Acciones</label>
                    <div id="acciones_venta" class="form-group">
                        <a href="#" class="btn btn-danger" id="btn_anular_venta">Anular</a>
                        <a href="#" class="btn btn-success" id="btn_facturar_venta"><i class="fas fa-save"></i> Generar Egreso</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th width="100px">Código</th>
                            <th>Desc.</th>
                            <th>Stock</th>
                            <th width="100px">Cantidad</th>
                        <!--    <th class="textright">Precio</th>
                            <th class="textright">Precio Total</th> -->
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="txt_cod_producto" id="txt_cod_producto">
                                <input type="text" name="txt_cod_pro" id="txt_cod_pro">
                            </td>
                            <td id="txt_descripcion">-</td>
                            <td id="txt_existencia">-</td>
                            <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                        <!--    <td id="txt_precio" class="textright">0.00</td>
                            <td id="txt_precio_total" class="txtright">0.00</td> -->
                            <td><a href="#" id="add_product_venta" class="btn btn-dark" style="display: none;">Agregar</a></td>
                        </tr>
                        <tr>
                            <th>Id</th>
                            <th colspan="2">Descripción</th>
                            <th>Cantidad</th>
                        <!--    <th class="textright">Precio</th>
                            <th class="textright">Precio Total</th> -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="detalle_venta">
                        <!-- Contenido ajax -->

                    </tbody>

                    <tfoot id="detalle_totales">
                        <!-- Contenido ajax -->
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<?php include_once "includes/footer.php"; ?>