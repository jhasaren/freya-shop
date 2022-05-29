<?php
/**************************************************************************
* Nombre de la Clase: MDown
* Descripcion: Es el Modelo para las interacciones en BD del modulo Bajas
* Autor: jhonalexander90@gmail.com
* Fecha Creacion: 05/11/2019
**************************************************************************/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MDown extends CI_Model {

    public function __construct() {
        
        /*instancia la clase de conexion a la BD para este modelo*/
        parent::__construct();
        $this->load->driver('cache'); /*Carga cache*/
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: delete_detail_sale
     * Descripcion: Elimina un registro de la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function delete_detail_sale($idDetalleReg) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query = $this->db->query("DELETE FROM venta_detalle WHERE idRegistroDetalle = ".$idDetalleReg."");
        $this->db->trans_complete();
        $this->db->trans_off();
        
        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;

        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: delete_detail_sale
     * Descripcion: Elimina un registro de la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function delete_service_sale($idVenta) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query = $this->db->query("DELETE FROM venta_detalle WHERE idVenta = ".$idVenta." AND idServicio IS NOT NULL");
        $this->db->trans_complete();
        $this->db->trans_off();
        
        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;

        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: delete_detail_sale
     * Descripcion: Elimina un registro de la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function delete_adicional_sale($idVenta) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query = $this->db->query("DELETE FROM venta_detalle WHERE idVenta = ".$idVenta." AND cargoEspecial IS NOT NULL");
        $this->db->trans_complete();
        $this->db->trans_off();
        
        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;

        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: list_products_sale
     * Descripcion: Recupera lista de productos para la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function list_products_sale($idVenta) {
                            
        /*Recupera productos creados en la Venta*/
        $query = $this->db->query("SELECT idRegistroDetalle "
                                . "FROM venta_detalle v "
                                . "WHERE "
                                . "idVenta = ".$idVenta." "
                                . "and idProducto IS NOT NULL");

        if ($query->num_rows() == 0) {

            return false;

        } else {

            return $query->result_array();

        }
            
    }
    
    /**************************************************************************
     * Nombre del Metodo: list_service_sale
     * Descripcion: Recupera lista de servicios para la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function list_service_sale($idVenta) {
                            
        /*Recupera servicios creados en la Venta*/
        $query = $this->db->query("SELECT idRegistroDetalle "
                                . "FROM venta_detalle v "
                                . "WHERE "
                                . "idVenta = ".$idVenta." "
                                . "AND idServicio IS NOT NULL");

        if ($query->num_rows() == 0) {

            return false;

        } else {

            return $query->result_array();

        }
            
    }
    
    /**************************************************************************
     * Nombre del Metodo: list_adicional_sale
     * Descripcion: Recupera lista de adicionales para la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function list_adicional_sale($idVenta) {
                            
        /*Recupera servicios creados en la Venta*/
        $query = $this->db->query("SELECT idRegistroDetalle "
                                . "FROM venta_detalle v "
                                . "WHERE "
                                . "idVenta = ".$idVenta." "
                                . "AND cargoEspecial IS NOT NULL");

        if ($query->num_rows() == 0) {

            return false;

        } else {

            return $query->result_array();

        }
            
    }
    
    /**************************************************************************
     * Nombre del Metodo: update_detail_sale
     * Descripcion: Modifica un registro de la venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function update_detail_sale($idDetalleReg,$idItem,$valorItem,$type) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        if ($type=="producto"){
            $query = $this->db->query("UPDATE venta_detalle "
                                    . "SET idProducto=".$idItem.", valor=".$valorItem.", cantidad=1 "
                                    . "WHERE idRegistroDetalle = ".$idDetalleReg."");
        } else {
            if ($type=="servicio"){
                $query = $this->db->query("UPDATE venta_detalle "
                                        . "SET idServicio=".$idItem.", valor=".$valorItem.", cantidad=1 "
                                        . "WHERE idRegistroDetalle = ".$idDetalleReg."");
            } else {
                if ($type=="adicional"){
                    $query = $this->db->query("UPDATE venta_detalle "
                                            . "SET cargoEspecial='".$idItem."', valor=".$valorItem." "
                                            . "WHERE idRegistroDetalle = ".$idDetalleReg."");
                }
            }
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
     * Nombre del Metodo: update_maestro_sale
     * Descripcion: actualiza valor en tabla maestro de venta
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function update_maestro_sale($idVenta,$value) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query = $this->db->query("UPDATE venta_maestro "
                                . "SET porcenDescuento=0, porcenServicio=0, valorTotalVenta=".$value.",valorLiquida=".$value." "
                                . "WHERE idVenta = ".$idVenta."");
        $this->db->trans_complete();
        $this->db->trans_off();
        
        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;

        }
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: update_formas_sale
     * Descripcion: actualiza valor en formas de pago
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function update_formas_sale($idVenta,$value) {
        
        $this->db->trans_strict(TRUE);
        $this->db->trans_start();
        $query = $this->db->query("UPDATE forma_de_pago "
                                . "SET valorPago=".$value." "
                                . "WHERE idVenta = ".$idVenta."");
        $this->db->trans_complete();
        $this->db->trans_off();
        
        if ($this->db->trans_status() === FALSE){

            return false;

        } else {
            
            return true;

        }
        
    }
      
}
