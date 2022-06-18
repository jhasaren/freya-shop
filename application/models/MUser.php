<?php
/**************************************************************************
* Nombre de la Clase: MUser
* Descripcion: Es el Modelo para las interacciones en BD del modulo Usuarios
* Autor: jhonalexander90@gmail.com
* Fecha Creacion: 24/03/2017
**************************************************************************/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MUser extends CI_Model {

    public function __construct() {
        
        /*instancia la clase de conexion a la BD para este modelo*/
        parent::__construct();
        $this->load->driver('cache'); /*Carga cache*/
        $this->db->query("SET time_zone='-5:00'");
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: list_users
     * Descripcion: Obtiene todos los usuarios creados (administrador)
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 24/03/2017, Ultima modificacion: 
     **************************************************************************/
    public function list_users() {
        
        $dataCache = $this->cache->memcached->get('mListusers');
        
        if ($dataCache){
            
            $this->cache->memcached->save('memcached5', 'cache', 30);
            return $dataCache;
            
        } else {
        
            /*Recupera los usuarios creados*/
            $query = $this->db->query("SELECT
                                    a.idUsuario,
                                    concat(a.nombre,' ',a.apellido) as nombre_usuario,
                                    t.descTipoUsuario,
                                    a.idTipoUsuario,
                                    a.numCelular,
                                    a.activo,
                                    tpr.descTipoProveedor,
                                    a.categoria
                                    FROM
                                    app_usuarios a
                                    JOIN tipo_usuario t ON t.idTipoUsuario = a.idTipoUsuario
                                    LEFT JOIN usuario_tipo_proveedor tp ON tp.idUsuario = a.idUsuario
                                    LEFT JOIN tipo_proveedor tpr ON tpr.idTipoProveedor = tp.idTipoProveedor");

            $this->cache->memcached->save('mListusers', $query->result_array(), 28800); /*8 horas en Memoria*/
            $this->cache->memcached->save('memcached5', 'real', 30);
            
            if ($query->num_rows() == 0) {

                return false;

            } else {

                return $query->result_array();

            }
        }
    }

    /**************************************************************************
     * Nombre del Metodo: list_users_empl
     * Descripcion: Obtiene todos los usuarios creados (empleados), no lista usuarios administradores
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 29/05/2022, Ultima modificacion: 
     **************************************************************************/
    public function list_users_empl() {
        
        $dataCache = $this->cache->memcached->get('mListusers');
        
        if ($dataCache){
            
            $this->cache->memcached->save('memcached5', 'cache', 30);
            return $dataCache;
            
        } else {
        
            /*Recupera los usuarios creados*/
            $query = $this->db->query("SELECT
                                    a.idUsuario,
                                    concat(a.nombre,' ',a.apellido) as nombre_usuario,
                                    t.descTipoUsuario,
                                    a.idTipoUsuario,
                                    a.numCelular,
                                    a.activo,
                                    tpr.descTipoProveedor,
                                    a.categoria
                                    FROM
                                    app_usuarios a
                                    JOIN tipo_usuario t ON t.idTipoUsuario = a.idTipoUsuario
                                    LEFT JOIN usuario_tipo_proveedor tp ON tp.idUsuario = a.idUsuario
                                    LEFT JOIN tipo_proveedor tpr ON tpr.idTipoProveedor = tp.idTipoProveedor
                                    LEFT JOIN usuario_acceso us ON us.idUsuario = a.idUsuario
                                    WHERE
                                    us.idRol <> 1");

            $this->cache->memcached->save('mListusers', $query->result_array(), 28800); /*8 horas en Memoria*/
            $this->cache->memcached->save('memcached5', 'real', 30);
            
            if ($query->num_rows() == 0) {

                return false;

            } else {

                return $query->result_array();

            }
        }
    }
    
    /**************************************************************************
     * Nombre del Metodo: cantidad_empleados
     * Descripcion: Obtiene la cantidad de empleados registrados activos en todas
     * las sedes.
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 12/05/2017, Ultima modificacion: 
     **************************************************************************/
    public function cantidad_empleados() {
        
        /*Recupera los empleados creados*/
        $query = $this->db->query("SELECT
                                    count(1) as cantidadEmpleados
                                    FROM
                                    app_usuarios
                                    WHERE
                                    idTipoUsuario = 1
                                    AND activo = 'S'");
        
        return $query->row();
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: verify_user
     * Descripcion: Valida si un usuario existe y recupera su estado actual
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 26/03/2017, Ultima modificacion: 
     **************************************************************************/
    public function verify_user($idusuario) {
        
        /*Recupera el esatdo de un usuario*/
        $query = $this->db->query("SELECT
                                a.idUsuario,
                                a.activo
                                FROM
                                app_usuarios a
                                WHERE
                                a.idUsuario = '".$idusuario."'");
        
        if ($query->num_rows() == 0) {
            
            return false;
            
        } else {
            
            return $query->row();
            
        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: get_user
     * Descripcion: Obtiene un usuario creado
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 25/03/2017, Ultima modificacion: 
     **************************************************************************/
    public function get_user($user) {
        
        /*Recupera los usuarios creados*/
        $query = $this->db->query("SELECT
                                a.idUsuario,
                                a.nombre,
                                a.apellido,
                                a.numCelular,
                                a.direccion,
                                a.email,
                                a.activo,
                                a.idTipoUsuario,
                                t.descTipoUsuario,
                                f.dia,
                                f.mes,
                                u.idRol,
                                r.descRol,
                                a.idSede,
                                s.nombreSede,
                                a.categoria
                                FROM app_usuarios a
                                JOIN tipo_usuario t ON t.idTipoUsuario = a.idTipoUsuario
                                JOIN fecha_cumple_usuario f ON f.idUsuario = a.idUsuario
                                LEFT JOIN usuario_acceso u ON u.idUsuario = a.idUsuario
                                LEFT JOIN roles r ON r.idRol = u.idRol
                                LEFT JOIN sede s ON s.idSede = a.idSede
                                WHERE a.idUsuario = ".$user."");
        
        if ($query->num_rows() == 0) {
            
            return false;
            
        } else {
            
            return $query->row();
            
        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: get_referidos
     * Descripcion: Obtiene un los referidos de un usuario cliente
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 07/03/2021, Ultima modificacion: 
     **************************************************************************/
    public function get_referidos($user) {
        
        /*Recupera los referidos activos para el usuario Cliente*/
        $query = $this->db->query("SELECT
                                r.idReferido,
                                r.nombreReferido,
                                r.diaCumple,
                                r.mesCumple,
                                r.anoNace,
                                r.activo,
                                r.parentesco,
                                r.observacion
                                FROM referidos_usuario r
                                WHERE
                                r.idUsuario = '".$user."'
                                AND r.activo = 'S'");
        
        if ($query->num_rows() == 0) {
            
            return false;
            
        } else {
            
            return $query->result_array();
            
        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: list_roles
     * Descripcion: Obtiene todos los roles creados
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 24/03/2017, Ultima modificacion: 
     **************************************************************************/
    public function list_roles() {
        
        $dataCache = $this->cache->memcached->get('mListroles');
        
        if ($dataCache){
            
            $this->cache->memcached->save('memcached6', 'cache', 30);
            return $dataCache;
            
        } else {
        
            /*Recupera los grupos creados*/
            $query = $this->db->query("SELECT
                                    idRol,
                                    descRol
                                    FROM
                                    roles
                                    WHERE idRol IN (1,2)
                                    ORDER BY 1 DESC");
            
            $this->cache->memcached->save('mListroles', $query->result_array(), 28800); /*8 horas en Memoria*/
            $this->cache->memcached->save('memcached6', 'real', 30);

            if ($query->num_rows() == 0) {

                return false;

            } else {

                return $query->result_array();

            }
        }
    }
    
    /**************************************************************************
     * Nombre del Metodo: list_sedes
     * Descripcion: Obtiene todas las sedes creadas
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 18/04/2017, Ultima modificacion: 
     **************************************************************************/
    public function list_sedes() {
        
        $dataCache = $this->cache->memcached->get('mListsedes');
        
        if ($dataCache){
            
            $this->cache->memcached->save('memcached7', 'cache', 30);
            return $dataCache;
            
        } else {
            
            /*Recupera las sedes creadas*/
            $query = $this->db->query("SELECT
                                    idSede,
                                    nombreSede,
                                    horario
                                    FROM sede
                                    WHERE activa = 'S'");

            $this->cache->memcached->save('mListsedes', $query->result_array(), 28800); /*8 horas en Memoria*/
            $this->cache->memcached->save('memcached7', 'real', 30);
            
            if ($query->num_rows() == 0) {

                return false;

            } else {

                return $query->result_array();

            }
        }
    }
    
    
    /**************************************************************************
     * Nombre del Metodo: list_tproveedor
     * Descripcion: Obtiene los tipos de proveedor creados
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 10/02/2018, Ultima modificacion: 
     **************************************************************************/
    public function list_tproveedor() {
        
        $dataCache = $this->cache->memcached->get('mTypeProveedor');
        
        if ($dataCache){
            
            $this->cache->memcached->save('memcached8', 'cache', 30);
            return $dataCache;
            
        } else {
        
            /*Recupera los grupos creados*/
            $query = $this->db->query("SELECT
                                    idTipoProveedor,
                                    descTipoProveedor 
                                    FROM tipo_proveedor
                                    ORDER BY 2 ASC");
            
            $this->cache->memcached->save('mTypeProveedor', $query->result_array(), 28800); /*8 horas en Memoria*/
            $this->cache->memcached->save('memcached8', 'real', 30);

            if ($query->num_rows() == 0) {

                return false;

            } else {

                return $query->result_array();

            }
        }
    }
    
    
    /**************************************************************************
     * Nombre del Metodo: create_user
     * Descripcion: Registra un Usuario Cliente/Empleado en BD
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 24/03/2017, Ultima modificacion: 
     **************************************************************************/
    public function create_user($name,$lastname,$identificacion,$direccion,$celular,$email,$tipo,$diacumple,$mescumple,$contrasena,$rol,$sede,$horario,$tproveedor,$categoria) {
            
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query1 = $this->db->query("INSERT INTO
                                    app_usuarios (
                                    idTipoDocumento,
                                    idUsuario,
                                    nombre,
                                    apellido,
                                    numCelular,
                                    direccion,
                                    email,
                                    idTipoUsuario,
                                    activo,
                                    fechaRegistro,
                                    idSede,
                                    categoria
                                    ) VALUES (
                                    1,
                                    ".$identificacion.",
                                    '".$name."',
                                    '".$lastname."',
                                    '".$celular."',
                                    '".$direccion."',
                                    '".$email."',
                                    ".$tipo.",
                                    'S',
                                    NOW(),
                                    '".$sede."',
                                    '".$categoria."'
                                    )");

        $query2 = $this->db->query("INSERT INTO
                                    fecha_cumple_usuario (
                                    idUsuario,
                                    dia,
                                    mes
                                    ) VALUES (
                                    ".$identificacion.",
                                    ".$diacumple.",
                                    ".$mescumple."
                                    )");

        $query3 = $this->db->query("INSERT INTO
                                    usuario_acceso (
                                    idUsuario,
                                    claveAcceso,
                                    idRol
                                    ) VALUES (
                                    ".$identificacion.",
                                    '".sha1($contrasena)."',
                                    ".$rol."
                                    )");
        
        if ($tipo == 3){ //Proveedor
            
            $query4 = $this->db->query("INSERT INTO
                                        usuario_tipo_proveedor (
                                        idUsuario,
                                        idTipoProveedor
                                        ) VALUES (
                                        ".$identificacion.",
                                        '".$tproveedor."'
                                        )");
            
        }
        
        $this->db->trans_complete();
        $this->db->trans_off();

        if ($this->db->trans_status() === FALSE){

            return false;

        } else {

            if ($tipo == 1){ //Empleado
            
                /*Obtiene Horario de la Sede*/
                $data = file_get_contents(base_url().'public/bower_components/horario/'.$horario.'');
                $horarios = json_decode($data, true);

                $lunes['horaIni'] = $horarios['sede1']['lunes']['entrada'];
                $lunes['horaFin'] = $horarios['sede1']['lunes']['salida'];
                $lunes['horaIniAlm'] = $horarios['sede1']['lunes']['inicioAlmuerzo'];
                $lunes['horaFinAlm'] = $horarios['sede1']['lunes']['finAlmuerzo'];

                $martes['horaIni'] = $horarios['sede1']['martes']['entrada'];
                $martes['horaFin'] = $horarios['sede1']['martes']['salida'];
                $martes['horaIniAlm'] = $horarios['sede1']['martes']['inicioAlmuerzo'];
                $martes['horaFinAlm'] = $horarios['sede1']['martes']['finAlmuerzo'];

                $miercoles['horaIni'] = $horarios['sede1']['miercoles']['entrada'];
                $miercoles['horaFin'] = $horarios['sede1']['miercoles']['salida'];
                $miercoles['horaIniAlm'] = $horarios['sede1']['miercoles']['inicioAlmuerzo'];
                $miercoles['horaFinAlm'] = $horarios['sede1']['miercoles']['finAlmuerzo'];

                $jueves['horaIni'] = $horarios['sede1']['jueves']['entrada'];
                $jueves['horaFin'] = $horarios['sede1']['jueves']['salida'];
                $jueves['horaIniAlm'] = $horarios['sede1']['jueves']['inicioAlmuerzo'];
                $jueves['horaFinAlm'] = $horarios['sede1']['jueves']['finAlmuerzo'];

                $viernes['horaIni'] = $horarios['sede1']['viernes']['entrada'];
                $viernes['horaFin'] = $horarios['sede1']['viernes']['salida'];
                $viernes['horaIniAlm'] = $horarios['sede1']['viernes']['inicioAlmuerzo'];
                $viernes['horaFinAlm'] = $horarios['sede1']['viernes']['finAlmuerzo'];

                $sabado['horaIni'] = $horarios['sede1']['sabado']['entrada'];
                $sabado['horaFin'] = $horarios['sede1']['sabado']['salida'];
                $sabado['horaIniAlm'] = $horarios['sede1']['sabado']['inicioAlmuerzo'];
                $sabado['horaFinAlm'] = $horarios['sede1']['sabado']['finAlmuerzo'];

                $domingo['horaIni'] = $horarios['sede1']['domingo']['entrada'];
                $domingo['horaFin'] = $horarios['sede1']['domingo']['salida'];
                $domingo['horaIniAlm'] = $horarios['sede1']['domingo']['inicioAlmuerzo'];
                $domingo['horaFinAlm'] = $horarios['sede1']['domingo']['finAlmuerzo'];

                /*registra el horario de la sede al empleado*/
                $this->save_horario($identificacion, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo);
                
                /*Crea el usuario en Base De Datos*/
                /*
                 * Cuando la conexion a BD va con host:localhost aqui se debe configurar el valor 'localhost',
                 * cuando la conexion va con direccion ip remota se debe configurar el valor '%'
                 */
                /*
                $typeHost = 'localhost';
                $this->db->trans_strict(TRUE);
                $this->db->trans_start();
                $this->db->query("CREATE USER '".$identificacion."'@'".$typeHost."' IDENTIFIED BY 'Jh4s4r3n2020'");
                $this->db->query("GRANT SELECT,INSERT,UPDATE,DELETE ON freyatrucks.* TO '".$identificacion."'@'".$typeHost."'");
                $this->db->query("FLUSH PRIVILEGES");
                $this->db->trans_complete();
                $this->db->trans_off();
                */

            }
            
            $this->cache->memcached->delete('mListusersale');
            $this->cache->memcached->delete('mListusers');
            $this->cache->memcached->delete('mListProveedor');
            return true;

        }
        
    }
    
    
    /**************************************************************************
     * Nombre del Metodo: create_referido
     * Descripcion: Registra un Referido del Cliente en BD
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 07/03/2021, Ultima modificacion: 
     **************************************************************************/
    public function create_referido($nameRef,$diacumple,$mescumple,$anocumple,$parentesco,$cliente,$observRef) {
            
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query1 = $this->db->query("INSERT INTO
                                    referidos_usuario (
                                    nombreReferido,
                                    diaCumple,
                                    mesCumple,
                                    anoNace,
                                    activo,
                                    fechaRegistro,
                                    idUsuario,
                                    parentesco,
                                    observacion
                                    ) VALUES (
                                    '".$nameRef."',
                                    ".$diacumple.",
                                    ".$mescumple.",
                                    ".$anocumple.",
                                    'S',
                                    NOW(),
                                    '".$cliente."',
                                    '".$parentesco."',
                                    '".$observRef."'
                                    )");
        
        $this->db->trans_complete();
        $this->db->trans_off();

        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;
            
        }
    }
    
    
    /**************************************************************************
     * Nombre del Metodo: delete_referido
     * Descripcion: Elimina un Referido del Cliente en BD
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 07/03/2021, Ultima modificacion: 
     **************************************************************************/
    public function delete_referido($idRef) {
            
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $this->db->query("DELETE FROM referidos_usuario WHERE idReferido = ".$idRef);
        $this->db->trans_complete();
        $this->db->trans_off();

        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;
            
        }
    }
    
    
    /**************************************************************************
     * Nombre del Metodo: update_user
     * Descripcion: Actualiza un usuario Cliente/Empleado en BD
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 26/03/2017, Ultima modificacion: 
     **************************************************************************/
    public function update_user($name,$lastname,$identificacion,$direccion,$celular,$email,$contrasena,$rol,$valueState,$restorepass,$sede,$categoria) {
            
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query1 = $this->db->query("UPDATE
                                    app_usuarios SET
                                    nombre = '".$name."',
                                    apellido = '".$lastname."',
                                    numCelular = '".$celular."',
                                    direccion = '".$direccion."',
                                    email = '".$email."',
                                    activo = '".$valueState."',
                                    idSede = '".$sede."',
                                    categoria = '".$categoria."'
                                    WHERE
                                    idUsuario = ".$identificacion."
                                    ");
        
        if ($restorepass == 1){ /*si esta marcada la casilla restablecer clave*/
            $query2 = $this->db->query("UPDATE
                                        usuario_acceso SET
                                        claveAcceso = '". sha1($contrasena)."',
                                        idRol = ".$rol."
                                        WHERE 
                                        idUsuario = ".$identificacion."
                                        ");
        } else {
            $query2 = $this->db->query("UPDATE
                                        usuario_acceso SET
                                        idRol = ".$rol."
                                        WHERE 
                                        idUsuario = ".$identificacion."
                                        ");
        }
        $this->db->trans_complete();
        $this->db->trans_off();

        if ($this->db->trans_status() === FALSE){

            return false;

        } else {

            $this->cache->memcached->delete('mListusersale');
            $this->cache->memcached->delete('mListusers');
            $this->cache->memcached->delete('mListProveedor');
            return true;

        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: horario_user
     * Descripcion: Obtiene el horario configurado al empleado
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 18/04/2017, Ultima modificacion: 
     **************************************************************************/
    public function horario_user($idUsuario) {
        
        /*Recupera los usuarios creados*/
        $query = $this->db->query("SELECT
                                idDia,
                                horaIniciaTurno,
                                horaFinTurno,
                                horaIniciaAlmuerzo,
                                horaFinAlmuerzo
                                FROM horario_empleado h
                                WHERE idEmpleado = ".$idUsuario."");
        
        if ($query->num_rows() == 0) {
            
            return false;
            
        } else {
            
            return $query->result_array();
            
        }
        
    }

    /**************************************************************************
     * Nombre del Metodo: config_user_desc_comm
     * Descripcion: Obtiene la configuracion de descuentos/comisiones para el cliente
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 30/05/2022, Ultima modificacion: 
     **************************************************************************/
    public function config_user_desc_comm($idUsuario) {
        
        /*Recupera los usuarios creados*/
        $query = $this->db->query("SELECT 
                                p.idProducto,
                                p.descProducto,
                                p.valorProducto,
                                cv.idConfig,
                                cv.idCliente,
                                cv.valorDescProd,
                                (cv.porcenComisionProd * 100) as porcenComisionProd,
                                g.descGrupoServicio
                                FROM productos p
                                JOIN grupo_servicio g ON g.idGrupoServicio = p.idGrupoServicio
                                LEFT JOIN config_venta_detalle cv ON cv.idProducto = p.idProducto and cv.idCliente = '".$idUsuario."'
                                WHERE p.activo = 'S'
                                AND p.idTipoProducto = 2");
        
        if ($query->num_rows() == 0) {
            
            return false;
            
        } else {
            
            return $query->result_array();
            
        }
        
    }

    /**************************************************************************
     * Nombre del Metodo: save_config_user
     * Descripcion: Guarda registro de configuracion descuento/comision
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 30/05/2022, Ultima modificacion: 
     **************************************************************************/
    public function save_config_user($idConfig,$idProducto,$idUsuario,$valorDescuento,$porcenComision) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();

        if ($idConfig == ""){

            $this->db->query("INSERT INTO config_venta_detalle(
                                idCliente,
                                idProducto,
                                valorDescProd,
                                porcenComisionProd,
                                fechaAjuste,
                                usuarioAjuste
                            ) VALUES (
                                '".$idUsuario."',
                                ".$idProducto.",
                                ".$valorDescuento.",
                                ".($porcenComision/100).",
                                NOW(),
                                '".$this->session->userdata('userid')."')");

        } else {

            $this->db->query("UPDATE config_venta_detalle
                                SET 
                                valorDescProd = ".$valorDescuento.",
                                porcenComisionProd = ".($porcenComision/100).",
                                fechaAjuste = NOW(),
                                usuarioAjuste = '".$this->session->userdata('userid')."'
                                WHERE
                                idConfig = ".$idConfig."
                                ");

        }

        $this->db->trans_complete();
        $this->db->trans_off();

        if ($this->db->trans_status() === FALSE){

            return false;

        } else {

            return true;

        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: save_horario
     * Descripcion: Registra horario del empleado
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 18/04/2017, Ultima modificacion: 
     **************************************************************************/
    public function save_horario($empleado,$lunes,$martes,$miercoles,$jueves,$viernes,$sabado,$domingo) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        
        /*Borra Registro de Horario del Empleado*/
        $this->db->query("DELETE FROM horario_empleado WHERE idEmpleado = ".$empleado."");
        
        $queryLun = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    1,
                                    '".$lunes['horaIni']."',
                                    '".$lunes['horaFin']."',
                                    '".$lunes['horaIniAlm']."',
                                    '".$lunes['horaFinAlm']."',
                                    NOW()
                                    )");
        
        $queryMar = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    2,
                                    '".$martes['horaIni']."',
                                    '".$martes['horaFin']."',
                                    '".$martes['horaIniAlm']."',
                                    '".$martes['horaFinAlm']."',
                                    NOW()
                                    )");
        
        $queryMie = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    3,
                                    '".$miercoles['horaIni']."',
                                    '".$miercoles['horaFin']."',
                                    '".$miercoles['horaIniAlm']."',
                                    '".$miercoles['horaFinAlm']."',
                                    NOW()
                                    )");
        
        $queryJue = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    4,
                                    '".$jueves['horaIni']."',
                                    '".$jueves['horaFin']."',
                                    '".$jueves['horaIniAlm']."',
                                    '".$jueves['horaFinAlm']."',
                                    NOW()
                                    )");
        
        $queryVie = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    5,
                                    '".$viernes['horaIni']."',
                                    '".$viernes['horaFin']."',
                                    '".$viernes['horaIniAlm']."',
                                    '".$viernes['horaFinAlm']."',
                                    NOW()
                                    )");
        
        $querySab = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    6,
                                    '".$sabado['horaIni']."',
                                    '".$sabado['horaFin']."',
                                    '".$sabado['horaIniAlm']."',
                                    '".$sabado['horaFinAlm']."',
                                    NOW()
                                    )");
        
        $queryDom = $this->db->query("INSERT INTO
                                    horario_empleado (
                                    idEmpleado,
                                    idDia,
                                    horaIniciaTurno,
                                    horaFinTurno,
                                    horaIniciaAlmuerzo,
                                    horaFinAlmuerzo,
                                    fechaModifica
                                    ) VALUES (
                                    ".$empleado.",
                                    7,
                                    '".$domingo['horaIni']."',
                                    '".$domingo['horaFin']."',
                                    '".$domingo['horaIniAlm']."',
                                    '".$domingo['horaFinAlm']."',
                                    NOW()
                                    )");

        $this->db->trans_complete();
        $this->db->trans_off();

        if ($this->db->trans_status() === FALSE){

            return false;

        } else {

            return true;

        }
        
    }
    
}
