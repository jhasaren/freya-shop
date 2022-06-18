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
        <link href="<?php echo base_url() . 'public/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css'; ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <!--<link href="<?php // echo base_url().'public/gentelella/vendors/font-awesome/css/font-awesome.min.css';  ?>" rel="stylesheet">-->
        <!-- NProgress -->
        <!--<link href="<?php // echo base_url().'public/gentelella/vendors/nprogress/nprogress.css';  ?>" rel="stylesheet">-->
        <!-- Custom Theme Style -->
        <!--<link href="<?php // echo base_url().'public/gentelella/build/css/custom.min.css';  ?>" rel="stylesheet">-->

        <link rel="shortcut icon" href="<?php echo base_url() . 'public/img/favicon.ico'; ?>">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <!--<div class="title_left">
                                <h3>Venta ID:<?php //echo $venta; ?></h3>
                            </div>-->
                            
                            <!--Encabezado-->
                            <table style="border-collapse: collapse; width: 100%;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 25%;">
                                            <img src="<?php echo base_url() . 'public/img/logo_ccobro.jpg'; ?>" width="160" >
                                        </td>
                                        <td style="width: 50%; padding-left: 5%">
                                            <p>
                                                <span style="font-weight: bold; font-size: 20px; color: #000000">Body Power Colombia</span> <br />
                                                <!--<span style="font-weight: 400;">German Escobar</span> <br />-->
                                                <span style="font-weight: 400;">Cra 36 #30-41</span><br />
                                                <span style="font-weight: 400;">Cali - Valle del Cauca - Colombia</span>
                                            </p>
                                        </td>
                                        <td style="width: 25%;">
                                            <center>
                                                <span style="font-weight: 400;">Factura de Venta</span><br />
                                                <span style="font-weight: bold; font-size: 24px"><?php echo $recibo; ?></span>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--/Encabezado-->

                            <br />
                            
                            <!--Cliente-->
                            <table style="border-collapse: collapse; width: 100%;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 60%; background-color: #e7e8ea; padding-left: 2%; padding-top: 2%; padding-bottom: 2%;">
                                            <p>
                                                <span style="font-weight: bold;">Datos Cliente:</span><br />
                                                <span style="font-weight: 400;"><?php echo $general->personaCliente; ?></span><br />
                                                <span style="font-weight: 400;">Identificación: <?php echo $general->idUsuarioCliente; ?></span><br />
                                                <span style="font-weight: 400;">Tel: <?php echo $general->tel_cliente; ?></span>
                                            </p>
                                        </td>
                                        <td style="width: 40%; padding-left: 5%; padding-top: 2%; padding-bottom: 2%;">
                                            <p>
                                                <span style="font-weight: 400;">info@bodypowercol.com</span><br />
                                                <strong>Liquida</strong><span style="font-weight: 400;">: <?php echo $general->fechaLiquida; ?></span><br />
                                                <strong>Pago</strong><span style="font-weight: 400;">: <?php echo date('Y-m-d'); ?></span><br />
                                                <strong>Estado</strong><span style="font-weight: 400;">: <?php echo $general->descEstadoRecibo; ?></span><br />
                                                <strong>Ciudad</strong><span style="font-weight: 400;">: CALI - VALLE</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--/Cliente-->
                            
                            <br />

                            <!--Detalle Venta-->
                            <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                    <tr style="background-color: #FFFFFF;">
                                        <td style="width: 55%;">Item</td>
                                        <td style="width: 15%;">Precio</td>
                                        <td style="width: 15%;">Cantidad</td>
                                        <td style="width: 15%;">Total</td>
                                    </tr>
                                        
                                        <!--Productos / Articulos-->
                                        <?php
                                        if ($productos == NULL) {
                                            ?>
                                            <tr>
                                                <td style="width: 55%;">-</td>
                                                <td style="width: 15%;">-</td>
                                                <td style="width: 15%;">-</td>
                                                <td style="width: 15%;">-</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($productos as $valueProd) {
                                                ?>
                                                <tr>
                                                    <td style="width: 55%;"><?php echo $valueProd['descProducto']; ?></td>
                                                    <td style="width: 15%;"><?php echo "$".number_format($valueProd['valor']/$valueProd['cantidad'], 0, ',', '.'); ?></td>
                                                    <td style="width: 15%;"><?php echo $valueProd['cantidad']; ?></td>
                                                    <td style="width: 15%;"><?php echo "$".number_format($valueProd['valor'], 0, ',', '.'); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--END Productos / Articulos-->
                                        
                                        <!--Adicionales-->
                                        <?php
                                        if ($adicional == NULL) {
                                            ?>
                                            <tr>
                                                <td style="width: 55%;">-</td>
                                                <td style="width: 15%;">-</td>
                                                <td style="width: 15%;">-</td>
                                                <td style="width: 15%;">-</td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($adicional as $valueAdic) {
                                                ?>
                                                <tr>
                                                    <td style="width: 55%;"><?php echo $valueAdic['cargoEspecial']; ?></td>
                                                    <td style="width: 15%;"><?php echo "-"; ?></td>
                                                    <td style="width: 15%;"><?php echo "-"; ?></td>
                                                    <td style="width: 15%;"><?php echo "$".number_format($valueAdic['valor'], 0, ',', '.'); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--END Adicionales-->
                                        
                                </tbody>
                            </table>
                            <!--/Detalle Venta-->
                            
                            <br /><br />
                            
                            <!--Total Venta-->
                            <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                                <tbody>
                                    <?php
                                    if ($formaPago != NULL){
                                        foreach ($formaPago  as $valueFormPay){
                                            $pagado = $pagado + $valueFormPay['valorPago'];
                                        }
                                    }
                                    ?>
                                    <tr style="height: 18px;">
                                        <td style="width: 70%; height: 18px;"></td>
                                        <td style="width: 15%; height: 18px;">Abono</td>
                                        <td style="width: 15%; height: 18px;"><?php echo "$".number_format($pagado, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 70%; height: 18px;"></td>
                                        <td style="width: 15%; height: 18px;">Descuento</td>
                                        <td style="width: 15%; height: 18px;"><?php echo "$".number_format($general->valorTotalVenta - ($general->valorLiquida), 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 70%; height: 18px;"></td>
                                        <td style="width: 15%; height: 18px;">Subtotal2</td>
                                        <td style="width: 15%; height: 18px;"><?php echo "$".number_format($general->valorLiquida, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 70%; height: 18px;"></td>
                                        <td style="width: 15%; height: 18px;">IVA (0%)</td>
                                        <td style="width: 15%; height: 18px;">$0</td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 70%; height: 18px;">Distribuidor Oficial <span style="font-weight: bold;">productos y suplementos deportivos.</span></td>
                                        <td style="width: 15%; height: 18px; font-weight: bold; font-size: 14px; background-color: #cccccc">TOTAL</td>
                                        <td style="width: 15%; height: 18px; font-size: 14px; background-color: #cccccc"><?php echo "$".number_format($general->valorLiquida + ($general->valorLiquida * $general->porcenServicio), 0, ',', '.'); ?> CO</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--/Total Venta-->

                            <br />
                            <hr />
                            <br />
                            
                            <!--Firma-->
                            <!--
                            <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                <tbody>
                                    <tr style="height: 18px;">
                                        <td style="width: 50%; height: 18px; padding-left: 10%;">
                                            <p>
                                                <img src="<?php //echo base_url() . 'public/img/firma_digital.jpg'; ?>" width="140" ><br />
                                                <span style="font-weight: bold;">German Escobar</span><br />
                                                <span style="font-weight: 400;">1.112.462.813</span><br />
                                                <span style="font-weight: 400;">Direcci&oacute;n: Cra 42 #28a-82 Villas del Sur</span><br />
                                                <span style="font-weight: 400;">Tel: (+57)3160435994</span><br />
                                                <span style="font-weight: 400;">www.bodypowercol.com</span><br />
                                            </p>
                                        </td>
                                        <td style="width: 50%; height: 18px; text-align: center">
                                            <img src="<?php //echo base_url() . 'public/img/qr_clinktree.jpg'; ?>" width="140" ><br />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            -->
                            <!--/Firma-->
                        </div>
                    </div>
                </div>
                <!-- /page content -->
            </div>
        </div>


    </body>
</html>
