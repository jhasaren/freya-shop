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
    
    <link rel="shortcut icon" href="<?php echo base_url().'public/img/favicon.ico'; ?>">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed"> <!--menu_fixed-->
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
                        <h3>Registrar Venta</h3>
                        <?php 
                        if ($porcenInList->idEstadoRecibo == 8){
                            echo "CUENTA X COBRAR";
                        } 
                        
                        /*Setea los datos como variable de sesion*/
                        $datos_session = array(
                            'sdescuento' => ($porcenInList->porcenDescuento*100),
                            'sservicio' => ($porcenInList->porcenServicio*100),
                            'sclient' => $clientInList->idUsuario,
                            'sclientcategory' => $clientInList->categoria,
                            'sempleado' => $porcenInList->idEmpleadoAtiende
                        );
                        $this->session->set_userdata($datos_session);
                        ?>
                        <?php
                        /*echo "<br />Lista Usuarios Venta->".$this->cache->memcached->get('memcached10')."<br />";
                        echo "Lista Servicios->".$this->cache->memcached->get('memcached12')."<br />";
                        echo "Lista Productos->".$this->cache->memcached->get('memcached16')."<br />";
                        echo "Cliente en Lista->".$this->cache->memcached->get('memcached11')."<br />";*/
                        ?>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div></div>
                                <span style="font-size: 18px">
                                    <?php
                                    if ($serviceInList != FALSE){
                                        foreach ($serviceInList as $valueServ){
                                            $serviceSubtotal = $serviceSubtotal+$valueServ['valor'];
                                        }
                                    }
                                    if ($productInList != FALSE){
                                        foreach ($productInList as $valueProd){
                                            $productoSubtotal = $productoSubtotal+$valueProd['valor'];
                                        }
                                    }
                                    if ($adicionalInList != FALSE){
                                        foreach ($adicionalInList as $valueAdic){
                                            $adicionalSubtotal = $adicionalSubtotal+$valueAdic['valor'];
                                        }
                                    }
                                    $valorConceptos = $serviceSubtotal+$productoSubtotal+$adicionalSubtotal;
                                    $subtotal = ($valorConceptos)-($serviceSubtotal*(($porcenInList->porcenDescuento)));
                                    ?>
                                    <div style="color: #000000; font-size: 16px">Descuento: <?php echo (number_format($porcenInList->porcenDescuento*100,2,',','.'))."%-($".number_format($valorConceptos,0,',','.').")"; ?></div>
                                    <div style="color: #000000; font-size: 16px">Servicio: <?php echo (round($porcenInList->porcenServicio*100,2))."%+($".number_format($subtotal,0,',','.').")"; ?></div>
                                    <span style="color: #000000; font-size: 28px">Subtotal: $<?php echo number_format($subtotal+(($subtotal*($porcenInList->porcenServicio))),0,',','.'); ?></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!--Alerta-->
                        <?php if ($receiptSale->cantidad == 0){ ?>
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                No hay recibos disponibles.
                            </div>
                        <?php } ?>
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
                        <!--Alerta Add Concepto-->
                        <?php if ($idmessage == 1){ ?>
                        <div class="alert alert-info alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $message; ?>
                        </div>
                        <?php } else if ($idmessage == 2) { ?>
                        <div class="alert alert-danger alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $message; ?>
                        </div>
                        <?php } ?>
                        <!--/Alerta Add Concepto-->
                        <!--Alerta Fecha Dia Anterior-->
                        <?php if ($this->config->item('sale_yesterday') == 999){ ?><!--Deshabilitado-->
                        <div class="alert alert-warning alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            El registro de la venta y sus pagos parciales quedarán registrados con fecha del día de ayer.
                        </div>
                        <?php } ?>
                        <!--/Alerta Fecha Dia Anterior-->

                        <div class="x_panel">
                            <div class="x_title">
                                <h2>ID:<?php echo $this->session->userdata('idSale'); ?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php if ($porcenInList->idEstadoRecibo != 8) { ?>
                                <div class="row">
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6"> 
                                        <a class="btn-saleclient" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                        <span class="glyphicon-class" style="font-size: 14px;">Cliente</span>
                                                        <div>-<?php echo $clientInList->idUsuario.'-'; ?></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                    <?php if ($this->config->item('tipo_negocio') == 1 || $this->config->item('tipo_negocio') == 2) { ?>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saleservice" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
                                                        <?php if ($this->config->item('tipo_negocio') == 1) { ?>
                                                            <span class="glyphicon-class" style="font-size: 14px;">Plato Fuerte</span>
                                                        <?php } else { ?>
                                                            <span class="glyphicon-class" style="font-size: 14px;">Producto Principal</span>
                                                        <?php } ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>    
                                    </div>
                                    <?php } ?>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saleproduct" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                                                        <?php if ($this->config->item('tipo_negocio') == 1) { ?>
                                                            <span class="glyphicon-class" style="font-size: 14px;">Producto</span>
                                                        <?php } else { ?>
                                                            <?php if ($this->config->item('tipo_negocio') == 2) { ?>
                                                                <span class="glyphicon-class" style="font-size: 14px;">Otros Productos</span>
                                                            <?php } else { ?>
                                                                    <span class="glyphicon-class" style="font-size: 14px;">Artículos</span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saleespecial" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                                                        <span class="glyphicon-class" style="font-size: 14px;">Cargo Adicional</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>    
                                    </div>
                                    
                                    <?php if ($this->config->item('mod_commision') == 1) { ?>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saledescMan" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                                                        <span class="glyphicon-class" style="font-size: 14px;">
                                                            Descuento/comisión manual
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                    <?php } else { ?>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saledesc" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                                                        <span class="glyphicon-class" style="font-size: 14px;">
                                                            <?php if ($this->config->item('tipo_negocio') !== 3) { ?>
                                                                Servicio/Descuento
                                                                <div><?php echo (round($porcenInList->porcenServicio*100,2))."% / ".($porcenInList->porcenDescuento*100)."%"; ?></div>
                                                            <?php } else { ?>
                                                                Descuento
                                                                <div><?php echo (number_format($porcenInList->porcenDescuento*100,2,',','.'))."%"; ?></div>
                                                            <?php } ?>
                                                            
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>    
                                    <?php } ?>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saleempleado" href="#">
                                            <div class="bs-glyphicons">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                                        <span class="glyphicon-class" style="font-size: 14px;">
                                                            Empleado
                                                            <div>-<?php echo $porcenInList->idEmpleadoAtiende.'-'; ?></div>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row">
                                    <?php //if ($this->session->userdata('sclient') != NULL) { ?>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <div class="x_panel" style="background-color: #81a4ba;">
                                            <div class="x_title" style="color: white;">
                                                <h2>Info. Cliente | <?php echo $this->session->userdata('param_pay_yesterday'); ?></h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content" style="color: white;">
                                                Nombre: <?php echo $clientInList->nombre_usuario; ?> | 
                                                <?php if ($this->config->item('category_client') == 1) { ?>
                                                Categoría: <?php echo $clientInList->categoria; ?><br />
                                                <?php } ?>
                                                Dirección: <?php echo $clientInList->direccion; ?> | 
                                                Telefono: <?php echo $clientInList->numCelular; ?> |
                                                Email: <?php echo $clientInList->email; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <a class="btn-saleinterno" href="#">
                                            <div class="">
                                                <ul class="bs-glyphicons-list">
                                                    <li>
                                                        <p class="center-block download-buttons">
                                                            <a href="<?php echo base_url() . 'index.php/CSale/liquidasale'; ?>" class="btn btn-success btn-lg">
                                                                <i class="glyphicon glyphicon-barcode glyphicon-white"></i> Liquidar
                                                            </a>
                                                            <?php if ($porcenInList->idEstadoRecibo != 8) { ?>
                                                            <a href="<?php echo base_url() . 'index.php/CSale/canceldatasale'; ?>" class="btn btn-default btn-lg">
                                                                <i class="glyphicon glyphicon-remove red"></i> Eliminar
                                                            </a>
                                                            <?php } ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                    <?php //} ?>
                                    <?php if ($serviceInList != NULL){ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title" style="background-color: #89e0e0; color: black;">
                                                <h2>Plato Fuerte</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Nombre</th>
                                                            <th>Cantidad</th>
                                                            <th>Valor</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($serviceInList as $row_service_in){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $row_service_in['idRegistroDetalle']; ?></th>
                                                                <td><?php echo $row_service_in['descServicio']; ?></td>
                                                                <td><?php echo $row_service_in['cantidad']; ?></td>
                                                                <td>$<?php echo number_format($row_service_in['valor'],0,',','.'); ?></td>
                                                                <td>
                                                                    <?php 
                                                                    if ($porcenInList->idEstadoRecibo != 8) {
                                                                        echo "<a class='btn-saleitemdel' data-rel='".$row_service_in['idRegistroDetalle']."' data-rel2='1' href='#'><i class='glyphicon glyphicon-remove red'></i></a>";
                                                                    } 
                                                                    ?>
                                                                </td>
                                                                
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($productInList != NULL){ ?>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title" style="background-color: #5ec0ff; color: black;">
                                                <h2>Productos</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Nombre</th>
                                                            <th>Cant</th>
                                                            <th>Precio Público</th>
                                                            <th>Precio Cliente</th>
                                                            <th>Comisión</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($productInList as $row_product_in){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $row_product_in['idRegistroDetalle']; ?></th>
                                                                <td><?php echo $row_product_in['descProducto']; ?></td>
                                                                <td><?php echo $row_product_in['cantidad']; ?></td>
                                                                <td>$<?php echo number_format($row_product_in['valorProducto'],0,',','.'); ?></td>
                                                                <td>$<?php echo number_format($row_product_in['valor'],0,',','.')." (-".(number_format(100-((($row_product_in['valor']/$row_product_in['cantidad'])/$row_product_in['valorProducto'])*100),1,',','.'))."%)"; ?></td>
                                                                <td>$<?php echo number_format($row_product_in['valorEmpleado'],0,',','.')." (".(number_format(($row_product_in['valorEmpleado']/$row_product_in['valor'])*100,1,',','.'))."%)"; ?></td>
                                                                <td>
                                                                <?php 
                                                                if ($porcenInList->idEstadoRecibo != 8) {
                                                                    echo "<a class='btn-saleitemdel' data-rel='".$row_product_in['idRegistroDetalle']."' data-rel2='2' href='#'><i class='glyphicon glyphicon-remove red'></i></a>";
                                                                } 
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($adicionalInList != NULL){ ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title" style="background-color: #E8E792; color: black;">
                                                <h2>Cargos Adicionales</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Nombre</th>
                                                            <th>Valor</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($adicionalInList as $row_adicional_in){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $row_adicional_in['idRegistroDetalle']; ?></th>
                                                                <td><?php echo $row_adicional_in['cargoEspecial']; ?></td>
                                                                <td>$<?php echo number_format($row_adicional_in['valor'],0,',','.'); ?></td>
                                                                <td>
                                                                <?php 
                                                                if ($porcenInList->idEstadoRecibo != 8) {
                                                                    echo "<a class='btn-saleitemdel' data-rel='".$row_adicional_in['idRegistroDetalle']."' data-rel2='3' href='#'><i class='glyphicon glyphicon-remove red'></i></a>";
                                                                } 
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--Ticket para Cocina-->
                            <center>
                                <?php
                                if ($this->config->item('tipo_negocio') == 1 || $this->config->item('tipo_negocio') == 2) {
                                    if ($porcenInList->idEstadoRecibo != 8){
                                        if (($serviceInList != NULL) || ($productInList != NULL) || ($adicionalInList != NULL)){
                                        ?>
                                        <form role="form" name="form_tick_sale" action="<?php echo base_url().'index.php/CSale/imprimeticketco'; ?>" method="post">
                                            <button type="submit" class="btn btn-warning btn-lg">
                                                <i class="glyphicon glyphicon-check glyphicon-white"></i>
                                                Imprimir Ticket de Cocina
                                            </button>
                                        </form> 
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </center>
                            <!--Fin: Ticket para Cocina-->    
                        </div>
                        <!--<center>
                            <p class="center-block download-buttons">
                                <a href="<?php //echo base_url() . 'index.php/CSale/canceldatasale'; ?>" class="btn btn-default btn-lg">
                                    <i class="glyphicon glyphicon-remove red"></i> Eliminar
                                </a>
                                <a href="<?php //echo base_url() . 'index.php/CSale/liquidasale'; ?>" class="btn btn-success btn-lg">
                                    <i class="glyphicon glyphicon-barcode glyphicon-white"></i> Liquidar
                                </a>
                            </p>
                        </center>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
        
        <!--Modal - Cliente-->
        <div class="modal fade" id="myModal-c" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-c" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_client_sale" action="<?php echo base_url() . 'index.php/CSale/addusersale'; ?>" method="post" onsubmit="document.getElementById('btn-click-client').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Cliente</h3>

                            <a class="btn-newcliente" href="#">
                                <i class="glyphicon glyphicon-plus-sign blue"></i>
                                Registrar Nuevo
                            </a>

                        </div>
                        <div class="modal-body">
                            <?php if ($this->session->userdata('sclient') != NULL) { ?>
                                <div class="alert alert-info">
                                    Esta venta tiene asociado el cliente Nro. Identificación: <?php echo $clientInList->idUsuario; ?>
                                </div>
                            <?php } ?>
                            <label class="control-label" for="select">Escriba parte del nombre y seleccione de la lista</label>
                            <div class="controls">
                                <input class="select2_single form-control" type="text" name="idcliente" id="idcliente" required="" autocomplete="off" />
                            </div>
                            <br />
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-client" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - empleado-->
        <div class="modal fade" id="myModal-em" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-em" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_empleado_sale" action="<?php echo base_url() . 'index.php/CSale/addempleadosale'; ?>" method="post" onsubmit="document.getElementById('btn-click-empl').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Empleado</h3>
                        </div>
                        <div class="modal-body">
                            <?php if ($this->session->userdata('sempleado') != NULL) { ?>
                                <div class="alert alert-info">
                                    Esta venta tiene asociado el Empleado Nro. Identificación: <?php echo $this->session->userdata('sempleado'); ?>
                                </div>
                            <?php } ?>
                            <label class="control-label" for="select">Seleccione el Empleado</label>
                            <div class="controls">
                                <select class="select2_single form-control" id="idempleadoventa" name="idempleadoventa" data-rel="chosen">
                                    <?php
                                    foreach ($list_empleado as $row_empleado) {
                                        ?>
                                        <option style="font-family: Arial; font-size: 16pt; background-color: #E0DD70; color: #000" value="<?php echo $row_empleado['idUsuario']; ?>" <?php if ($row_empleado['idUsuario'] == $this->session->userdata('sempleado')){ echo "selected"; }  ?>><?php echo $row_empleado['nombre_usuario'] . ' | ' . $row_empleado['idUsuario']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-empl" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - Servicio-->
        <div class="modal fade" id="myModal-s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-s" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_service_sale" action="<?php echo base_url() . 'index.php/CSale/addservicesale'; ?>" method="post" onsubmit="document.getElementById('btn-click-serv').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <?php if ($this->config->item('tipo_negocio') == 1) { ?>
                                <h3>Plato Fuerte</h3>
                            <?php } else { ?>
                                <h3>Producto Principal</h3>
                            <?php } ?>
                        </div>
                        <div class="modal-body">
                            <div class="controls">
                                <label class="control-label" for="select">Escriba parte del nombre y seleccione de la lista</label>
                                <div class="controls">
                                    <input class="select2_single form-control" type="text" name="idservice" id="idservice" required="" />
                                </div>
                                <br />
                            </div>
                            <!--<label class="control-label" for="selectError">Empleado</label>-->
                            <!--<div class="controls">
                                <select class="select2_single form-control" id="idempleado" name="idempleado" data-rel="chosen">
                                    <?php
                                    /*
                                    foreach ($list_empleado as $row_empleado) {
                                        ?>
                                        <option value="<?php echo $row_empleado['idUsuario']; ?>"><?php echo $row_empleado['idUsuario'] . ' | ' . $row_empleado['nombre_usuario']; ?></option>
                                        <?php
                                    }
                                     */
                                    ?>
                                </select>
                            </div>-->
                            <input type="hidden" class="form-control" id="idempleado_ser" name="idempleado" value="<?php echo $this->session->userdata('userid'); ?>">
                            <br />
                            <label class="control-label" for="selectError">Cantidad</label>
                            <div class="controls">
                                <select class="select2_single form-control" id="cantidad_ser" name="cantidad" data-rel="chosen">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <br />
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-serv" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - Producto Venta-->
        <div class="modal fade" id="myModal-p" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-p" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_product_sale" action="<?php echo base_url() . 'index.php/CSale/addproductsale'; ?>" method="post" onsubmit="document.getElementById('btn-click-prod').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <?php if ($this->config->item('tipo_negocio') == 1) { ?>
                                <h3>Producto</h3>
                            <?php } else { ?>
                                <?php if ($this->config->item('tipo_negocio') == 2) { ?>
                                    <h3>Otros Productos</h3>
                                <?php } else { ?>
                                    <h3>Artículos</h3>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="modal-body">
                            <div class="controls">
                                <label class="control-label" for="select">Escriba parte del nombre y seleccione de la lista</label>
                                <div class="controls">
                                    <input class="select2_single form-control" type="text" name="idproducto" id="idproducto" required="" autocomplete="off" />
                                </div>
                                <br />
                            </div>
                            <!--<label class="control-label" for="selectError">Empleado</label>-->
                            <!--<div class="controls">
                                <select class="select2_single form-control" id="idempleado" name="idempleado" data-rel="chosen">
                                    <?php
                                    /*
                                    foreach ($list_empleado as $row_empleado) {
                                        ?>
                                        <option value="<?php echo $row_empleado['idUsuario']; ?>"><?php echo $row_empleado['idUsuario'] . ' | ' . $row_empleado['nombre_usuario']; ?></option>
                                        <?php
                                    }
                                    */
                                    ?>
                                </select>
                            </div>-->
                            <input type="hidden" class="form-control" id="idempleado_pr" name="idempleado" value="<?php echo $this->session->userdata('userid'); ?>">
                            <br />
                            <label class="control-label" for="cantidad">Cantidad</label>
                            <select class="select2_single form-control" id="cantidad_pr" name="cantidad" data-rel="chosen">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <br />
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-prod" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - Cargo Adicional-->
        <div class="modal fade" id="myModal-esp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-esp" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_cargo_adc" action="<?php echo base_url() . 'index.php/CSale/addcargoadc'; ?>" method="post" onsubmit="document.getElementById('btn-click-adc').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Cargo Adicional</h3>
                        </div>
                        <div class="modal-body">
                            <label class="control-label" for="Interno">Descripción/Motivo</label>
                            <input type="text" class="form-control" id="motivo" name="motivo" onblur="this.value = this.value.toUpperCase()" required="" autocomplete="off" maxlength="60" >
                            <br />
                            <label class="control-label" for="valorCargo">Valor ($)</label>
                            <input type="tel" class="form-control" id="valorCargo" name="valorCargo" required="" autocomplete="off" pattern="\d*">
                            <!--<label class="control-label" for="porcentEmpleado">Porcentaje Empleado (%)</label>-->
                            <input type="hidden" class="form-control" id="porcentEmpleado" name="porcentEmpleado" value="0">
                            <!--<label class="control-label" for="selectError">Empleado</label>-->
                            <!--<div class="controls">
                                <select class="select2_single form-control" id="idempleado" name="idempleado" data-rel="chosen">
                                    <?php
                                    /*
                                    foreach ($list_empleado as $row_empleado) {
                                        ?>
                                        <option value="<?php echo $row_empleado['idUsuario']; ?>"><?php echo $row_empleado['idUsuario'] . ' | ' . $row_empleado['nombre_usuario']; ?></option>
                                        <?php
                                    }
                                     */
                                    ?>
                                </select>
                            </div>-->
                            <input type="hidden" class="form-control" id="idempleado" name="idempleado" value="<?php echo $this->session->userdata('userid'); ?>">
                            <br />
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-adc" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - Eliminar item-->
        <div class="modal fade" id="myModal-itemdel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-itemdel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_product_int" action="<?php echo base_url() . 'index.php/CSale/deletedetailsale'; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Eliminar Item de la Venta</h3>
                        </div>
                        <div class="modal-body">
                            <label class="control-label" for="Interno">Seleccione Motivo</label>
                            <div class="controls">
                                <select class="select2_single form-control" id="motivoanulaitem" name="motivoanulaitem" data-rel="chosen" style="font-size: 16px">
                                    <option value="ERROR_DIGITACION_CAJA">Error Digitacion Cajero</option>
                                    <!--<option value="ERROR_PEDIDO_MESERO">Error Pedido Mesero</option>-->
                                    <!--<option value="CLIENTE_DESISTE_ERROR_COCINA">Cliente Desiste Error Cocina</option>-->
                                    <option value="CLIENTE_CAMBIA_OPINION">Cliente Cambia Opinion</option>
                                    <!--<option value="CUENTAS_POR_SEPARADO">Cuentas por Separado</option>-->
                                    <!--<option value="CAMBIO_DE_MESA">Cambio de Mesa</option>-->
                                    <!--<option value="CORTESIAS">Cortesias</option>-->
                                    <option value="ERROR_SISTEMA">Error Sistema</option>
                                    <option value="CAMBIO_CLIENTE">Cambio de Cliente</option>
                                </select>
                            </div>
                            <br />
                            <?php if ($this->config->item('permiso_elim_item') == 1){ ?>
                                <label class="control-label" for="pass">Contraseña Administrador</label>
                                <input type="password" class="form-control" id="passadmin" name="passadmin" required="" style="font-size: 60px">
                                <br />
                            <?php } ?>
                            <input type="hidden" class="form-control" id="idregdetalle" name="idregdetalle">
                            <input type="hidden" class="form-control" id="typereg" name="typereg">
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" class="btn btn-primary">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - Descuento-->
        <div class="modal fade" id="myModal-desc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-desc" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php 
                    /*12/08/2019: Se agrego parametro para permitir modificaciones al rol Empleado cuando recibo ya este liquidado*/
                    if ($this->config->item('permiso_modif_recibo') == 0){
                        if ($porcenInList->idEstadoRecibo == 2){ 
                            $stateInput = "readonly";
                        } else {
                            $stateInput = "";
                        }
                    }
                    ?>
                    <form role="form" name="form_descuento" action="<?php echo base_url() . 'index.php/CSale/addporcentdesc'; ?>" method="post" onsubmit="document.getElementById('btn-click-desc').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Descuento manual</h3>
                        </div>
                        <div class="modal-body">
                            <?php 
                            /*Si el recibo esta liquidado y el perfil no es superadmin, no permite el cambio*/
                            /*
                             * 12/08/2019: Se agrego parametro para permitir modificaciones al rol Empleado cuando recibo ya este liquidado
                             */
                            if ($this->config->item('permiso_modif_recibo') == 0){
                                if (($porcenInList->idEstadoRecibo == 2) && $this->session->userdata('perfil') != 'SUPERADMIN') { 
                                    $stateInput = "readonly";
                                    $stateButton = "disabled";
                                    ?>
                                    <div class="alert alert-info">
                                        No se puede modificar. El recibo ya se encuentra liquidado.
                                    </div>
                                    <?php 
                                } else { 
                                    $stateInput = ""; 
                                }
                            }
                            ?>
                            <input type="hidden" id="subtotal_venta" name="subtotal_venta" value="<?php echo $subtotal; ?>" >
                            
                            <?php if ($this->config->item('tipo_negocio') == 1 || $this->config->item('tipo_negocio') == 2) { ?>
                                <label class="control-label" for="Porcentaje">Servicio Voluntario (%)</label>
                                <input type="tel" class="form-control" id="porcen_servicio" name="porcen_servicio" placeholder="% Servicio" value="<?php if ($porcenInList->porcenServicio == 0){ echo $this->config->item('procen_servicio'); } else { echo $porcenInList->porcenServicio*100; } ?>" required="" autocomplete="off" <?php echo $stateInput; ?> >
                                <br />
                                <label class="control-label" for="Porcentaje">Servicio Voluntario ($)</label>
                                <input type="tel" class="form-control" id="value_servicio" name="value_servicio" placeholder="$ Servicio" value="" required="" autocomplete="off" <?php echo $stateInput; ?> pattern="\d*">
                                <br />
                                <label class="control-label" for="Porcentaje">Descuento (%) *Solo aplicable a Plato Fuerte</label>
                                <input type="tel" class="form-control" id="procentaje" name="procentaje" placeholder="Descuento" value="<?php if ($porcenInList->porcenDescuento !== NULL){ echo $porcenInList->porcenDescuento*100; } else { echo 0; } ?>" required="" autocomplete="off" <?php echo $stateInput; ?> pattern="\d*">
                                <br />
                            <?php } else { ?>
                                <label class="control-label" for="Porcentaje">Descuento (%)</label>
                                <input type="tel" class="form-control" id="porcen_servicio" name="porcen_servicio" placeholder="% Porcentaje" value="<?php if ($porcenInList->porcenServicio == 0){ echo $this->config->item('procen_servicio'); } else { echo $porcenInList->porcenServicio*100; } ?>" required="" autocomplete="off" <?php echo $stateInput; ?> >
                                <br />
                                <label class="control-label" for="Porcentaje">Descuento ($)</label>
                                <input type="tel" class="form-control" id="value_servicio" name="value_servicio" placeholder="$ Valor" value="" required="" autocomplete="off" <?php echo $stateInput; ?> pattern="\d*">
    
                                <input type="hidden" class="form-control" id="procentaje" name="procentaje" placeholder="Descuento" value="<?php if ($porcenInList->porcenDescuento !== NULL){ echo $porcenInList->porcenDescuento*100; } else { echo 0; } ?>" required="" autocomplete="off" <?php echo $stateInput; ?> pattern="\d*">
                                <br />
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-desc" class="btn btn-primary" <?php echo $stateButton; ?>>Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal - Descuento Manual - Comisiones-->
        <div class="modal fade" id="myModal-descMan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-descMan" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php 
                    /*12/08/2019: Se agrego parametro para permitir modificaciones al rol Empleado cuando recibo ya este liquidado*/
                    if ($this->config->item('permiso_modif_recibo') == 0){
                        if ($porcenInList->idEstadoRecibo == 2){ 
                            $stateInput = "readonly";
                        } else {
                            $stateInput = "";
                        }
                    }
                    ?>
                    <form role="form" name="form_descuento_man" action="<?php echo base_url() . 'index.php/CSale/addporcentdescman'; ?>" method="post" onsubmit="document.getElementById('btn-click-desc').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Descuento manual</h3>
                        </div>
                        <div class="modal-body">
                            <?php 
                            /*Si el recibo esta liquidado y el perfil no es superadmin, no permite el cambio*/
                            /*
                             * 12/08/2019: Se agrego parametro para permitir modificaciones al rol Empleado cuando recibo ya este liquidado
                             */
                            if ($this->config->item('permiso_modif_recibo') == 0){
                                if (($porcenInList->idEstadoRecibo == 2) && $this->session->userdata('perfil') != 'SUPERADMIN') { 
                                    $stateInput = "readonly";
                                    $stateButton = "disabled";
                                    ?>
                                    <div class="alert alert-info">
                                        No se puede modificar. El recibo ya se encuentra liquidado.
                                    </div>
                                    <?php 
                                } else { 
                                    $stateInput = ""; 
                                }
                            }
                            ?>
                            <input type="hidden" id="subtotal_venta" name="subtotal_venta" value="<?php echo $subtotal; ?>" >
                            
                            <div class="controls">
                                <select class="select2_single form-control" id="idproductoventa" name="idproductoventa" data-rel="chosen">
                                    <?php
                                    if ($productInList != NULL){
                                        foreach ($productInList as $row_prod_inlist) {
                                            ?>
                                            <option style="font-family: Arial; font-size: 16pt; background-color: #E0DD70; color: #000" value="<?php echo $row_prod_inlist['idRegistroDetalle'].'|'.$row_prod_inlist['valor'].'|'.$row_prod_inlist['valorProducto'].'|'.$row_prod_inlist['valorEmpleado'].'|'.$row_prod_inlist['cantidad']; ?>" ><?php echo $row_prod_inlist['descProducto']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <br />
                            <label class="control-label" for="Porcentaje">Descuento para el Cliente ($)</label>
                            <input type="tel" class="form-control" style="font-family: Arial; font-size: 16pt; background-color: #E0DD70; color: #000" id="value_desct" name="value_desct" placeholder="$ Valor" value="" required="" autocomplete="off" <?php echo $stateInput; ?> >
                            <br />
                            <label class="control-label" for="Porcentaje">Comisión del Empleado (%)</label>
                            <div class="controls">
                                <select class="select2_single form-control" id="porcen_comm" name="porcen_comm" data-rel="chosen" style="font-size: 16px" <?php echo $stateInput; ?> >
                                    <option value="0">Ninguno</option>
                                    <option value="1.6">1.6%</option>
                                    <!--<option value="2">2%</option>-->
                                    <!--<option value="5">5%</option>-->
                                </select>
                            </div>
                            <!--<input type="tel" class="form-control" id="porcen_comm" name="porcen_comm" placeholder="% Porcentaje" value="" required="" autocomplete="off" <?php //echo $stateInput; ?> pattern="\d*" >-->
                            <br />
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <?php if ($productInList != NULL){ ?>
                            <button type="submit" id="btn-click-desc" class="btn btn-primary" <?php echo $stateButton; ?>>Agregar</button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal - Agregar Nuevo usuario Cliente -->
        <div class="modal fade" id="myModal-nc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-nc" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_user_cliente" action="<?php echo base_url() . 'index.php/CSale/adduser/cliente'; ?>" method="post" onsubmit="document.getElementById('btn-click-usu').disabled=true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Agregar Cliente</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="identificacion">Nro. Identificación</label>
                                <input type="number" class="form-control" id="identificacion" name="identificacion" placeholder="Documento Cliente" required="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="Nombre">Cliente</label>
                                <input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="nameclient" name="nameclient" placeholder="Nombres" required="" autocomplete="off">
                                <input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="lastnameclient" name="lastnameclient" placeholder="Apellidos" required="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="datoscontacto">Datos de Contacto</label>
                                <input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="direccion" name="direccion" placeholder="Direccion" autocomplete="off">
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="Telefono Celular" autocomplete="off">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electronico" autocomplete="off">
                                
                                <?php if ($this->config->item('bday_cliente') == 1) { ?>
                                <input type="number" class="form-control" id="diacumple" name="diacumple" placeholder="Dia Cumpleaños" min="1" max="31" required="" >
                                <select class="form-control" name="mescumple">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                                <?php } else { ?>
                                <input type="hidden" id="diacumple" name="diacumple" value="31">
                                <input type="hidden" id="mescumple" name="mescumple" value="12">
                                <?php } ?>

                                <?php if ($this->config->item('category_client') == 1) { ?>
                                <select class="form-control" name="cat_client">
                                     <option value="CLIENTE_FINAL">CLIENTE FINAL</option>
                                     <option value="GIMNASIO_ENTRENADOR">GIMNASIO / ENTRENADOR</option>
                                     <option value="MAYORISTA">MAYORISTA</option>
                                     <option value="SUPERMAYORISTA">SUPERMAYORISTA</option>
                                </select>
                                <?php } else { ?>
                                <input type="hidden" id="cat_client" name="cat_client" value="">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" id="btn-click-usu" class="btn btn-success">Guardar</button>
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
    <!-- Jquery Autonumeric -->
    <script src="https://cdn.jsdelivr.net/autonumeric/2.0.0/autoNumeric.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo base_url().'public/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js'; ?>"></script>
    <script>
    var clientes = [
        <?php foreach ($list_user as $row_user) { ?>
            { value: '<?php echo $row_user['nombre_usuario']." |".$row_user['idUsuario']." |".$row_user['numCelular']; ?>' },
        <?php } ?>
    ];
    $('#idcliente').autocomplete({
        lookup: clientes
    });
    
    var servicios = [
        <?php 
        if ($list_service != NULL){
            foreach ($list_service as $row_service) {
                if ($row_service['agotado'] < 1){
                    ?>
                    { value: '<?php echo $row_service['idServicio']." | ".$row_service['valorServicio']." | ".$row_service['descGrupoServicio']." | ".$row_service['descServicio']; ?>' },
                    <?php 
                }
            } 
        }
        ?>
    ];
    $('#idservice').autocomplete({
        lookup: servicios
    });
    
    var productos = [
        <?php 
        //Modulo de comision habilitado
        if ($this->config->item('mod_commision') == 1) {
        ?>
            <?php foreach ($list_product as $row_product) { ?>
                { value: '<?php echo $row_product['idProducto']." | ".$row_product['valorProducto']." | ".$row_product['valorDescProd']." | ".$row_product['valorEmpleado']." | ".$row_product['descProducto']; ?>' },
            <?php } ?>
            <?php //echo $row_product['idProducto']." | ".$row_product['valorProducto']." | ".$row_product['descGrupoServicio']." | ".$row_product['descProducto'] ?>
        <?php 
        }
        ?>
        <?php 
        //Modulo de comision deshabilitado
        if ($this->config->item('mod_commision') == 0) {
        ?>
            <?php foreach ($list_product as $row_product) { ?>
                { value: '<?php echo $row_product['idProducto']." | ".$row_product['valorProducto']." | ".$row_product['descProducto']." | ".$row_product['descGrupoServicio']; ?>' },
            <?php } ?>
        <?php 
        }
        ?>
    ];
    $('#idproducto').autocomplete({
        lookup: productos
    });
    
     

    $(function() {

        var lastModal = '<?php echo $loadModal; ?>';
        if (lastModal == 1){ /*Modal de Servicio/Plato Fuerte*/
            $('#myModal-s').on("shown.bs.modal", function() {
                $('#idservice').focus();
            });

            $( "#myModal-s" ).modal('show');
        } 

        if (lastModal == 2) { /*Modal de Producto*/
            $('#myModal-p').on("shown.bs.modal", function() {
                $('#idproducto').focus();
            });

            $( "#myModal-p" ).modal('show');
        }
    });

    /*AutoNumeric*/
    $("#value_desct").autoNumeric('init',{
        allowDecimalPadding : "false",
        decimalCharacter : ',',
        digitGroupSeparator : '.',
    });
    </script>
    
  </body>
</html>
