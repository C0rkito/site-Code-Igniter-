<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">


<div>
<article>


<?php 


		
		if (isset($_SESSION['user_id'])){
			if(count($playlists)!=0){
				echo "<form action = '".site_url('playlist/addArtist')."' method='post'>";
				echo "<select name = 'playlistName'>";
				foreach($playlists as $playlist){
					echo "<option  value='$playlist->name'>$playlist->name</option>";
					echo "<br>";
				}
				echo "</select>";
				echo "<input type='hidden' name = 'artist_id' value='$infos->artistId'></input>";
				echo "<input type='submit' value = 'Valider'>";
				echo "</form>";
			}
			else{
				echo anchor("playlist","Créer playlist");
			}
		}
		else{

			echo anchor("auth/login","Connectez-vous");
		}
		
		
		echo "<section><h2>".$infos->artistName."</h2></section>";
		echo "<img src=".$infos->artistImage.">";
		echo "<aside id='album-list'>";
		
		$num = 0;
		foreach($albums as $album){
			echo "<h6>".anchor("albums/view/{$album->albumId}","{$album->albumName}")." - ".$album->albumYear;"</h6>";
			echo '<img alt="album cover" src="data:image/jpeg;base64,'.base64_encode($album->albumCover).'">';
		}

		echo "</aside>";
?> 


</article>
</div>
