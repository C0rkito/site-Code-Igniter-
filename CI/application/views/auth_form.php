<img src="<?php echo base_url()."assets/background_2.svg"; ?>" id="bg">


<form action="<?php echo site_url('auth/login/');?>" method="post">

	<h5>Email</h5>
	<input type="email" name="email" value="" size="50"/>

	<h5>Mot de passe</h5>
	<input type="password" name="password" value="" size="50" />

	<div><input type="submit" value="Valider" /></div>

</form>
<button onclick="window.location=<?php echo "'".site_url('auth_register')."'" ?>">Inscription</button>
