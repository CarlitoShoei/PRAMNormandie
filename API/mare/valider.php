<?php
	header( 'content-type: text/html; charset=utf-8' );
	header('Content-type: text/html; charset=iso8859-1');
	$type = $_GET['type'];
?>
<?php if(strstr($_GET['type'],'enregistrmentmare')){ ?>
	<p style="font-size:14px"><b>Les donn�es de la mare ont bien �t� enregistr�es. Vous pouvez fermer la fen�tre.</b></p>
<?php }elseif(strstr($_GET['type'],'supprimephotoloca')){ ?>
	<p style="font-size:14px"><b>La photo de localisation a bien �t� supprim�e.</b></p>
<?php } ?>