<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['cxcobrar']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Cuentas por Cobrar
						  <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptventas.php" target="_blank"><button class="btn btn-info"><i class="fa fa-clipboard"></i> Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Documento</th>
                            <th>Número</th>
                            <th>Total Venta</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Documento</th>
                            <th>Número</th>
                            <th>Total Venta</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 100%;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        
						
						   <div class="row">
                                <!-- Siniestro -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Siniestro(*):</label>
                                    <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required></select>
                                </div>

                                <!-- Fecha -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Fecha(*):</label>
                                    <input type="datetime-local" class="form-control" name="fecha_hora" id="fecha_hora" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Banco -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Banco(*):</label>
                                    <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required>
                                        <option value="Factura">Banorte</option>
                                        <option value="Ticket">Citibanamex</option>
                                        <option value="Boleta">BBVA</option>
                                    </select>
                                </div>

                                <!-- Cliente (Siniestro) -->
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Cliente:</label>
                                    <input type="text" class="form-control" name="siniestro" id="siniestro" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Serie -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Serie:</label>
                                    <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante">
                                </div>

                                <!-- Número -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Número:</label>
                                    <input type="text" class="form-control" name="num_comprobante" id="num_comprobante">
                                </div>

                                <!-- Impuesto -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Impuesto:</label>
                                    <input type="number" class="form-control" name="impuesto" id="impuesto" step="0.01">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Observaciones -->
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Observaciones:</label>
                                    <textarea name="observaciones" class="form-control" id="observaciones" rows="3"></textarea>
                                </div>
                            </div>				

						  
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/cxcobrar.js"></script>
<?php 
}
ob_end_flush();
?>


