<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Freya, Salon, Belleza, Gestion, Seguridad, Eficiencia, Calidad, Informacion">
    <meta name="author" content="Amadeus Soluciones">

    <title>Freya - Shop</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url().'public/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url().'public/gentelella/vendors/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url().'public/gentelella/vendors/nprogress/nprogress.css'; ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url().'public/gentelella/build/css/custom.min.css'; ?>" rel="stylesheet">
    
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url().'public/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css'; ?>" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="<?php echo base_url().'public/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>" rel="stylesheet">
    <!-- Datatables Buttons -->
    <link href="<?php echo base_url().'public/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'; ?>" rel="stylesheet">
    
    <link rel="shortcut icon" href="<?php echo base_url().'public/img/favicon.ico'; ?>">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <?php 
            /*include*/
            $this->load->view('includes/menu');
            ?>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <?php 
            /*include*/
            $this->load->view('includes/top');
            ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Reportes</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div></div>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="<?php echo base_url().'index.php/CReport/module/reportSedes'; ?>"><i class="glyphicon glyphicon-align-justify"></i> Ingresos General</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <!--<div class="row">-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!--Alerta-->
                        <?php if ($dataRow == 2){ ?>
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <?php echo $message; ?>
                            </div>
                        <?php } ?>
                        <!--/Alerta-->
                        
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Reporte de Ingresos detallado</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form role="form" name="form_report" action="<?php echo base_url().'index.php/CReport/paymentdetail'; ?>" method="post">
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="col-md-3 xdisplay_inputx form-group has-feedback"></div>
                                            <!--<div class="col-md-3 xdisplay_inputx form-group has-feedback">
                                                <input type="text" name="fechaini" required="" class="form-control has-feedback-left" id="single_cal1" value="<?php echo $fechaIni; ?>" placeholder="Fecha Inicio" aria-describedby="inputSuccess2Status" readonly="">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                            </div>
                                            <div class="col-md-3 xdisplay_inputx form-group has-feedback">
                                                <input type="text" name="fechafin" required="" class="form-control has-feedback-left" id="single_cal3" value="<?php echo $fechaFin; ?>" placeholder="Fecha Fin" aria-describedby="inputSuccess2Status" readonly="">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                            </div>-->
                                            <div class="col-md-6 xdisplay_inputx form-group has-feedback">
                                                <input type="text" name="dateRangeInput" required="" class="form-control has-feedback-left" id="single_cal_all" value="" placeholder="Fecha Inicio" aria-describedby="inputSuccess2Status" readonly="">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                <br />
                                                Estado de la Factura:
                                                <br />
                                                <select class="select2_single form-control" id="estado_factura" name="estado_factura" data-rel="chosen">
                                                    <option style="font-family: Arial; font-size: 16pt; background-color: #E0DD70; color: #000" value="5" >Pagada</option>
                                                    <option style="font-family: Arial; font-size: 16pt; background-color: #E0DD70; color: #000" value="8" >CuentaxCobrar</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                        <center>
                                            <button type="submit" class="btn btn-success">Consultar</button>
                                        </center>
                                    </div>
                                </form>
                                <?php if (($dataRow == 1) && ($this->config->item('mod_commision') == 1)) { ?>
                                    
                                    <!-- detalle pagos por producto con comision-->   
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>
                                                    Detalle de Ingresos
                                                    <br />
                                                    <span style="font-size: 12px">
                                                    Este reporte recupera las ventas detallando el producto, se tiene en cuenta la fecha del pago.
                                                    </span>
                                                </h2>
                                                
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha Recibo</th>
                                                            <th>Producto</th>
                                                            <th>Precio Público</th>
                                                            <th>Cargo Adicional</th>
                                                            <th>Cant</th>
                                                            <th>Precio Venta</th>
                                                            <th>Valor Pagado</th>
                                                            <th>Empleado</th>
                                                            <th>Recibo</th>
                                                            <th>Cliente</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($paymentDataSedes != FALSE){

                                                            $valueTotalVenta = 0;
                                                            foreach ($paymentDataSedes as $row_sede){
                                                                ?>
                                                                <tr style="background-color: #2A3F54;">
                                                                    <td class="center"><small><?php echo $row_sede['fechaLiquida']; ?></small></td>
                                                                    <td class="center"><small><?php echo '['.$row_sede['idRegistroDetalle'].'-'.$row_sede['idProducto'].'] '.$row_sede['descProducto']; ?></small></td>
                                                                    <td class="center blue"><?php echo number_format($row_sede['valorActual'],0,',','.'); ?></td>
                                                                    <td class="center"><small><?php echo $row_sede['cargoEspecial']; ?></small></td>
                                                                    <td class="center"><small><?php echo $row_sede['cantidad']; ?></small></td>
                                                                    <td class="center green"><?php echo number_format($row_sede['valorVenta'],0,',','.'); ?></td>
                                                                    <td class="center red"><?php echo number_format($row_sede['formaPago'],0,',','.'); ?></td>
                                                                    <td class="center"><small><?php echo $row_sede['idEmpleado']; ?></small></td>
                                                                    <td class="center green"><?php echo $row_sede['recibo']; ?></td>
                                                                    <td class="center"><small><?php echo $row_sede['nombre_cliente']; ?></small></td>
                                                                </tr>
                                                                <?php
                                                                $valueTotalVenta = $valueTotalVenta + $row_sede['valorVenta'];
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h2>
                                            <?php 
                                            if ($estadoFact == 5){ //Pagados
                                                echo "Total Ingresos: $".number_format($valueTotalVenta,0,',','.')." CO (No incluye los abonos recibidos para CuentasxCobrar)"; 
                                            }

                                            if ($estadoFact == 8){ //CuentaxCobrar
                                                //echo "Total Ingresos: $".number_format($valueTotalVenta,0,',','.')." CO"; 
                                            }
                                            ?>
                                            </h2>
                                        </div>
                                    </div>
                                    <!-- /detalle pagos por producto-->    

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <!--</div>-->

            </div>
        </div>
        <!-- /page content -->
                
        <!-- footer content -->
        <?php 
        /*include*/
        $this->load->view('includes/footer-bar');
        ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url().'public/gentelella/vendors/jquery/dist/jquery.min.js'; ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url().'public/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'public/gentelella/vendors/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url().'public/gentelella/vendors/nprogress/nprogress.js'; ?>"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url().'public/gentelella/build/js/custom.js'; ?>"></script><!--Minificar--> 
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url().'public/gentelella/vendors/moment/min/moment.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js'; ?>"></script>
    
    <!-- Datatables -->
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <!-- Datatables Buttons -->
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'; ?>"></script>
    
    <!-- ECharts -->
    <!--<script src="<?php //echo base_url().'public/gentelella/vendors/echarts/dist/echarts.min.js'; ?>"></script>-->
    
  </body>
</html>
