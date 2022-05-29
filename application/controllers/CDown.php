<?php
/**************************************************************************
* Nombre de la Clase: CDown
* Version: 1.0 
* Descripcion: Es el controlador para el Modulo de Bajas
* en el sistema.
* Autor: jhonalexander90@gmail.com
* Fecha Creacion: 05/11/2019
**************************************************************************/

defined('BASEPATH') OR exit('No direct script access allowed');

class CDown extends CI_Controller {

    function __construct() {
        
        parent::__construct(); /*por defecto*/
        $this->load->helper('url'); /*Carga la url base por defecto*/
        
        /*Carga Modelos*/
        $this->load->model('MDown'); /*Modelo para las Ventas*/
        
        date_default_timezone_set('America/Bogota'); /*Zona horaria*/

        //lineas para eliminar el historico de navegacion./
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");
        
    }
    
    /**************************************************************************
     * Nombre del Metodo: index
     * Descripcion: Direcciona al usuario segun la sesion
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function index() {
        
        if ($this->session->userdata('validated')) {

            $this->bajas();
            
        } else {
            
            $this->load->view('login');
            
        }
        
    }
    
    
    /**************************************************************************
     * Nombre del Metodo: bajas
     * Descripcion: Procedimiento de Bajas
     * Autor: jhonalexander90@gmail.com
     * Fecha Creacion: 05/11/2019, Ultima modificacion: 
     **************************************************************************/
    public function bajas() {
        
        if ($this->session->userdata('validated')) {
            
            /*Lee el archivo csv con los datos*/
            $file = fopen(base_url().'files/noviembre2019.csv', 'r');
            
            while (($line = fgetcsv($file)) !== FALSE) {
                
                $numero = count($line);
                for ($c=0; $c < $numero; $c++) {
                    
                    $row = explode(";", $line[$c]);
                    $idVenta = $row[0];
                    $idProducto = $row[1];
                    $valueProducto = $row[2];
                    $idServicio = $row[3];
                    $valueServicio = $row[4];
                    $descAdicional = $row[5];
                    $valueAdicional = $row[6];
                    
                    echo "idVenta: ".$idVenta. " idProducto: ".$idProducto." idServicio:".$idServicio."<br />";
                    
                    $products = $this->MDown->list_products_sale($idVenta);
                    
                    if ($products == FALSE){
                        
                        echo "no hay datos en producto<br />";
                        $services = $this->MDown->list_service_sale($idVenta);
                        
                        if ($services == FALSE){
                            
                            echo "no hay datos en servicio<br />";
                            $adicionales = $this->MDown->list_adicional_sale($idVenta);
                            
                            if ($adicionales == FALSE){
                                
                                echo "no hay datos en adicionales";
                                
                            } else {
                                
                                $numIdVenta = count($adicionales)."<br />";
                                $rowCount = 1;
                                
                                foreach ($adicionales as $row_list) {
                                    
                                    if ($rowCount == $numIdVenta){
                                
                                        echo "Modifica->".$row_list['idRegistroDetalle']."<br />";
                                        $this->MDown->update_detail_sale($row_list['idRegistroDetalle'],$descAdicional,$valueAdicional,"adicional");

                                    } else {

                                        echo "elimina->".$row_list['idRegistroDetalle']."<br />";
                                        $this->MDown->delete_detail_sale($row_list['idRegistroDetalle']);

                                    }
                                    $rowCount++;
                                    
                                }
                                $this->MDown->update_maestro_sale($idVenta,$valueAdicional); /*modifica valor en maestro*/
                                $this->MDown->update_formas_sale($idVenta,$valueAdicional); /*modifica valor en formas*/
                                
                            }
                            
                        } else {
                            
                            $numIdVenta = count($services)."<br />";
                            $rowCount = 1;
                            
                            foreach ($services as $row_list) {
                                
                                if ($rowCount == $numIdVenta){
                                
                                    echo "Modifica->".$row_list['idRegistroDetalle']."<br />";
                                    $this->MDown->update_detail_sale($row_list['idRegistroDetalle'],$idServicio,$valueServicio,"servicio");

                                } else {

                                    echo "elimina->".$row_list['idRegistroDetalle']."<br />";
                                    $this->MDown->delete_detail_sale($row_list['idRegistroDetalle']);

                                }
                                $rowCount++;
                                
                            }
                            $this->MDown->delete_adicional_sale($idVenta); /*Elimina Cargos adicionales*/

                            $this->MDown->update_maestro_sale($idVenta,$valueServicio); /*modifica valor en maestro*/
                            $this->MDown->update_formas_sale($idVenta,$valueServicio); /*modifica valor en formas*/
                            
                        }
                        
                    } else {
                        
                        $numIdVenta = count($products)."<br />";
                        $rowCount = 1;
                        
                        foreach ($products as $row_list) { 
                            
                            if ($rowCount == $numIdVenta){
                                
                                echo "Modifica->".$row_list['idRegistroDetalle']."<br />";
                                $this->MDown->update_detail_sale($row_list['idRegistroDetalle'],$idProducto,$valueProducto,"producto");
                                
                            } else {
                                
                                echo "elimina->".$row_list['idRegistroDetalle']."<br />";
                                $this->MDown->delete_detail_sale($row_list['idRegistroDetalle']);
                                
                            }
                            $rowCount++;
                            
                        }
                        $this->MDown->delete_service_sale($idVenta); /*Elimina Servicios adicionales*/
                        $this->MDown->delete_adicional_sale($idVenta); /*Elimina Cargos adicionales*/
                        
                        $this->MDown->update_maestro_sale($idVenta,$valueProducto); /*modifica valor en maestro*/
                        $this->MDown->update_formas_sale($idVenta,$valueProducto); /*modifica valor en formas*/
                                              
                    }
                    echo "<br />******************<br />";
                }
            }
            fclose($file);
            
        } else {
            
            show_404();
            
        }
        
    }
        
}
