<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">
<h5>Songs list</h5>

<?php echo $nb." results";?>
<aside class="filter-song">

	<form method="get">

		<label>Filtre par nom</label>
		<input type="search" name="songName">
		<label> Filtre par genre</label>
		<select name="songGenre">
			<option value='album.genreId'> None</option>
			<?php
				foreach($genres as $genre){
					echo "<option value={$genre->genreId}> {$genre->genreName}</option>";
				}
			?>
		</select>

		<label>Filtre par annee</label>
		<select name="songYear">
			<option value='album.year'> None</option>
			<?php
				foreach($years as $year){
					echo "<option value={$year->albumYear}> {$year->albumYear}</option>";
				}
			?>
		</select>

		<button type="submit"> Recherche</button>
	</form>
</aside>


<section class="list songs-list">
<?php
foreach($songs as $song){
	echo "<div>";
	echo "<p>".anchor("albums/view/{$song->albumId}","{$song->songName}");
	echo "</p>";
	echo "</div>";
}
?>
</section>
