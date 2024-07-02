
<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">

<aside class="create-playlist">
	<h3> Créer Playlist</h3>
<form action="<?php echo "playlist/createPlaylist/";?>" method="post">
	<label> Nom </label>
	<input type="text" name="playlistName"  pattern="[A-Za-z0-9]{1,25}">
	<input type="submit" name="Submit">
</form>
</aside>

<aside class="random-playlist">

	<h3> Playlist aléatoire</h3>
	<form action="<?php echo "playlist/randomPlaylist/";?>"  method="post">
		<label> Nom </label>
		<input type="text" name="playlistName"  pattern="[A-Za-z0-9]{1,25}">
		
		<label> Nombre </label>
		<input type="number" name="nombre" min ="1" max='4500'>

		<label> Filtre par genre</label>
			<select name="genre">
				<option value=''> None</option>
				<?php
					foreach($genres as $genre){
						echo "<option value={$genre->genreId}> {$genre->genreName}</option>";
					}
				?>
			</select>
			<label> Filtre par annee</label>
			<select name="year">
				<option value=''> None</option>
				<?php
					foreach($years as $year){
						echo "<option value={$year->albumYear}> {$year->albumYear}</option>";
					}
				?>
			</select>
		<input type="submit" name="Submit">
	</form>
</aside>
<ul class="playlist-list">
<?php

foreach($playlists as $playlist){
	echo "<li>".anchor("playlist/view/{$playlist->name}","{$playlist->name}");
	echo "  ".anchor("playlist/deletePlaylist/{$playlist->name}","Delete");
	echo "  ".anchor("playlist/copy/{$playlist->name}","Copy");"</li>";
}
?>
</ul>