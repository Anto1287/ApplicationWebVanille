<h2 class="title-command">Entrez vos informations pour passer commande</h2>
<div class="body-formulaire-command">
    <form action="index.php?uc=passerCommande&action=validation" method="POST">
        <div class="flex-command">
            <div class="w-50">
                <label class="label-command">Nom et prénom</label>
                <input class="input-command" name="nomPrenomClient" value="<?=$nomPrenomClient ?>" style='width: 95%' type="text"></input>
            </div>
            <div class="w-50">
                <label class="label-command">Adresse Mail</label>
                <input class="input-command" name="mailClient" value="<?=$mailClient ?>" style='width: 95%' type="text"></input>
            </div>
        </div>
        <br>
        <label class="label-command">Adresse</label>
        <input class="input-command" name="adresseRueClient" value="<?=$adresseRueClient ?>" type="text"></input>
        <br>
        <div class="flex-command">
            <div class="w-50">
                <label class="label-command">Code postal</label>
                <input class="input-command" name="cpClient" value="<?=$cpClient ?>" style='width: 95%' type="text"></input>
            </div>
            <div class="w-50">
                <label class="label-command">Ville</label>
                <input class="input-command" name="villeClient" value="<?=$villeClient ?>" style='width: 95%' type="text"></input>
            </div>
        </div>

        <!-- // Router avec le controleur pour qu'il ajoute toutes les informations en base de données -->
        <div class="centragebutton">
            <input type="submit" class="btn-passercommande" value='Valider informations'></input>
        </div>
    </form>
</div>