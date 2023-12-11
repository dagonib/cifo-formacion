<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PLA01</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>PLA01: FORMULARI</h1>
		<form method="post" action="PLA01_mostrardatos.php">
			<p>
				<label for='nif'>Nif</label>
				<input type="text" name="nif" id='nif'>
			</p>

			<p>
				<label for='nombre'>Nom</label>
				<input type="text" name="nombre" id='nombre'>
			</p>
			
			<p>
				<label for='apellidos'>Gognoms</label>
				<input type="text" name="apellidos" id='apellidos'>
			</p>
			
			<p>
				<label for='email'>Email</label>
				<input type="email" name="email" id='email'>
			</p>
			
			<p>
				<label for='nota'>Nota exàmen</label>
				<input type="number" name="nota" id='nota'>
			</p>
			
			<p>
				<label for='mensaje'>Missatge</label>
				<textarea name='mensaje' id='mensaje' cols='22' rows='5'></textarea>
			</p>
			
			<p>
				<label></label>
				<input type="submit" name="Enviar">
			</p>
		</form>
	</div>
</body>
</html>