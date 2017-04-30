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
}