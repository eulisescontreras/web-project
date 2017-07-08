<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
    function __construct(){
    
    }
    
    public function send_data_users(){
        $i = 0;
        $j = 0;
        $data[]=[];
        $dataComplete = new stdClass;
        
        $auxPersonalData = "SELECT uurrpr.iduser ,uurrpr.username, uurrpr.complete_name, uurrpr.password, uurrpr.start_date FROM (SELECT name,uurrp.id_rol,uurrp.username, uurrp.complete_name, uurrp.password,uurrp.iduser, uurrp.start_date FROM (SELECT rp.id_rol,id_permissions,uur.iduser,uur.username, uur.complete_name, uur.password, uur.start_date FROM (SELECT id_rol,u.iduser,u.username, u.complete_name, u.password, u.start_date FROM (SELECT Id AS 'iduser',username,CONCAT(first_name,' ',second_name,' ',surname,' ',second_surname) AS 'complete_name',AES_DECRYPT(password,'webproject') AS 'password', DATE_FORMAT(start_date, '%d-%m-%Y') AS 'start_date' FROM user) u INNER JOIN user_rol ur ON u.iduser = ur.id_user) uur INNER JOIN rol_permissions rp ON uur.id_rol = rp.id_rol) uurrp INNER JOIN permissions p ON uurrp.id_permissions = p.Id) uurrpr INNER JOIN rol ro ON uurrpr.id_rol = ro.Id GROUP BY uurrpr.complete_name";
        $personalDatas = $this->db->query($auxPersonalData)->result_array();
        $color = array('background-color--mint','background-color--primary','background-color--cerulean','background-color--secondary');
        
        $data[0]['username'] = "";
        $data[0]['password'] = "";
        $data[0]['rols'] = "";
        $data[0]['permissions'] = "<div class='mdl-data-table__cell--non-numeric'>No existen registros</div>";
        $data[0]['complete_name'] = "";
        $data[0]['start_date'] = "";
        foreach($personalDatas as $personalData){
            $auxr = "";
            $auxp = "";
            
            $data[$i]['username'] = '<div class="mdl-data-table__cell--non-numeric">'.$personalData['username'].'</div>';
            $data[$i]['password'] = '<div class="mdl-data-table__cell--non-numeric">'.$personalData['password'].'</div>';
            
            $auxRol = "SELECT name AS 'rol' FROM (SELECT ur.id_rol AS 'idrol' FROM (SELECT Id AS 'iduser' FROM user WHERE id =".$personalData['iduser'].") u INNER JOIN user_rol ur ON u.iduser = ur.id_user) uur INNER JOIN rol r ON uur.idrol = r.Id ORDER BY name";
            $rols = $this->db->query($auxRol)->result_array();
            
            foreach($rols as $rol){
                $auxr = $auxr.'<span class="label label--mini '.$color[$j].'">'.$rol['rol'].'</span>';
                if($j == 3){ $j = 0; $auxr = $auxr.'<br/>'; }else $j++;
            }
            $data[$i]['rols'] = '<div class="mdl-data-table__cell--non-numeric">'.$auxr.'</div>';
            
            $auxPermission = "SELECT name AS 'permissions' FROM (SELECT id_permissions FROM (SELECT idrol FROM (SELECT ur.id_rol AS 'idrol' FROM (SELECT Id AS 'iduser' FROM user WHERE id =".$personalData['iduser'].") u INNER JOIN user_rol ur ON u.iduser = ur.id_user) uur INNER JOIN rol r ON uur.idrol = r.Id) uurr INNER JOIN rol_permissions rp ON uurr.idrol = rp.id_rol) uurrrp INNER JOIN permissions p ON uurrrp.id_permissions = p.Id  GROUP BY permissions";
            $permissions = $this->db->query($auxPermission)->result_array();
            
            $j = 0;
            foreach($permissions as $permission){
                $auxp = $auxp.'<span class="label label--mini '.$color[$j].'">'.$permission['permissions'].'</span>';
                if($j == 3){ $j = 0; $auxp = $auxp.'<br/>'; }else $j++;
            }
            $data[$i]['permissions'] = '<div class="mdl-data-table__cell--non-numeric">'.$auxp.'</div>';
        
            $data[$i]['complete_name'] = '<div class="mdl-data-table__cell--non-numeric">'.$personalData['complete_name'].'</div>';
            $data[$i]['start_date'] = '<div class="mdl-data-table__cell--non-numeric">'.$personalData['start_date'].'</div>';
            $i++;
        }
            
        $dataComplete->data = $data;
        $dataComplete->num = $i;
        return $dataComplete;
    }
    
    public function add_user($personal_data,$rols){
        $data = $personal_data[0].",'".$personal_data[1]."','".$personal_data[2]."','".$personal_data[3]."','".$personal_data[4]."','".$personal_data[5]."','".$personal_data[6]."',AES_ENCRYPT('".$personal_data[7]."','webproject'),'".$personal_data[8]."','".$personal_data[9]."','".date('Ymd')."',TRUE";
        $this->db->query("INSERT INTO user(Id,first_name,second_name,surname,second_surname,email,username,password,address,phone,start_date,active) VALUES (".$data.")");
        foreach($rols as $rol)
        {
            $user_rol = array(
                 'id_user' => $personal_data[0],
                 'id_rol'  => $this->db->select('Id')
                                       ->from('rol')
                                       ->where('name',$rol)
                                       ->get()
                                       ->row()
                                       ->Id
            );
            $this->db->insert('user_rol',$user_rol);
        }
        
    }
    
    public function userExist($id){
        return ($this->db->select('Id')
                         ->from('user')
                         ->where('Id',$id)
                         ->get()->result_array() != null);
    }
    
    public function userNameExist($username){
        return ($this->db->select('username')
                         ->from('user')
                         ->where('username',$username)
                         ->get()->result_array() != null);
    }
}