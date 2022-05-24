<?php

$quantitetotal = $_SESSION['quantite'];
// echo count($quantitetotal );
// echo count($lesProduitsDuPanier );

for ($i = 0; $i < count($quantitetotal); $i++) {
	echo "<br>";
	echo $i;
	echo "-";
	echo $quantitetotal[$i];
	echo "<br>";
}

if (count($lesProduitsDuPanier) >= 1) {
	for ($i = 0; $i < count($lesProduitsDuPanier); $i++) {

		$id = $lesProduitsDuPanier[$i]['PDT_id'];
		$description = $lesProduitsDuPanier[$i]['description'];
		$image = $lesProduitsDuPanier[$i]['image'];
		$prix = $lesProduitsDuPanier[$i]['prix'];
		$quantite = $quantitetotal[$i];
?>
		<div class="content-panier">
			<img class="img-panier" src="<?= $image ?>" alt=image width=100 height=100 />

			<p class="desc-produit"><?= $description . "($prix Euros)"; ?></p>
			<div class="quantite-produit">
				<p class="title-quttite">quantite</p>
				<div class="flex-qte">
					<a href="http://localhost/vanille/index.php?uc=gererPanier&action=retirerqte&pos=<?= $i ?>" class="button-qte">-</a>
					<p class="quantiteitem"><?php echo $quantite; ?></p>
					<a href="http://localhost/vanille/index.php?uc=gererPanier&action=ajouterqte&pos=<?= $i ?>" class="button-qte">+</a>
				</div>
			</div>

			<a href=http://localhost/vanille/index.php?uc=gererPanier&action=deleteItem&num=<?= $i ?> class="trashpannier">
				<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#000000" viewBox="0 0 256 256">
					<rect width="256" height="256" fill="none"></rect>
					<line x1="215.99609" y1="56" x2="39.99609" y2="56.00005" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
					<line x1="104" y1="104" x2="104" y2="168" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
					<line x1="152" y1="104" x2="152" y2="168" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
					<path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
					<path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
				</svg>
			</a>
		</div>
		</div>
<?php
	}
}
?>
<br>
<a onClick=deletePannieto()><img src="./images/AnnulerPanier.png"></a>
<a href="http://localhost/vanille/index.php?uc=passerCommande&action=formulaire">
	<div class="button-valid">Valider le panier</div>
</a>
<script>
	function deletePannieto() {
		if (window.confirm("Voulez-vous supprimer votre panier ?")) {
			window.location.href = href = "http://localhost/vanille/index.php?uc=gererPanier&action=deletePanier";
		}
	}
</script>
<br>