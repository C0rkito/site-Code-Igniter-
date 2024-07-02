<!doctype html>
<html lang="en" class="has-navbar-fixed-top">
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $title?></title>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
/>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
  <?=link_tag('assets/style.css')?> 
  <?php 
    if(isset($css)){
      foreach ($css as $css_file) {
        echo link_tag($css_file);
      }
    }
  ?> 
  
	</head>
  <body>
<header>
			<nav id="menu">
  <ul>
    <li><strong><a href="/~izanic/SAE_S2.02/CI">Muzapp</a></strong></li>
  </ul>
  <ul>
  <li><?=anchor('albums','Albums');?></li>
  <li><?=anchor('artistes','Artistes');?></li>
  <li><?=anchor('song','Sons');?></li>
  <li><?=anchor('playlist','Playlists');?></li>
  <li>
  <?php 
    if($isConnect){
      echo anchor('auth/logout/','Deconnexion');
    }
    else{
      echo anchor('auth/login/','Connexion');
    }
  ?>
  </li>
  </ul>
</nav>
</header>

    <main class='container'>