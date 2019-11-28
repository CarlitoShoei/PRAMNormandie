<script src="../../js/getXhr.js" type="text/javascript"></script>
<script src="../../js/newpram.js" type="text/javascript"></script>
<script type='text/javascript' src='../../js/jquery-1.7.2.min.js'></script>
<script type='text/javascript' src='../../js/jquery.form.js'></script>
<script type='text/javascript'> 
	// wait for the DOM to be loaded 
	$(document).ready(function() { 
		$('#formStudentPhoto').ajaxForm({
			beforeSubmit: function(a,f,o) {
				$('#outputStudentPhoto').html('<img src="../../img/spinner.gif" />');
			},
			success: function(data) {
				$('#outputStudentPhoto').html(data);
			}
		});
	}); 

	$(document).ready(function() { 
		$('#formStudentPhotoCarac').ajaxForm({
				beforeSubmit: function(a,f,o) {
					$('#outputStudentPhotoCarac').html('<img src="../../img/spinner.gif" />');
				},
				success: function(data) {
					$('#outputStudentPhotoCarac').html(data);
				}
			});
	});

	$(document).ready(function() { 
		$('#formStudentSchemaCarac').ajaxForm({
				beforeSubmit: function(a,f,o) {
					$('#outputStudentSchemaCarac').html('<img src="../../img/spinner.gif" />');
				},
				success: function(data) {
					$('#outputStudentSchemaCarac').html(data);
				}
			});
	});
</script> 

<?php 

$typephoto = $_GET['type'];
$ID_Mare = $_GET['ID_Mare'];

if(isset($_GET['idstructureconnectee'])){
	$idstructureconnectee = $_GET['idstructureconnectee'];
}else{
	$idstructureconnectee = "";
}

if(isset($_GET['rolestructure'])){
	$rolestructure = $_GET['rolestructure'];
}else{
	$rolestructure = "";
}

if(isset($_GET['ID_CARAC'])){
	$ID_CARAC = $_GET['ID_CARAC'];
}else{
	$ID_CARAC = "";
}

if($typephoto == 'photolocalisation'){ ?>
	<form id="formStudentPhoto" action="upload_photo.php?ID_Mare=<?php echo $ID_Mare?>&ID_CARAC=<?php echo $ID_CARAC?>" method="post" enctype="multipart/form-data">
		<div id="divStudentPhoto">
			<table width="100%" border="0">
				<tr align="center">
					<td colspan="2">
						<p style="color:red;"><b><em>Attention : la taille des photos doit être inférieure à 2MO.</em></b></p>
					</td>
					<th>
						Aperçu de la photo : 
					</th>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Photo : </th>
					<td width="25%">
						<!--Titre-->
						<!--<input type="input" id="TitreNews" name="TitreNews"></input>-->
						<input type="file" id="studentPhoto" name="studentPhoto" accept="image/jpg, image/JPG, image/JPEG, image/gif, image/jpeg, image/png, image/tiff, image/tif" tabindex="16"></input>
						<input type="hidden" id="studentId" name="studentId" value=""></input>
					</td>
					<td width="25%" rowspan="5">
						<span id="outputStudentPhoto"></span>
					</td>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Description de la photo (falcultatif) : </th>
					<td width="25%">
						<!--Contenu-->
						<input type="input" id="ContenuNews" name="ContenuNews" tabindex="17"></input>
						
					</td>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Enregistrer la photo : </th>
					<td width="25%">
						<!--Contenu-->
						<input type="submit" value="Charger la photo" tabindex="18" onClick="ActuMarePhotoloLad('<?php echo $idstructureconnectee ?>','<?php echo $rolestructure ?>')"></input>
					</td>
				</tr>
			</table>
		</div>
	</form>
<?php }elseif($typephoto == 'photocaracterisation'){ ?>
	<form id="formStudentPhotoCarac" action="upload_photo_Carac.php?ID_Mare=<?php echo $ID_Mare?>&ID_CARAC=<?php echo $ID_CARAC?>" method="post" enctype="multipart/form-data">			
		<div id="divStudentPhoto">
			<table width="100%" height="200px" border='0'>
				<tr align="center">
					<td colspan="2" width="50%">
						<p style="color:red;"><b><em>Attention : la taille des photos doit être inférieure à 2MO.</em></b></p>
					</td>
					<th width="25%">
						Aperçu de la photo : 
					</th>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Photo de caractérisation : </th>
					<td width="25%">
						<!--Titre-->
						<!--<input type="input" id="TitreNews" name="TitreNews"></input>-->
						<input type="file" id="studentPhotoCarac" name="studentPhotoCarac" accept="image/jpg, image/JPG, image/JPEG, image/gif, image/jpeg, image/png, image/tiff, image/tif" tabindex="72"></input>
						<input type="hidden" id="studentIdCarac" name="studentIdCarac" value=""></input>
					</td>
					<td width="25%" rowspan="5">
						<span id="outputStudentPhotoCarac"></span>
					</td>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Description de la photo de caractérisation (falcultatif) : </th>
					<td width="25%">
						<!--Contenu-->
						<input type="input" id="ContenuNewsCarac" name="ContenuNewsCarac" tabindex="73"></input>
					</td>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Enregistrer la photo : </th>
					<td width="25%">
						<input type="submit" value="Charger la photo" tabindex="74"></input>
					</td>
				</tr>
			</table>
		</div>
	</form>
<?php }elseif($typephoto == 'schemacaracterisation'){ ?>
	<form id="formStudentSchemaCarac" action="upload_schema_Carac.php?ID_Mare=<?php echo $ID_Mare?>&ID_CARAC=<?php echo $ID_CARAC?>" method="post" enctype="multipart/form-data">		
		<div id="divStudentSchema">
			<table width="100%">
				<tr align="center">
					<td colspan="2" width="50%">
						<p style="color:red;"><b><em>Attention : la taille des photos doit être inférieure à 2MO.</em></b></p>
					</td>
					<th width="25%">
						Aperçu de la photo : 
					</th>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Schéma de caractérisation (scan image) : </th>
					<td width="25%">
						<!--Titre-->
						<!--<input type="input" id="TitreNews" name="TitreNews"></input>-->
						<input type="file" id="studentSchemaCarac" name="studentSchemaCarac" accept="image/jpg, image/JPG, image/JPEG, image/gif, image/jpeg, image/png, image/tiff, image/tif" tabindex="72"></input>
						<input type="hidden" id="studentIdSchema" name="studentIdSchema" value=""></input>
					</td>
					<td width="25%" rowspan="5">
						<span id="outputStudentSchemaCarac"></span>
					</td>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Description du schéma de caractérisation (falcultatif) : </th>
					<td width="25%">
						<!--Contenu-->
						<input type="input" id="ContenuNewsSchema" name="ContenuNewsSchema" tabindex="73"></input>
						
					</td>
				</tr>
				<tr height="3"></tr>
				<tr align="center">
					<th width="50%" align="left">Enregistrer la photo : </th>
					<td width="25%">
						<input type="submit" value="Charger la photo" tabindex="74"></input>
					</td>
				</tr>
			</table>
		</div>
	</form>
<?php } ?>


