<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_artist extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getArtists($artistName,$order){
		$query = $this->db->query(
		"SELECT DISTINCT id as artistId,name as artistName,artist.Image as artistImage
		FROM artist
		WHERE artist.name LIKE {$artistName}
		ORDER BY {$order}
		"
	);
	return $query->result();
	}

	public function getArtistById($id){
		$query = $this->db->query(
		"SELECT DISTINCT id as artistId,name as artistName,Image as artistImage
		FROM artist
		WHERE id = ".$id."
		ORDER BY name
		"
	);
	return $query->result();
	}

	public function getAlbumsByArtist($id){
		$query = $this->db->query(
		"SELECT DISTINCT album.id as albumId,name as albumName ,year as albumYear,cover.jpeg as albumCover 
		FROM album
		JOIN cover ON cover.id = album.coverID
		WHERE album.artistId = ".$id."
		ORDER BY year
		"
	);
	return $query->result();
	}
}
