<?php
	header( 'content-type: text/html; charset=utf-8' );
	header('Content-type: text/html; charset=iso8859-1');
	$type = $_GET['type'];
?>
<?php if(strstr($_GET['type'],'enregistrmentmare')){ ?>
	<p style="font-size:14px"><b>Les données de la mare ont bien été enregistrées. Vous pouvez fermer la fenêtre.</b></p>
<?php }elseif(strstr($_GET['type'],'supprimephotoloca')){ ?>
	<p style="font-size:14px"><b>La photo de localisation a bien été supprimée.</b></p>
<?php } ?>