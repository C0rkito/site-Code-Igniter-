<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_playlist');
		$this->load->model('model_music');
		$this->load->model('model_artist');
		$this->load->library("session");
		
		if(!isset($_SESSION["user_id"])){
			redirect("auth");
		}
		
	}


	public function index(){
		$this->load->helper('html');
		$genres = $this->model_music->getGenres();

		$years = $this->model_music->getYears();
		
		$this->load->view('layout/header',['title'=>'Playlists','css'=>["assets/playlist.css"],'isConnect'=> isset($_SESSION['user_id'])]);;
		$playlists = $this->model_playlist->getPlaylists($_SESSION['user_id'][0]->id);	
		$this->load->view('playlist_list',['playlists'=>$playlists,'genres'=>$genres,'years' => $years]);
		$this->load->view('layout/footer');
	}

	public function delete($song_id,$playlist_name){
		$this->model_playlist->deleteSong($_SESSION['user_id'][0]->id,$song_id,$playlist_name);
		redirect("playlist/view/{$playlist_name}");
	}


	public function view($playlist_name){
		$order = filter_input(INPUT_GET,'order',FILTER_SANITIZE_SPECIAL_CHARS);
		if ($order == ""){
			$order = "song.name";
		}
		$songs = $this->model_playlist->getSongsOfPlaylist($_SESSION['user_id'][0]->id,$playlist_name,$order);
		$this->load->helper('html');
		$this->load->view('layout/header',['css'=>["assets/playlist.css"],'title'=>str_replace('%20', ' ', $playlist_name),'isConnect'=> isset($_SESSION['user_id'])]);
		$this->load->view('playlist_details',['playlist_name'=>$playlist_name,'songs'=>$songs]);
		$this->load->view('layout/footer');
	}

	public function add(){
		$song_id = filter_input(INPUT_POST,'song_id',FILTER_SANITIZE_SPECIAL_CHARS);
		$playlist_name = filter_input(INPUT_POST,'playlistName',FILTER_SANITIZE_SPECIAL_CHARS);
			if(!$this->model_playlist->AlreadyIn($song_id,$_SESSION["user_id"][0]->id,$playlist_name)){
				$this->model_playlist->addSong($_SESSION["user_id"][0]->id,$playlist_name,$song_id,);
			}
			redirect("playlist/view/$playlist_name");	
	}


	public function addp($song_id,$playlist_name){
		if(!$this->model_playlist->AlreadyIn($song_id,$_SESSION["user_id"][0]->id,$playlist_name)){
				$this->model_playlist->addSong($_SESSION["user_id"][0]->id,$playlist_name,$song_id,);
			}
	
	}

	public function copy($playlist_name){
		$this->model_playlist->copy($_SESSION["user_id"][0]->id,$playlist_name);
		redirect("playlist");	
	}
	public function addAlbum(){
		$album_id = filter_input(INPUT_POST,'album_id',FILTER_SANITIZE_SPECIAL_CHARS);
		$playlist_name = filter_input(INPUT_POST,'playlistName',FILTER_SANITIZE_SPECIAL_CHARS);
		$this->model_playlist->addAllAlbum($_SESSION["user_id"][0]->id,$playlist_name,$album_id);
		redirect("playlist/view/$playlist_name");	
	}
	public function addArtist(){
		$artist_id = filter_input(INPUT_POST,'artist_id',FILTER_SANITIZE_SPECIAL_CHARS);
		$playlist_name = filter_input(INPUT_POST,'playlistName',FILTER_SANITIZE_SPECIAL_CHARS);

		$this->model_playlist->addArtist($_SESSION["user_id"][0]->id,$artist_id,$playlist_name);
		redirect("playlist/view/$playlist_name");	
	}

	public function deletePlaylist($playlist_name){
		$this->model_playlist->deletePlaylist($_SESSION["user_id"][0]->id,$playlist_name);
		redirect("playlist");	

	}


	public function randomPlaylist(){
		$playlist_name = filter_input(INPUT_POST,'playlistName',FILTER_SANITIZE_SPECIAL_CHARS);
		$genre =  filter_input(INPUT_POST,'genre',FILTER_SANITIZE_SPECIAL_CHARS);
		$number =  filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_NUMBER_INT);
		$year = filter_input(INPUT_POST,'year',FILTER_SANITIZE_NUMBER_INT);


		if($playlist_name == ""){
			$playlist_name = "random";
		}
		
		if($genre == ""){
			$genre = "album.genreId";
		}
		
		
		if($year == ""){
			$year = "album.year";
		}
		
		if($number == ""){
			$number = rand(1,20);;
		}

		
		$this->model_playlist->createPlaylist($_SESSION["user_id"][0]->id,$playlist_name);
		
		$random_song = $this->model_music->getSongByConditions($genre,$year);
		

		if(sizeof($random_song) != 0){
			

			for($i=0;$i<$number;$i++){
				$rand = rand(1,sizeof($random_song)-1);
				$this->addp($random_song[$rand]->songId,$playlist_name);	

			}
			
		}

		redirect("playlist/view/{$playlist_name}");
		
	}
	
	public function createPlaylist(){
		$playlist_name = filter_input(INPUT_POST,'playlistName',FILTER_SANITIZE_SPECIAL_CHARS);
		if ($playlist_name != ""){
			$this->model_playlist->createPlaylist($_SESSION["user_id"][0]->id,$playlist_name);
		}
		redirect("playlist");
	}
}
?>