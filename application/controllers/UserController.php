<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		
		parent::__construct();
		$this->data['permissions'] = $this->session->userdata('Permissions');
		$this->data['personal_data'] = $this->session->userdata('Personal_data');
		$this->data['rols'] = $this->session->userdata('Rols');
	}
	
	public function index(){
		$this->load->view('app/UsersViews/listado',$this->data);
	}
	
	public function table_users_data(){
		$usersData = $this->UserModel->send_data_users();
		echo json_encode(array(
            "draw"            => 1,
	        "recordsTotal"    => $usersData->num,
	        "recordsFiltered" => $usersData->num,
	        "data"            => $usersData->data
        ));
	}
	
	public function addUser(){
		$text = "";
		if(!$this->UserModel->userExist($this->input->post('personal_data')[0]) && !$this->UserModel->userNameExist($this->input->post('personal_data')[6]))
		{
			$this->UserModel->add_user($this->input->post('personal_data'),$this->input->post('rols'));
			$text = USER_REGISTERED_SUCCESS;
		}else
		{
			if($this->UserModel->userExist($this->input->post('personal_data')[0]))
				$text = USER_REGISTER_ERROR;
			else if($this->UserModel->userNameExist($this->input->post('personal_data')[6]))
				$text = USERNAME_REGISTER_ERROR;
		}
		echo json_encode($text);
			
	}
}
