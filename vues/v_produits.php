<div id="produits">
<?php
echo '    ClIQUEZ A DROITE DU PRODUIT POUR AJOUTER AU PANIER  ';
  
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['PDT_id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
  ?>
<table  cellpadding=10 cellspacing=10>  
	<tr> 
			<td><img src="<?=$image ?>" alt=image /></td>
			<td><?=$description ?></td>
			 <td><?=$prix." Euros" ?></td>
			 <td><a href=index.php?uc=voirProduits&categorie=<?=$categorie ?>&produit=<?=$id ?>&action=ajouterAuPanier> 
			 <img src="images/AjoutPanier.png" TITLE="Ajouter au panier" </td></a>
			
	</tr>
			
<?php			
}
?>
</table>
</div>
