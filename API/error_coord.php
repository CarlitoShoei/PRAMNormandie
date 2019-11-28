<?php $typecoord = $_GET['typecoord']; ?>
	
<?php if($typecoord == 'latlng'){ ?>
	<p style="color:white"><b>Merci de saisir la longitude et la latitude de la coordonnée recherchée.</b></p>
<?php }elseif($typecoord == 'lambert93'){ ?>
	<p style="color:white"><b>Merci de saisir le X et le Y de la coordonnée recherchée.</b></p>
<?php } ?>