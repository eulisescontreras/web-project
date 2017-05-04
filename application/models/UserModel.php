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
        
        $auxPersonalData = "SELECT uurrpr.username, uurrpr.complete_name, uurrpr.password, uurrpr.start_date FROM (SELECT name,uurrp.id_rol,uurrp.username, uurrp.complete_name, uurrp.password, uurrp.start_date FROM (SELECT rp.id_rol,id_permissions,uur.username, uur.complete_name, uur.password, uur.start_date FROM (SELECT id_rol,u.username, u.complete_name, u.password, u.start_date FROM (SELECT Id,username,CONCAT(first_name,' ',second_name,' ',surname,' ',second_surname) AS 'complete_name',AES_DECRYPT(password,'webproject') AS 'password', DATE_FORMAT(start_date, '%d-%m-%Y') AS 'start_date' FROM user) u INNER JOIN user_rol ur ON u.Id = ur.id_user) uur INNER JOIN rol_permissions rp ON uur.id_rol = rp.id_rol) uurrp INNER JOIN permissions p ON uurrp.id_permissions = p.Id) uurrpr INNER JOIN rol ro ON uurrpr.id_rol = ro.Id GROUP BY uurrpr.complete_name";
        $personalDatas = $this->db->query($auxPersonalData)->result_array();
        $color = array('background-color--mint','background-color--primary','background-color--cerulean');
        
        $data[0]['username'] = "";
        $data[0]['password'] = "";
        $data[0]['rols'] = "";
        $data[0]['permissions'] = "<div class='mdl-data-table__cell--non-numeric'>No existen registros</div>";
        $data[0]['complete_name'] = "";
        $data[0]['start_date'] = "";
        foreach($personalDatas as $personalData){
            $auxr = "";
            $auxp = "";
            
            //$data[$i]['checkbox'] = '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple"><input type="checkbox" class="mdl-checkbox__input"><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></label>';
            $data[$i]['username'] = '<div class="mdl-data-table__cell--non-numeric">'.$personalData['username'].'</div>';
            $data[$i]['password'] = '<div class="mdl-data-table__cell--non-numeric">'.$personalData['password'].'</div>';
            
            $auxRol = "SELECT ro.name AS 'rol' FROM (SELECT name,uurrp.id_rol,uurrp.username, uurrp.complete_name, uurrp.password, uurrp.start_date FROM (SELECT rp.id_rol,id_permissions,uur.username, uur.complete_name, uur.password, uur.start_date FROM (SELECT id_rol,u.username, u.complete_name, u.password, u.start_date FROM (SELECT Id,username,CONCAT(first_name,' ',second_name,' ',surname,' ',second_surname) AS 'complete_name',AES_DECRYPT(password,'webproject') AS 'password', DATE_FORMAT(start_date, '%d-%m-%Y') AS 'start_date' FROM user WHERE username='".$personalData['username']."' AND AES_DECRYPT(password,'webproject')=".$personalData['password'].") u INNER JOIN user_rol ur ON u.Id = ur.id_user) uur INNER JOIN rol_permissions rp ON uur.id_rol = rp.id_rol) uurrp INNER JOIN permissions p ON uurrp.id_permissions = p.Id) uurrpr INNER JOIN rol ro ON uurrpr.id_rol = ro.Id GROUP BY ro.name";
            $rols = $this->db->query($auxRol)->result_array();
            
            foreach($rols as $rol){
                $auxr = $auxr.'<span class="label label--mini '.$color[$j].'">'.$rol['rol'].'</span>';
                if($j == 2) $j = 0; else $j++;
            }
            $data[$i]['rols'] = '<div class="mdl-data-table__cell--non-numeric">'.$auxr.'</div>';
            
            $auxPermission = "SELECT uurrpr.name AS 'permissions' FROM (SELECT name,uurrp.id_rol,uurrp.username, uurrp.complete_name, uurrp.password, uurrp.start_date FROM (SELECT rp.id_rol,id_permissions,uur.username, uur.complete_name, uur.password, uur.start_date FROM (SELECT id_rol,u.username, u.complete_name, u.password, u.start_date FROM (SELECT Id,username,CONCAT(first_name,' ',second_name,' ',surname,' ',second_surname) AS 'complete_name',AES_DECRYPT(password,'webproject') AS 'password', DATE_FORMAT(start_date, '%d-%m-%Y') AS 'start_date' FROM user WHERE username='".$personalData['username']."' AND AES_DECRYPT(password,'webproject')=".$personalData['password'].") u INNER JOIN user_rol ur ON u.Id = ur.id_user) uur INNER JOIN rol_permissions rp ON uur.id_rol = rp.id_rol) uurrp INNER JOIN permissions p ON uurrp.id_permissions = p.Id) uurrpr INNER JOIN rol ro ON uurrpr.id_rol = ro.Id GROUP BY uurrpr.name";
            $permissions = $this->db->query($auxPermission)->result_array();
            
            foreach($permissions as $permission){
                $auxp = $auxp.'<span class="label label--mini '.$color[$j].'">'.$permission['permissions'].'</span>';
                if($j == 2) $j = 0; else $j++;
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
        /*$user = array(
           'Id'              => $personal_data['id'], 
           'first_name'      => $personal_data['first_name'], 
           'second_name'     => $personal_data['second_name'], 
           'surname'         => $personal_data['surname'], 
           'second_surname'  => $personal_data['second_surname'], 
           'email'           => $personal_data['email'], 
           'username'        => $personal_data['username'], 
           'password'        => $personal_data['password'], 
           'address'         => $personal_data['address'], 
           'phone'           => $personal_data['phone'], 
           'start_date'      => date("Y").date("m").(date("d")-1),
           'active'          => TRUE
        );
        $this->db->insert('user', $user); */
        $string = "hola";
        /*foreach($rols as $rol){
            $string = $string ."  ". $rol;
        }*/
        /*$user_rol = array(
             'id_user' => $personal_data['id'],
             'id_rol'  => $this->db->select('Id')
                                   ->from('rol')
                                   ->where('name',$rol)
                                   ->get()
                                   ->row()
                                   ->Id;
        );*/
        
        //$this->db->insert('user_rol',$user_rol);
        return $string;
    }
}