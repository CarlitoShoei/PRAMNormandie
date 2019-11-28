<?php
header( 'content-type: text/html; charset=utf-8' );
header('Content-type: text/html; charset=iso8859-1');
	
//On recupere les variable								
$dirname = $_GET['Lecteur'];
$pattern = ".";
$dir = opendir($dirname);

?>

<table border="0">
	<?php
	$input = 1;
	while(($file = readdir($dir))) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file))
		{
		// echo '<a href="'.$dirname.'\\'.$file.'" target="_bank">'.$file.'</a>'.'<br /><br />';
	
		?>
			<tr>
				<td>
					<?php
						if(stripos($file, '.')){
							?><img src="../../../img/site/logo/<?php echo $file ?>" width="40" onclick="selection_fichier('<?php echo $input ?>')"/><?php
								
						}else{
							?><img src="img/folder.png" width="25" onclick="explore_dossier('listing.php', 'listing', '<?php echo $input ?>')"/><?php
						}
					?>
				</td>
				<td width="5"></td>
				<td>
					<p>
						<?php echo $file ?>
					</p>
				</td>
				<td width="5"></td>
				<td>
					<input width="100%" type="hidden" id="<?php echo $input ?>" value="<?php echo $dirname."/".$file ?>">
				</td>
			</tr>
		<?php
		}
		$input++;
	}
	closedir($dir); 
	?>
</table>