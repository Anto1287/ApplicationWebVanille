<div id="produits">
<?php
  
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
			 <td><div class="btn-co-produits" style="background: #0b5ed7"><a href="index.php?uc=gererProduits&etatGestion=modifierProduit&idProduit=<?=$id ?>">Modifier</a></div></td>
			 <td><div class="btn-co-produits" style="background: #ff424f">Supprimer</div></td>
			
	</tr>
			
<?php			
}
?>
</table>
</div>
