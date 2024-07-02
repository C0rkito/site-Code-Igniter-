<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_playlist extends CI_Model {


	public function __construct(){
		$this->load->database();
		$this->load->model('model_music');

	}

	public function getPlaylists($user_id){
		$query = $this->db->query(
		"SELECT playlist.name from playlist WHERE playlist.owner = {$user_id}
		"
	);
	return $query->result();
	}

	public function deleteSong($user_id,$song_id,$playlist_name){
		$query = $this->db->query("DELETE FROM playlist_songs WHERE id_owner = {$user_id} and playlist_name = '{$playlist_name}' and id_song = '{$song_id}'");
	}

	public function copy($user_id,$playlist_name){

		$new_name = $playlist_name."_copy";
		if (strlen($new_name) < 25 && $this->checkPlaylists($new_name)){

			
			$query = $this->db->query("INSERT INTO  playlist VALUES ({$user_id},'{$new_name}')");

			$song_list = $this->getSongsOfPlaylist($user_id,$playlist_name,"song.name");

			$i = 0;
			$sql = [""];
			foreach($song_list as $song){
				$sql[] = "({$user_id},'{$new_name}',{$song->songId})";
				$i +=1;
				
			}

			$s ="";
			foreach($sql as $elt){
				$s = $s.$elt.","; 
			}
			$s = substr($s,1);
			$s = substr($s,0,-1);
			if ($i != 0){
				$query = $this->db->query("INSERT INTO playlist_songs VALUES ".$s);	
			}
		}
		
	}
	public function getSongsOfPlaylist($user_id,$playlist_name,$order){
		$query = $this->db->query(
		"
		SELECT DISTINCT id_song as songId,song.name as songName from playlist_songs 
        join song on song.id = id_song
		where id_owner = {$user_id} and playlist_name = '{$playlist_name}'
		ORDER BY {$order};

		"
	);
	return $query->result();
	}

	public function AlreadyIn($song_id,$id_owner,$playlist_name){
		$query = $this->db->query(
		"SELECT id_song from playlist_songs where id_owner = '{$id_owner}' and playlist_name = '{$playlist_name}'
		");
		foreach ($query->result() as $song) {
			if($song->id_song == $song_id){
				return 1;
			}
		}
		return 0;
	}
	public function addSong($user_id,$playlist_name,$song_id){
		$query = $this->db->query(
		"INSERT INTO playlist_songs VALUES('{$user_id}','{$playlist_name}','{$song_id}')
		");
	}

	public function addAllAlbum($user_id,$playlist_name,$album_id){
		$song_list = $this->model_music->getTrackByAlbumId($album_id);
		$i = 0;
		$sql = [""];
		foreach($song_list as $song){
			if (!$this->AlreadyIn($song->songId,$user_id,$playlist_name)){
				$sql[] = "({$user_id},'{$playlist_name}',{$song->songId})";
				$i +=1;
			}
		}

		$s ="";
		foreach($sql as $elt){
			$s = $s.$elt.","; 
		}
		$s = substr($s,1);
		$s = substr($s,0,-1);
		if ($i != 0){
			$query = $this->db->query("INSERT INTO playlist_songs VALUES ".$s);	
		}
		

	}
	public function addArtist($user_id,$artist_id,$playlist_name){
		$song_list = $this->model_music->getTrackByArtistId($artist_id);
		$i = 0;
		$sql = [""];
		foreach($song_list as $song){
			if (!$this->AlreadyIn($song->songId,$user_id,$playlist_name)){
				if(!in_array("({$user_id},'{$playlist_name}',{$song->songId})",$sql)){
					$sql[] = "({$user_id},'{$playlist_name}',{$song->songId})";
					$i +=1;
				}
			}

		}

		$s ="";
		foreach($sql as $elt){
			$s = $s.$elt.","; 
		}
		$s = substr($s,1);
		$s = substr($s,0,-1);

		if ($i != 0){
			$query = $this->db->query("INSERT INTO playlist_songs VALUES ".$s);	
		}
		
	}

	public function deletePlaylist($user_id,$playlist_name){
		$query = $this->db->query("DELETE FROM playlist_songs where id_owner = {$user_id} and playlist_name = '{$playlist_name}'  ");

		$query2 = $this->db->query("DELETE FROM playlist where owner = {$user_id} and name = '{$playlist_name}'  ");
	}

	public function checkPlaylists($playlist_name){
		foreach ($this->model_playlist->getPlaylists($_SESSION["user_id"][0]->id) as $play) {
			if($play->name == $playlist_name){
				return 0;
			}	
		}
		return 1;
	}


	public function createPlaylist($id_user,$playlist_name){

		if($this->model_playlist->checkPlaylists($playlist_name)){
			$query = $this->db->query("INSERT iNTO playlist VALUES ('{$id_user}','{$playlist_name}')");
		}
		

	}

}
