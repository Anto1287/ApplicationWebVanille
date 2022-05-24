<div id="categories">

<h2 class="title-co">Selectionnez une catégories pour modifier un produit</h2>

<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['CAT_id'];
	$libCategorie = $uneCategorie['libelle'];
  ?>
	<div>
		<a href=index.php?uc=gererProduits&etatGestion=voirProduits&cat=<?=$idCategorie ?>&action=voirProduits><?=$libCategorie ?></a>
	</div>
<?php
}
?>
</div>
