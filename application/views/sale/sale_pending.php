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
    
    <!-- Datatables -->
    <link href="<?php echo base_url().'public/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>" rel="stylesheet">
    <!--<link href="<?php // echo base_url().'public/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'; ?>" rel="stylesheet">-->
    <!--<link href="<?php // echo base_url().'public/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'; ?>" rel="stylesheet">-->
    <!--<link href="<?php // echo base_url().'public/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'; ?>" rel="stylesheet">-->
    <!--<link href="<?php // echo base_url().'public/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'; ?>" rel="stylesheet">-->
    
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
                        <h3>Ventas</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div></div>
                                <span class="input-group-btn">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!--Alerta-->
                        <?php if ($alert == 1){ ?>
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <?php echo $message; ?>
                            </div>
                        <?php } else if ($alert == 2){ ?>
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <?php echo $message; ?>
                            </div>
                        <?php } ?>
                        <!--/Alerta-->
                        
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Pendientes de Pago</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <th>idVenta</th>
                                        <th>Recibo</th>
                                        <th>Fecha Registro</th>
                                        <th>Venta</th>
                                        <th>Liquidado</th>
                                        <th>Propina</th>
                                        <th>Abono</th>
                                        <th>Total Saldo</th>
                                        <th>Cliente</th>
                                        <th>Accion</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($listaLiquidados != NULL){
                                            foreach ($listaLiquidados as $row_liquidado){
                                                ?>
                                                <tr style="background-color: #2A3F54;">
                                                    <td class="center red"><?php echo $row_liquidado['idVenta']; ?></td>
                                                    <td class="center red"><?php echo $row_liquidado['nroRecibo']; ?></td>
                                                    <td class="center blue"><?php echo $row_liquidado['fechaLiquida']; ?></td>
                                                    <td class="center green">$<?php echo number_format($row_liquidado['valorVenta'],0,',','.'); ?></td>
                                                    <td class="center green">$<?php echo number_format($row_liquidado['valorLiquida'],0,',','.'); ?></td>
                                                    <td class="center red">$<?php echo number_format($row_liquidado['popina_servicio'],0,',','.'); ?></td>
                                                    <td class="center blue">$<?php echo number_format($row_liquidado['pagoAbono'],0,',','.'); ?></td>
                                                    <td class="center red" style="font-size: 18px; font-weight: bold">$<?php echo number_format(($row_liquidado['valorLiquida']+$row_liquidado['popina_servicio'])-$row_liquidado['pagoAbono'],0,',','.'); ?></td>
                                                    <td class="center" style="color: #FFF"><?php echo $row_liquidado['nombreCliente']."<br />[CC ".$row_liquidado['idUsuarioCliente']."]"."<br />[Tel. ".$row_liquidado['numCelular']."]"; ?></td>
                                                    <td class="center">
                                                        
                                                        <a class="btn btn-info btn-sm" href="<?php echo base_url().'index.php/CSale/restoresale/'.$row_liquidado['idVenta'].'/'.$row_liquidado['idUsuarioCliente'].'/'.$row_liquidado['porcenDescuento'].'/'.$row_liquidado['porcenServicio'].'/'.$row_liquidado['idEmpleadoAtiende']; ?>">
                                                            <i class="glyphicon glyphicon-cog"></i>
                                                            Recuperar
                                                        </a>
                                                        <br />
                                                        <?php 
                                                        echo "<a class='btn-itemobs btn btn-warning btn-sm' data-rel='".$row_liquidado['idVenta']."' data-rel2='".$row_liquidado['nroRecibo']."' data-rel3='".$row_liquidado['observacionCuenta']."' href='#'>Observación</a>";
                                                        ?>
                                                        
                                                        <!--Descargar PDF-->
                                                        <?php
                                                        $timestamp = strtotime($row_liquidado['fechaLiquida']);
                                                        ?>
                                                        <a href="<?php echo base_url() . 'files/recibos/'.$timestamp.'P.pdf'; ?>" class="btn btn-primary btn-sm" target="_blank">
                                                            <i class="glyphicon glyphicon-search glyphicon-download"></i> Descargar PDF
                                                        </a>
                                                        <!--END: Descargar PDF-->
                                                        
                                                        <!--SMS Cuenta Cobro-->
                                                        <?php if ($this->config->item('sms_ccobro') == 1) { ?>
                                                        <form role="form" target="_blank" name="form_sms_sale" action="<?php echo base_url().'index.php/CReport/sendreceipt'; ?>" method="post">
                                                            <input type="hidden" value="<?php echo $timestamp."P"; ?>" name="receiptcode">
                                                            <input type="hidden" value="<?php echo $row_liquidado['numCelular']; ?>" name="telsend">
                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                <i class="glyphicon glyphicon-send glyphicon-white"></i>
                                                                Enviar SMS
                                                            </button>
                                                        </form>
                                                        <?php } ?>
                                                        <!--END: SMS Cuenta Cobro-->
                                                        
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!--Modal - Observacion CuentaxCobrar-->
        <div class="modal fade" id="myModal-itemobs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-itemobs" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_product_int" action="<?php echo base_url() . 'index.php/CSale/saveobservacioncuenta'; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Observación CuentaxCobrar<br /><span style='color: gray'>Recibo <div id='recibo'></div></span></h3>
                        </div>
                        <div class="modal-body">
                            <label class="control-label" for="Interno">Observación</label>
                            <input type="text" id="observCuenta" name="observCuenta" required="" class="form-control" placeholder="Observación de la Cuenta x Cobrar" autocomplete="off" style="height: 80px;" maxlength="90" >
                            <br />
                            <input type="hidden" class="form-control" id="idventa" name="idventa">
                            <input type="hidden" class="form-control" id="nroRecibo" name="nroRecibo">
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
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
    
    <!-- Datatables -->
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/jszip/dist/jszip.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/pdfmake/build/pdfmake.min.js'; ?>"></script>-->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/pdfmake/build/vfs_fonts.js'; ?>"></script>-->
    
    <!-- Chart.js -->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/Chart.js/dist/Chart.min.js'; ?>"></script>-->
    <!-- jQuery Sparklines -->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/jquery-sparkline/dist/jquery.sparkline.min.js'; ?>"></script>-->
    <!-- easy-pie-chart -->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'; ?>"></script>-->
    <!-- bootstrap-progressbar -->
    <!--<script src="<?php // echo base_url().'public/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'; ?>"></script>-->
    
  </body>
</html>
