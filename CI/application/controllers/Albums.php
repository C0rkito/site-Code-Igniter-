<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->model('model_playlist');
		$this->load->library("session");
	}

	public function index(){
		$albumName = "'"."%".filter_input(INPUT_GET,'albumName',FILTER_SANITIZE_SPECIAL_CHARS)."%"."'";
		$albumYear = filter_input(INPUT_GET,'albumYear',FILTER_SANITIZE_NUMBER_INT);
		$albumGenre = filter_input(INPUT_GET,'albumGenre',FILTER_SANITIZE_NUMBER_INT);
		$order = filter_input(INPUT_GET,'order',FILTER_SANITIZE_SPECIAL_CHARS);


		if($order == ""){
			$order = "album.year";
		}

		if($albumYear == ""){
			$albumYear = "album.year";

		}
		if ($albumGenre == ""){
			$albumGenre = "album.genreId";
		}
	
		
			
		

		$albums = $this->model_music->getAlbums($albumName,$albumYear,$albumGenre,$order);
		$genres = $this->model_music->getGenres();
		$years = $this->model_music->getYears();
		
		$this->load->helper('html');
		$this->load->view('layout/header',['title'=>'Albums','isConnect'=> isset($_SESSION['user_id'])]);
		$this->load->view('albums_list',['albums'=>$albums,'genres'=>$genres,'years'=>$years,"nb"=>sizeof($albums)]);
		$this->load->view('layout/footer');
	}
	public function view($id){

		$this->load->helper('html');
		$album = $this->model_music->getAlbumByid($id);
		$track = $this->model_music->getTrackByAlbumId($id);

		$this->load->view('layout/header',['title'=>$album[0]->albumName,'id'=>$id,'css'=>['assets/album.css'],'isConnect'=> isset($_SESSION['user_id'])]);
		
		if (isset($_SESSION['user_id'])){
			$playlists = $this->model_playlist->getPlaylists($_SESSION['user_id'][0]->id);
			$this->load->view('albums_details',['info'=>$album[0],"track"=>$track,"playlists"=>$playlists]);
		}
		else{
			$this->load->view('albums_details',['info'=>$album[0],"track"=>$track]);
		}
		$this->load->view('layout/footer');

		

	}
}
?>