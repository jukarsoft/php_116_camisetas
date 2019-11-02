<?php
	//inicializar variables
	$u=$color=$siEnvio=null;
	$total=null;
	
	//comprobar si se ha pulsado enviar
	if (isset($_POST['enviar'])) {
		//recuperar datos
		$u=$_POST['unidades'];
		$color=$_POST['color'];
		$siEnvio=$_POST['envio'];
		//validar datos
		if (!is_numeric($u) || $u==''){
			$total="Unidades no numerica";
		} else {
			//calcular precio
			$total=calcularPrecio($u,$color,$siEnvio);
		}
	}
		
	

	//definir función calculo precio
	function calcularPrecio($unidades,$col,$envio) {
		//echo ("$unidades - $col - $envio");
		//recuperar datos
		$precioCamisetaB=10;
		$precioCamisetaC=12;
		$precioEnvio=20;
		
		//calcular precio
		if ($col=="blanca") {
			$precioTotal=$precioCamisetaB*$unidades;
		} else {
			$precioTotal=$precioCamisetaC*$unidades;
		}
		if ($unidades>10) {
			$precioTotal=($precioTotal*90)/100;
		}
		if ($envio=='si') {
			$precioTotal+=20;
		}
		//confeccionar mensaje
		return $resultado="$unidades camisetas de color $col.\nEnvio: $envio \nPrecio total: $precioTotal";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Coste viaje</title>
	<meta charset="utf-8">
	<script type="text/javascript"></script>
	<style type="text/css">
		form {
			width: 25%;
			border:1px solid grey;
			margin:auto;
			padding: 20px;
			box-shadow: 4px 4px 4px grey;
		}	
		textarea{
			width: 100%;
			height: 50px;
		}
		label {
			width: 120px;
			display: inline-block;
		}
	</style>
</head>
<body>
	<form method='post' action='#'>
		<label>Unidades</label>
		<input type="number" name="unidades"  min="1" value="<?=$u;?>">
		<br><br>
		<label>Color</label>
		<select name='color'  value="<?=$color;?>">
			<option <?php if ($color=='blanca') {echo 'selected';}?> >blanca</option>
			<option <?php if ($color=='roja') {echo 'selected';}?> >roja</option>
			<option <?php if ($color=='verde') {echo 'selected';}?> >verde</option>
			<option <?php if ($color=='azul') {echo 'selected';}?> >azul</option>
		</select>
		<br><br>
		<label>Envío:</label>
		<span>Si</span>
		<input type="radio" name="envio" value='si' checked <?php if ($siEnvio=='si') {echo 'checked';}?> >
		<span>No</span>
		<input type="radio" name="envio" value='no' <?php if ($siEnvio=='no') {echo 'checked';}?>>
		<br><br>
		<input type="submit" name="enviar">
		<br><br>
		<textarea><?=$total;?></textarea>
	</form>
</body>
</html>