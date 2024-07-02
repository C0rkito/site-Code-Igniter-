<form action="<?php echo site_url('auth/login/');?>" method="post">

	<h5>Email</h5>
	<input type="text" name="email" value="" size="50" />

	<h5>Mot de passe</h5>
	<input type="password" name="password" value="" size="50" />

	<div><input type="submit" value="Submit" /></div>

</form>
<button><a href="<?php echo site_url('auth_register') ?>"> Inscription</a></button>
</main>
	</body>
</html>