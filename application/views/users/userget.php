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
    
    <!-- iCheck -->
    <link href="<?php echo base_url().'public/gentelella/vendors/iCheck/skins/flat/green.css'; ?>" rel="stylesheet">
    
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
                        <h3>Usuarios</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div></div>
                                <?php if ($data_user->descTipoUsuario == 'Cliente') { ?>
                                    <?php if ($this->config->item('referidos') == 1) { ?>
                                        <?php if ($this->MRecurso->validaRecurso(3)){ /*Agregar referido*/ ?>
                                        <span class="input-group-btn">
                                            <a class="btn btn-success btn-cliente" href="#"><i class="glyphicon glyphicon-plus"></i> Agregar Referido</a>
                                        </span>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
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
                                <h2>Actualizar Usuario [ID:<?php echo $data_user->idUsuario; ?>]</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <!--Formulario-->
                                <form role="form" name="form_usuario" action="<?php echo base_url().'index.php/CUser/upduser'; ?>" method="post" autocomplete="off">
                                    <div class="modal-body">
                                        <?php if ($data_user->idTipoUsuario == 1){ ?>
                                        <div class="form-group">
                                            <label for="Sede">Sede</label>
                                            <!--<a href="#" class="label label-danger" data-toggle="tooltip" data-placement="right" title="Si va a cambiar la sede del empleado se recomienda primero validar si este tiene Citas Reservadas en otra sede ya que podria afectar la atención del servicio cuando el cliente se presente." >Importante</a>-->
                                            <select class="form-control" name="sede">
                                                <?php
                                                foreach ($data_sede as $row_sede){
                                                    if ($data_user->idSede == $row_sede['idSede']){
                                                        ?>
                                                        <option value="<?php echo $row_sede['idSede']; ?>" selected="" ><?php echo $row_sede['nombreSede']; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $row_sede['idSede']; ?>"><?php echo $row_sede['nombreSede']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="Nombre">Usuario</label>
                                            <input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="nameclient" name="nameuser" placeholder="Nombres" value="<?php echo $data_user->nombre; ?>" maxlength="90" required="">
                                            <input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="lastnameclient" name="lastnameuser" placeholder="Apellidos" value="<?php echo $data_user->apellido; ?>" maxlength="90" required="">
                                        </div>
                                        <div class="form-group">
                                            <strong>Dirección</strong><input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="direccion" name="direccion" value="<?php echo $data_user->direccion; ?>" placeholder="Direccion" maxlength="90" ><br />
                                            <strong>Telefono</strong><input type="text" class="form-control" id="celular" name="celular" value="<?php echo $data_user->numCelular; ?>" placeholder="Telefono Fijo/Celular" maxlength="35" ><br />
                                            <strong>Email</strong><input type="email" class="form-control" id="email" name="email" value="<?php echo $data_user->email; ?>" placeholder="Correo Electronico" maxlength="40" ><br />
                                            <?php if ($this->config->item('bday_cliente') == 1) { ?>
                                            <strong>Fecha Cumpleaños</strong><input type="text" class="form-control" id="fechacumple" name="fechacumple" value="<?php echo $data_user->dia.' del Mes '.$data_user->mes; ?>" disabled="" >
                                            <?php } ?>
                                            <?php 
                                            /*Tiene habilitada funcionalidad de Categoria del Cliente, y el tipo de usuario es 2-cliente*/
                                            if ($this->config->item('category_client') == 1 && $data_user->idTipoUsuario == 2) { 
                                            ?> 
                                            <strong>Categoria</strong><input type="text" class="form-control" id="fechacumple" name="fechacumple" value="<?php echo $data_user->dia.' del Mes '.$data_user->mes; ?>" disabled="" >
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipousuario">Tipo</label>
                                            <input type="text" class="form-control" id="tipousuario" name="tipousuario" value="<?php echo $data_user->descTipoUsuario; ?>" disabled="">
                                        </div>
                                        <div class="form-group">
                                            <label for="rol">Rol</label>
                                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $data_user->descRol.' ['.$data_user->permisos.']'; ?>" disabled="">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <a href="#" class="label label-info" data-toggle="tooltip" data-placement="right" title="Minimo 1 letra mayúscula, 1 letra minúscula, al menos un número y la longitud debe ser minimo 8 caracteres. Ej: Freya1234" >Info</a>
                                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Nueva Clave de Acceso" >
                                            <label>
                                                <input type="checkbox" name="restorepass" value="1" >Restablecer Contraseña
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <?php 
                                            if ($data_user->activo == 'S') { 
                                                $check = 'checked'; 
                                            } else {
                                                $check = ''; 
                                            }
                                            ?>
                                            <label>
                                                Activo
                                              <input type="checkbox" class="flat" name="estado" <?php echo $check; ?> >
                                            </label>
                                        </div>
                                        <input type="hidden" class="form-control" id="identificacion" name="identificacion" value="<?php echo $data_user->idUsuario; ?>" >
                                        <input type="hidden" class="form-control" id="tipouser" name="tipouser" value="<?php echo $data_user->idTipoUsuario; ?>" >
                                        <input type="hidden" class="form-control" id="idrol" name="idrol" value="<?php echo $data_user->idRol; ?>" >
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo base_url().'index.php/CUser'; ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                                <!--/Formulario-->
                                
                                <!--Tabla Referidos-->
                                <?php if ($this->config->item('referidos') == 1) { ?>
                                    <?php if ($data_user->idTipoUsuario == 2){ ?>
                                    <br />
                                    <hr />
                                    <label for="Referidos">REFERIDOS</label>
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                            <th>Referido</th>
                                            <th>DiaCumple</th>
                                            <th>MesCumple</th>
                                            <th>AnoNace</th>
                                            <th>Parentesco</th>
                                            <th>Tallas</th>
                                            <th>Acción</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data_ref != FALSE) {
                                                foreach ($data_ref as $row_ref){
                                                    ?>
                                                    <tr>
                                                        <td class="center"><?php echo $row_ref['nombreReferido']; ?></td>
                                                        <td class="center"><?php echo $row_ref['diaCumple']; ?></td>
                                                        <td class="center"><?php echo $row_ref['mesCumple']; ?></td>
                                                        <td class="center"><?php echo $row_ref['anoNace']; ?></td>
                                                        <td class="center"><?php echo $row_ref['parentesco']; ?></td>
                                                        <td class="center small"><pre><?php echo $row_ref['observacion']; ?></pre></td>
                                                        <td class="center">
                                                            <a class="btn btn-default btn-sm" href="<?php echo base_url().'index.php/CUser/delreferido/'.$row_ref['idReferido']; ?>">
                                                                <i class="glyphicon glyphicon-erase"></i>
                                                                Eliminar
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php } ?>
                                <?php } ?>
                                <!--/Tabla Referidos-->
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /page content -->
        
        <!--Modal - Agregar Referido-->
        <div class="modal fade" id="myModal-c" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-c" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" name="form_ref_cliente" action="<?php echo base_url().'index.php/CUser/addreferido'; ?>" method="post" autocomplete="off">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Agregar Referido</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Nombre">Nombre del Referido</label>
                                <input type="text" class="form-control" onblur="this.value = this.value.toUpperCase()" id="nameref" name="nameref" placeholder="Nombres y Apellidos" maxlength="120" required="">
                            </div>
                            <div class="form-group">
                                <label for="datoscumple">Datos de Cumpleaños</label>
                                <select class="form-control" name="diacumpleref">
                                     <option value="1">01</option>
                                     <option value="2">02</option>
                                     <option value="3">03</option>
                                     <option value="4">04</option>
                                     <option value="5">05</option>
                                     <option value="6">06</option>
                                     <option value="7">07</option>
                                     <option value="8">08</option>
                                     <option value="9">09</option>
                                     <option value="10">10</option>
                                     <option value="11">11</option>
                                     <option value="12">12</option>
                                     <option value="13">13</option>
                                     <option value="14">14</option>
                                     <option value="15">15</option>
                                     <option value="16">16</option>
                                     <option value="17">17</option>
                                     <option value="18">18</option>
                                     <option value="19">19</option>
                                     <option value="20">20</option>
                                     <option value="21">21</option>
                                     <option value="22">22</option>
                                     <option value="23">23</option>
                                     <option value="24">24</option>
                                     <option value="25">25</option>
                                     <option value="26">26</option>
                                     <option value="27">27</option>
                                     <option value="28">28</option>
                                     <option value="29">29</option>
                                     <option value="30">30</option>
                                     <option value="31">31</option>
                                </select>
                                <select class="form-control" name="mescumpleref">
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
                                <select class="form-control" name="anonaceref">
                                     <option value="2005">2005</option>
                                     <option value="2006">2006</option>
                                     <option value="2007">2007</option>
                                     <option value="2008">2008</option>
                                     <option value="2009">2009</option>
                                     <option value="2010">2010</option>
                                     <option value="2011">2011</option>
                                     <option value="2012">2012</option>
                                     <option value="2013">2013</option>
                                     <option value="2014">2014</option>
                                     <option value="2015">2015</option>
                                     <option value="2016">2016</option>
                                     <option value="2017">2017</option>
                                     <option value="2018">2018</option>
                                     <option value="2019">2019</option>
                                     <option value="2020">2020</option>
                                     <option value="2021">2021</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Parentesco">Parentesco</label>
                                <select class="form-control" name="parentescoref">
                                     <option value="HIJO">HIJO(A)</option>
                                     <option value="SOBRINO">SOBRINO(A)</option>
                                     <option value="PRIMO">PRIMO(A)</option>
                                     <option value="NIETO">NIETO(A)</option>
                                     <option value="AHIJADO">AHIJADO(A)</option>
                                     <option value="OTRO" selected="">OTRO</option>
                                </select>
                                <input type="hidden" id="clientref" name="clientref" value="<?php echo $data_user->idUsuario; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="Observ">Medidas</label>
                                <textarea class="form-control" onblur="this.value = this.value.toUpperCase()" id="observRef" name="observRef" placeholder="Especifique las tallas" maxlength="300" cols="40" rows="5" >
Estatura (cm):
Contorno Pecho (cm):
Contorno Cintura (cm):
Cadera (cm):
Largo Pantalón (cm):
                                </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/Modal-->
        
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
    
    <!-- iCheck -->
    <script src="<?php echo base_url().'public/gentelella/vendors/iCheck/icheck.min.js'; ?>"></script>
    
  </body>
</html>
