<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_artist');
		$this->load->library("session");
		$this->load->model('model_playlist');
	}
	public function index(){
		
		$artistName = "'"."%".filter_input(INPUT_GET,'artistName',FILTER_SANITIZE_SPECIAL_CHARS)."%"."'";
		$order = filter_input(INPUT_GET,'order',FILTER_SANITIZE_SPECIAL_CHARS);
		if($order == ""){
			$order = "artist.name";
		}

		$artists = $this->model_artist->getArtists($artistName,$order);
		$this->load->helper('html');
		$this->load->view('layout/header',['title'=>'Artists','css'=>['assets/artiste.css'],'isConnect'=> isset($_SESSION['user_id'])]);
		$this->load->view('artists_list',['artists'=>$artists]);
		$this->load->view('layout/footer');
	}
	
	public function view($id){
		$this->load->helper('html');
		$artist = $this->model_artist->getArtistByid($id);
		$albums = $this->model_artist->getAlbumsByArtist($id);
		$this->load->view('layout/header',['title'=>$artist[0]->artistName,'isConnect'=> isset($_SESSION['user_id'])]);
		if (isset($_SESSION['user_id'])){
			$playlists = $this->model_playlist->getPlaylists($_SESSION['user_id'][0]->id);
			$this->load->view('artists_details',['infos'=>$artist[0],'albums' => $albums,'playlists' =>$playlists]);
		}
		else{
			$this->load->view('artists_details',['infos'=>$artist[0],'albums' => $albums]);
		}

		$this->load->view('layout/footer');

	}
}
?>