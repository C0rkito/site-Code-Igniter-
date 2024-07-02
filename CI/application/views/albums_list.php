
	 
    <img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">

<h3 id="search">
<?php

	$order = "";
	if(isset($_GET["order"]) && $_GET["order"] != ""){
		$order = "<div> order by ".str_replace("."," ",$_GET["order"])."</div>";
	}


	$name = "";
	if(isset($_GET["albumName"]) && $_GET["albumName"] != ""){
		$name = "<div> name =  ".$_GET["albumName"]."</div>";
	}

	$year = "";
	if(isset($_GET["albumYear"]) && $_GET["albumYear"] != ""){
		$year = "<div> year =  ".$_GET["albumYear"]."</div>";
		
	}

	$genre = "";
	if(isset($_GET["albumGenre"]) && $_GET["albumGenre"] != ""){
		$genre = "<div> genre =  ".$_GET["albumGenre"]."</div>";	
	}
		


	echo "<div>".$nb." results</div>";
	echo $name.$genre.$year.$order;
 ?>
 </h3>
<aside class="filter-albums">

	<form method="get">

		<label>Filtre par nom</label>
		<input type="search" name="albumName">
		<label> Filtre par genre</label>
		<select name="albumGenre">
			<option value=''> None</option>
			<?php
				foreach($genres as $genre){
					echo "<option value={$genre->genreId}> {$genre->genreName}</option>";
				}
			?>
		</select>

		<label>Filtre par annee</label>
		<select name="albumYear">
			<option value=''> None</option>
			<?php
				foreach($years as $year){
					echo "<option value={$year->albumYear}> {$year->albumYear}</option>";
				}
			?>
		</select>
		<button type="submit"> Recherche</button>
	</form>
	<div class="order-list">

	<button onclick="window.location=
	<?php 
	echo "'".base_url()."?".$_SERVER["QUERY_STRING"].'&order=artist.name'."'" 
	?>
	">Nom</button>

	<button onclick="window.location=<?php echo "'".base_url()."?".$_SERVER["QUERY_STRING"].'&order=album.year'."'" ?>">Annees</button>
	<button onclick="window.location=<?php echo "'".base_url()."?".$_SERVER["QUERY_STRING"].'&order=album.genreId'."'" ?>">genre</button>
</div>	
</aside>

<section class="list albums-list">

<?php
foreach($albums as $album){
	echo "<div id= album_".$album->id."><article>";
	echo "<header class='short-text'>";
	echo "<h4>";
	echo anchor("albums/view/{$album->id}","{$album->name}");
	echo "</h4>";
	echo "<h5>";
	echo anchor("albums?albumGenre=".$album->genreId,"{$album->genreName}");
	echo "</h5>";
	echo "</header>";
	echo "<a href='albums/view/{$album->id}'>";
	echo '<img alt="album cover" src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'"/>';
	echo "</a>";

	echo "<footer class='short-text'>";
		echo "<h6>";
			echo anchor("albums?albumYear=".$album->year,"{$album->year}");
			echo "-";
			echo anchor("artistes/view/{$album->artistid}","{$album->artistName}");
		echo "</h6>";
	echo "</footer>";

	echo "</article></div>";
}
?>
</section>




