<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getAlbums($albumName,$albumYear,$albumGenre,$order){

		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,album.artistid ,genre.id as genreId,jpeg
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.name LIKE {$albumName} AND album.year = {$albumYear} AND album.genreId = {$albumGenre}
			ORDER BY {$order}
			
			"
		);
	return $query->result();
	}
	public function getAlbumByid($id){
		$query = $this->db->query(
			"SELECT album.name as albumName,album.id as albumId,year,artist.name as artistName, genre.name as genreName,genre.id as genreId,jpeg,artist.id as artistId
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.id = ".$id."
			ORDER BY year
			"
		);
	return $query->result();
	}

	public function getTrackByAlbumId($id){
		$query = $this->db->query(
			"SELECT song.name as songName,song.id as songId,duration as songDuration,number as songNumber
			FROM track 
			JOIN song on track.songId = song.id
			WHERE track.albumId = ".$id."
			ORDER BY number
			"
		);
	return $query->result();
	}
	public function getSongByConditions($genre,$year){
		$query = $this->db->query(
			"SELECT songid as songId FROM song
			JOIN track on track.songId = song.id	
			JOIN album on album.id = track.albumId
			JOIN genre on album.genreId = genre.id
			JOIN artist on artist.id = album.artistId
			WHERE album.genreId = {$genre} and album.year = {$year} "
		);
	return $query->result();
	}


	public function getTrackByArtistId($id_artist){
		$query = $this->db->query(
			"SELECT song.name as songName,song.id as songId,duration as songDuration,number as songNumber
			FROM track 
			JOIN song on song.id = track.songId
			JOIN album on album.id = track.albumId
			WHERE album.artistId = ".$id_artist."
			
			"
		);

	return $query->result();
	}
	public function getAlbumOfSong($album_id){
		$query = $this->db->query(
			"SELECT song.name as songName,song.id as songId,duration as songDuration,number as songNumber
			FROM track 
			JOIN song on track.songId = song.id
			WHERE track.albumId = ".$id."
			ORDER BY number
			"
		);
	return $query->result();
	}


	public function getGenres(){
		$query = $this->db->query(
			"SELECT DISTINCT genre.name as genreName,id as genreId
			FROM genre
			ORDER BY name
			"
		);
	return $query->result();
	}

	public function getYears(){
		$query = $this->db->query(
			"SELECT DISTINCT album.year as albumYear
			FROM album
			ORDER BY year
			"
		);
	return $query->result();
	}
}
