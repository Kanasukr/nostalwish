<p>Merci de vous authentifier :</p>
<form id="login" action="functions/login.php" method="POST">
	<input type="text" name="account_name" placeholder="Nom de compte">
	<input type="password" name="account_password" placeholder="Mot de passe">
	<input type="submit" name="submit" value="Valider">
</form>
<p>Pas de compte ? S'enregistrer :</p>
<form id="register" action="functions/register.php" method="POST">
	<input type="text" name="account_name" placeholder="Nom de compte">
	<input type="text" name="account_email" placeholder="email@hote.fr">
	<input type="password" name="account_password" placeholder="Mot de passe">
	<input type="submit" name="submit" value="Valider">
</form>