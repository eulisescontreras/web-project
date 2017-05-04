<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolModel extends CI_Model{
    
    function __construct(){
    
    }
    
    public function send_rol(){
        $sql = "SELECT * FROM rol";
        $rols = $this->db->query($sql)->result_array();
        
        $html = '<option style="color:black !important;" value="" selected>Seleccione una opción</option>';
        foreach($rols as $rol){
            $html = $html.'<option style="color:black !important;" value="'.$rol['name'].'">'.$rol['name'].'</option>';
        }
        return $html;
    }
}