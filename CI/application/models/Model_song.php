<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_song extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getSongs($songName,$songYear,$songGenre){
		$query = $this->db->query(
		"
		SELECT DISTINCT song.name as songName, track.albumId as albumId
		FROM song
		JOIN track on track.songId = song.id
		JOIN album on album.id = track.albumId
		JOIN genre ON genre.id = album.genreid
		WHERE song.name LIKE {$songName} AND album.year = {$songYear} AND album.genreId = {$songGenre}
		ORDER BY song.name
		"
	);
	return $query->result();
	}


}
