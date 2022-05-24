<div id="categories">
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['CAT_id'];
	$libCategorie = $uneCategorie['libelle'];
  ?>
	<div>
		<a href=index.php?uc=voirProduits&categorie=<?=$idCategorie ?>&action=voirProduits><?=$libCategorie ?></a>
	</div>
<?php
}
?>
</div>
