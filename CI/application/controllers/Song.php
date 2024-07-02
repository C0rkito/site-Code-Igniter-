<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_song');
		$this->load->model('model_music');
		$this->load->model('model_artist');
		$this->load->library("session");
	}


	public function index(){

		$songName = "'"."%".filter_input(INPUT_GET,'songName',FILTER_SANITIZE_SPECIAL_CHARS)."%"."'";
		$songYear = filter_input(INPUT_GET,'songYear',FILTER_SANITIZE_NUMBER_INT);
		$songGenre = filter_input(INPUT_GET,'songGenre',FILTER_SANITIZE_NUMBER_INT);
		if($songYear == ""){
			$songYear = "album.year";

		}
		if ($songGenre == ""){
			$songGenre = "album.genreId";
		}

		$songs = $this->model_song->getSongs($songName,$songYear,$songGenre);
		$genres = $this->model_music->getGenres();
		$years = $this->model_music->getYears();


		$this->load->helper('html');
		$this->load->view('layout/header',['title'=>'Songs','css'=>['assets/song.css'],'isConnect'=> isset($_SESSION['user_id'])]);
		$this->load->view('song_list',['songs'=>$songs,'genres'=>$genres,'years' => $years,"nb"=>sizeof($songs)]);
		$this->load->view('layout/footer');
	}
}
?>