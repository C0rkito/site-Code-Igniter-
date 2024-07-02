<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">


<?php 
echo "<h1>".$playlist_name."</h1>";

echo "<div class = song-list>";
foreach($songs as $song){

	echo "<div class='song-play>'";
	echo "<span >$song->songName</span>";
	echo anchor("playlist/delete/{$song->songId}/{$playlist_name}","delete");
	echo "</div>";
	

}

echo "</div>";
?>