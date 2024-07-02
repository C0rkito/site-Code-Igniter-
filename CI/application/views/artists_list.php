<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">


<aside class="filter-artist">

	<form method="get">
		<label>Filtre par nom</label>
		<input type="search" name="artistName">
		<button type="submit"> Recherche</button>
	</form>
		

</aside>


<section class="list artist-list">
<?php

foreach($artists as $artist){

	echo "<article class='artist-info'>";
		echo "<a href='artistes/view/{$artist->artistId}'>";
			echo "<img alt='Artist image' class='artist' src=".$artist->artistImage.">";
		echo "</a>";
		echo anchor("artistes/view/{$artist->artistId}","{$artist->artistName}");
	echo "</article>";


}

?>
<ul>
</section>
