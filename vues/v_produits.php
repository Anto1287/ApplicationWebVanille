<div id="produits">
<?php
echo '    <p>ClIQUEZ SUR LE PANIER POUR AJOUTER LE PRODUIT</p> ';
  
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['PDT_id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
  ?>
<table  cellpadding=10 width=100% cellspacing=0>  
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
