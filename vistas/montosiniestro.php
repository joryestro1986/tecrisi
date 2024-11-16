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

if ($_SESSION['siniestros']==1)
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
                          <h1 class="box-title">Categoría <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptcategorias.php" target="_blank"><button class="btn btn-info"><i class="fa fa-clipboard"></i> Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                           <th>Opciones</th>
                                <th>Siniestro</th>
                                <th>Monto</th>
                                <th>Debe</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                             <th>Opciones</th>
                                <th>Siniestro</th>
                                <th>Monto</th>
                                <th>Debe</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
							  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
							  <label>Siniestro(*):</label>
										<select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required></select>
									</div>

                                <!-- Monto / Total -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Monto / Total:</label>
                                    <input type="number" class="form-control" name="monto" id="monto" step="0.01" placeholder="Monto.. ">
                                </div>
								
													  	<div class="form-group col-lg-2 col-md-6 col-sm-3 col-xs-12">
                            <label>OBSERVACIONES:</label>
							 <textarea type="text"  id="obervamonto" name="obervamonto" maxlength="1500"   placeholder="OBSERVACIONES.. " ></textarea>
							<!-- <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="38" placeholder="OBSERVACIONES.. "> -->
                          </div>
                           
							
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/montosiniestro.js"></script>
<?php 
}
ob_end_flush();
?>


