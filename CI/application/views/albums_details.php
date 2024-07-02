<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">

<main>
        <section class="artist-info">
            <?php
                echo "<h1>" . anchor("artistes/view/{$info->artistId}", "{$info->artistName}") . "</h1>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($info->jpeg) . '" alt="Album cover" />';
            ?> 
        </section>
        
        <aside class="album-info">
            
            <?php 



        
        

if (isset($_SESSION['user_id'])){
    if(count($playlists)!=0){
        echo "<form action = '".site_url('playlist/addAlbum')."' method='post'>";
        echo "<select name = 'playlistName'>";
        foreach($playlists as $playlist){
            echo "<option  value='$playlist->name'>$playlist->name</option>";
            echo "<br>";
        }
        echo "</select>";
        echo "<input type='hidden' name = 'album_id' value='$info->albumId'></input>";
        echo "<input type='submit'>";
        echo "</form>";
    }
    else{
        echo anchor("playlist","Create playlist");
    }
}
else{

    echo anchor("auth/login","Login to an account");
}
        
                echo "<h2>";
                echo $info->albumName;
                echo "</h2>";
                echo "<h3>";
                echo anchor("albums?albumYear=".$info->year,"{$info->year}");
                echo "</h3>";
                echo "<h4>";
                echo anchor("albums?albumGenre=".$info->genreId,"{$info->genreName}");
                echo "</h4>";

                echo "<ol>";
                foreach ($track as $song) {
                    $duration_minutes = floor($song->songDuration / 60); 
                    $duration_seconds = $song->songDuration % 60; 

                    echo "<li><span class='song-number'>".$song->songNumber."."."</span> <span class='song-name'>". $song->songName . " </span><i>" .$duration_minutes . " min "; 
                    if ($duration_seconds != 0){
                         echo $duration_seconds ." sec</i>";
                    }


                    if (isset($_SESSION['user_id'])){
                        if(count($playlists)!=0){
                            echo "<form action = '".site_url('playlist/add')."' method='post'>";
                            echo "<select name = 'playlistName'>";
                            foreach($playlists as $playlist){
                                echo "<option  value='$playlist->name'>$playlist->name</option>";
                                echo "<br>";
                            }
                            echo "</select>";
                            echo "<input type='hidden' name = 'song_id' value='$song->songId'></input>";
                            echo "<input type='submit'>";
                            echo "</form>";
                        }
                    }
                }
            ?>
        </aside>
</main>