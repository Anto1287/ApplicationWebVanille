<div id="PageConnexion">
<form method="POST" action="index.php?uc=gererProduits&action=connexionAdmin">
  
    <fieldset>
     <legend>CONNEXION ADMINISTRATEUR</legend>

		<p>
			<label for="nom">Nom </label>
			<input id="Nom" type="text" name="Nom" value="<?=$nom ?>" size="30" maxlength="45" required>
		</p>

        <p>
			<label for="motdepasse">Mot de passe </label>
			<input id="motdepasse" type="password" name="motdepasse" value="<?=$mdp ?>" size="30" maxlength="45" required>
		</p>

        <p>
         	<input type="submit" value="Se connecter" name="Seconnecter">
        </p>

</form>
</div>