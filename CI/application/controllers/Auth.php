<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('model_auth');
        $this->load->library("session");
	}

	public function index(){
        if(isset($_SESSION["user_id"])){
            redirect("playlist");
        }
		$this->load->helper('html');
        $this->load->view('layout/header',["title"=>"Login",'isConnect'=> isset($_SESSION['user_id'])]);
        $this->load->view('auth_form');
        $this->load->view('layout/footer');
	}

    public function login(){
        $mail = $this->input->post('email');
        $password = $this->input->post('password');

        if($this->model_auth->isUserExist($mail)){
            if($this->model_auth->check($mail,$password)){
            $this->session->set_userdata("user_id",$this->model_auth->getUserId($mail));
            redirect("playlist");
            }
        }
        redirect("auth");
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect("albums");
    }

    public function delete(){
        $this->load->helper('html');
        $this->load->view('layout/header',["title"=>"Login",'isConnect'=> isset($_SESSION['user_id'])]);
        $this->load->view('delete_account');
        $this->load->view('layout/footer');
    }
}
?>