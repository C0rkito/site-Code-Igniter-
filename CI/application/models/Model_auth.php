<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_auth extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function createUser($mail,$password){
		$sql = "INSERT INTO users VALUES(?,?,?)";
		$query = $this->db->query($sql,[$this->db->insert_id(),$mail,password_hash($password,PASSWORD_DEFAULT)]);
	}
	public function isUserExist($mail){
		$this->db->where('mail',$mail);
		$query = $this->db->get("users");

		return $query->num_rows() >0;
	}

	public function check($mail,$password){
		$query = $this->db->query("SELECT hash_password from users where mail = '{$mail}'");
		return password_verify($password,$query->result()[0]->hash_password);
	}	

	public function getUserId($mail){
		$query = $this->db->query("SELECT id FROM users where mail = '{$mail}'");
		return $query->result();
	}
	public function deleteUser($user_id){
		$query = $this->db->query("DELETE FROM users where $id ='{$user_id}'");
	}
}
