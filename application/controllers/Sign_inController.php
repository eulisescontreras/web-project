<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_inController extends CI_Controller {

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
	}
	
	public function index(){
		$userCredentials = array(
			"Username" => null,
			"Password" => null
	    );
	    $this->session->set_userdata($userCredentials);
	    $this->data['message'] = $this->session->flashdata('message');
		$this->load->view('app/sign_in',$this->data);
	}
	
	public function login(){
		
		if($this->input->post("Username") != "" and  $this->input->post("Password") != ""){
			if($this->Sign_inModel->authenticate($this->input->post("Username"),$this->input->post("Password"))){
			  $data = $this->Sign_inModel->send_permissions($this->input->post("Username"),$this->input->post("Password"));
			  $userCredentials = array(
					"Username" => $this->input->post("Username"),
					"Password" => $this->input->post("Password")
			  );
			  $this->session->set_userdata($userCredentials);
			  $this->session->set_flashdata('permissions',$data);
			  redirect('dashboard');
			}else{
			  $this->session->set_flashdata('message',"Usuario no registrado.");
			}
		}elseif($this->input->post("Username") == "" and  $this->input->post("Password") == "")
			$this->session->set_flashdata('message',"Error la contraseña y el usuario son requeridos.");		
		elseif($this->input->post("Password") == "")
			$this->session->set_flashdata('message',"Error la contraseña es requerida.");		
		elseif($this->input->post("Username") == "")
			$this->session->set_flashdata('message', "Error el usuario es requerido.");
		redirect(base_url());
	}
	
	public function logout() {
		$userCredentials = array(
			"Username" => null,
			"Password" => null
	    );
	    $this->session->set_userdata($userCredentials);
	    $this->session->set_flashdata('message', "");
		redirect(base_url());
    }
    
    public function forgot_password(){
    	echo json_encode("forgot_password");
    }
    
	public function is_login(){
		echo json_encode($this->session->userdata('Username'));
	}
}
