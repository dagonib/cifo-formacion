<?php
	$errors = [];
	$qualificacio;

	// NIF
	try {
		$nif = trim(filter_input(INPUT_POST, 'nif'));
		if (!$nif) {
			throw new Exception('NIF obligatori');
		}
	} catch (Exception $e) {
		$errors[] = $e->getMessage();
	}

	// Nombre
	try {
		$nombre = trim(filter_input(INPUT_POST, 'nombre'));
		if (!$nombre) {
			throw new Exception('Nom obligatori');
		}
	} catch (Exception $e) {
		$errors[] = $e->getMessage();
	}

	// Apellidos
	try {
		$apellidos = trim(filter_input(INPUT_POST, 'apellidos'));
		if (!$apellidos) {
			throw new Exception('Cognoms obligatoris');
		}
	} catch (Exception $e) {
		$errors[] = $e->getMessage();
	}
		
	// Nota
	try {
		$nota = trim(filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_INT));
		if ($nota === false || ($nota < 0 || $nota > 10)) {
			throw new Exception('Nota obligatoria o nota no númerica');
		}
		if ($nota < 5) {
			$qualificacio = 'Suspenso';
		} else if ($nota >= 5 && $nota < 7) {
			$qualificacio = 'Aprobado';
		} else if ($nota >= 7 && $nota < 9) {
			$qualificacio = 'Notable';
		} else {
			$qualificacio = 'Excelente';
		}
	} catch (Exception $e) {
		$errors[] = $e->getMessage();
	}
		
	// Email
	try {		
		$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
		if (!$email) {
			throw new Exception('email obligatori o formato incorrecte');
		}
	} catch (Exception $e) {
		$errors[] = $e->getMessage();
	}

	// Mensaje
	try {
		$mensaje = trim(filter_input(INPUT_POST,'mensaje'));
		if (!$mensaje) {
			throw new Exception('missatge obligatori');
		}
	} catch (Exception $e) {
		$errors[] = $e->getMessage();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PLA01</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css?v=1.0">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>PLA01: MOSTRAR DADES</h1>
		<div class='card'>
			<p>
				<input type="text" placeholder="nif" disabled value=<?php echo $nif ?>>
			</p>

			<p>
				<input type="text" placeholder="nom" disabled value=<?php echo $nombre ?>>				
			
				<input type="text" placeholder="cognoms" disabled value=<?php echo $apellidos ?>>
			</p>

			<div class='qualification'>
				<input type="text" placeholder="qualificació" disabled 
						value=
							<?php if (isset($qualificacio)) : '' ?>
								<?php echo $qualificacio ?>
							<?php endif; ?>
				>

				<!--aqui iran las cajitas <aside></aside>-->
				<div>
					<?php if ($nota !== false): ?>
						<?php for($i = 0; $i <= min($nota, 10); $i++): ?>
							<?php
								$color = '';
								if ($i < 5) {
									$color = 'rojo';
								} else if ($i < 7) {
									$color = 'amarillo';
								} else if ($i < 9) {
									$color = 'verde';
								} else {
									$color = 'azul';
								}
							?>
							<aside class=<?php echo $color ?>></aside>
						<?php endfor; ?>
					<?php endif; ?>
				</div>
			</div>

			<p>
				<input type="text" placeholder="email" disabled value=<?php echo $email ?>>
			</p>

			<p>
				<textarea  cols='22' rows='5' disabled><?php echo $mensaje ?></textarea>
			</p>

			
			
			<?php foreach ($errors as $error): ?>
				<p class='errores'><?php echo $error; ?></p>
			<?php endforeach; ?>
		</div>
	</div>
</body>
</html>