<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_register extends CI_Controller {
    private $user_id;
	public function __construct(){
		parent::__construct();
		$this->load->model('model_auth');
        
	}

	public function index(){
		$this->load->helper('html');
        $this->load->view('layout/header',["title"=>"Login",'isConnect'=> isset($_SESSION['user_id'])]);
        $this->load->view('auth_form_register',["tilte"=>"Register","page"=>"playlist"]);
        $this->load->view('layout/footer');
	}

    public function register($page){
        $mail = $this->input->post('email');
        $password = $this->input->post('password');

        if(!$this->model_auth->isUserExist($mail)){
            if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $this->model_auth->createUser($mail,$password);
                redirect($page);
            }

                
        }
        redirect("auth_register");
    }

}
?>