<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_inModel extends CI_Model{
    
    function __construct(){
    
    }
    
    function authenticate($user,$password){
        $sql = "SELECT * FROM user WHERE username = ? AND AES_DECRYPT(password,'webproject') = ?";
        $autenthicated = $this->db->query($sql, array($user,$password));
        return $autenthicated->num_rows() > 0;
    }
    
    function send_permissions($user,$password){
        $sql = "SELECT p.name FROM (SELECT rp.id_permissions FROM (SELECT ur.id_rol FROM (SELECT Id FROM user WHERE username = ? AND AES_DECRYPT(password,'webproject') = ?) u INNER JOIN user_rol ur ON u.Id = ur.id_user) uur INNER JOIN rol_permissions rp ON uur.id_rol = rp.id_rol) uurrp INNER JOIN permissions p ON uurrp.id_permissions = p.Id";
        $permissionsUsers = $this->db->query($sql, array($user,$password))->result_array();

        $sql = "SELECT name FROM permissions";
        $permissions = $this->db->query($sql)->result_array();
        
        $arrayPermisions = [];
        foreach($permissions as $permission){
            $arrayPermisions[$permission['name']]= false;
        }
        
        foreach($permissionsUsers as $permissionUser){
            $arrayPermisions[$permissionUser['name']]= true;
        }
        
        return $arrayPermisions;
    }
    
    function send_personal_data($user,$password){
        $sql = "SELECT * FROM user WHERE username = ? AND AES_DECRYPT(password,'webproject') = ?";
        return $this->db->query($sql, array($user,$password))->result_array();
    }
    
    function send_rols($user,$password){
        $sql = "SELECT r.name FROM (SELECT ur.id_rol FROM (SELECT Id FROM user WHERE username = ? AND AES_DECRYPT(password,'webproject') = ?) u INNER JOIN user_rol ur ON u.Id = ur.id_user) uur INNER JOIN rol r ON uur.id_rol = r.Id";
        $rolsUsers = $this->db->query($sql, array($user,$password))->result_array();
 
        $sql = "SELECT * FROM rol";
        $rols = $this->db->query($sql)->result_array();
        
        $arrayRols = [];
        foreach($rols as $rol){
            $arrayRols[$rol['name']] = false;
        }
        
        foreach($rolsUsers as $rolsUser){
            $arrayRols[$rolsUser['name']] = true;
        }
        
        return $arrayRols;

    }
    
}