<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
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
                        <h3>Clientes
                        <a class="btn btn-danger btn-sm" href="<?php echo base_url().'index.php/CUser'; ?>">
                            <i class="glyphicon glyphicon-log-out"></i>
                            Salir
                        </a>
                        </h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <!--<div class="row">-->
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
                                <h2>Configuración Descuento/Comisión</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="form-group">
                                    <label for="Nombre">[Cliente ID:<?php echo $data_user->idUsuario; ?>] <?php echo $data_user->nombre . " " . $data_user->apellido; ?></label><br />
                                    <input type="hidden" value="<?php echo $data_user->idUsuario; ?>" name='idEmpleado' >
                                </div>
                                <!--Lista de productos-->
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <th>Categoría</th>
                                        <th>Producto</th>
                                        <th>Precio Público</th>
                                        <th>Descuento Cliente</th>
                                        <th>Comisión Empleado</th>
                                        <th>Acción</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($config_user != FALSE) {
                                            foreach ($config_user as $row_list){
                                                ?>
                                                <tr style="background-color: #2A3F54;">
                                                    <td class="center green"><?php echo $row_list['descGrupoServicio']; ?></td>
                                                    <td class="center green"><?php echo "[".$row_list['idProducto']."] ".$row_list['descProducto']; ?></td>
                                                    <td class="center blue"><?php echo number_format($row_list['valorProducto'],0,',','.'); ?></td>
                                                    <td class="center red"><?php echo number_format($row_list['valorDescProd'],0,',','.'); ?></td>
                                                    <td class="center"><?php echo $row_list['porcenComisionProd']." %"; ?></td>
                                                    <td class="center">
                                                    <?php 
                                                    echo "<a class='btn-itemconfig btn btn-warning btn-sm' data-rel='".$row_list['idProducto']."' data-rel2='".$data_user->idUsuario."' data-rel3='".$row_list['idConfig']."' data-rel4='".$row_list['valorDescProd']."' data-rel5='".$row_list['porcenComisionProd']."' data-rel6='".$row_list['descProducto']."' href='#'>Configurar</a>";
                                                    ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!--/Fin Lista de productos-->
                            </div>
                        </div>
                    </div>
                    
                <!--</div>-->
            </div>
        </div>
        <!-- /page content -->

        <!--Modal - Configurar item-->
        <div class="modal fade" id="myModal-itemconfig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-itemconfig" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_product_int" action="<?php echo base_url() . 'index.php/CUser/saveconfiguser'; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Configurar Descuento/Comisión</h3>
                        </div>
                        <div class="modal-body">
                            <label class="control-label" for="Interno">Producto</label>
                            <input type="text" class="form-control" id="descProducto" name="descProducto" readonly="" >
                            <br />
                            <label class="control-label" for="pass">Valor Descuento al Cliente</label>
                            <input type="tel" class="form-control" id="valordesc" name="valordesc" placeholder="$" required="" autocomplete="off" pattern="\d*">
                            <br />
                            <label class="control-label" for="pass">Porcentaje Comisión al Empleado</label>
                            <input type="tel" class="form-control" id="commision" name="commision" placeholder="%" required="" autocomplete="off" pattern="\d*">
                            <br />
                            <input type="hidden" class="form-control" id="idproducto" name="idproducto">
                            <input type="hidden" class="form-control" id="idusuario" name="idusuario">
                            <input type="hidden" class="form-control" id="idconfig" name="idconfig">
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
    <!-- Datatables Buttons -->
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js'; ?>"></script>
    <script src="<?php echo base_url().'public/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'; ?>"></script>
    
  </body>
</html>
