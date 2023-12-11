<?php
    session_start();
	const PRECIO_HOTEL = 60;
	const COSTE_AVION_MADRID = 150;
	const COSTE_AVION_PARIS = 250;
	const COSTE_AVION_LOS_ANGELES = 450;
	const COSTE_AVION_ROMA = 200;
	const COSTE_COCHE = 40;
	const DESCUENTO_COCHE_3_DIAS = 20;
	const DESCUENTO_COCHE_7_DIAS = 50;

    // Hola
    
	$errors = [];
	$total = 0;
	$costeAvion = 0;
	$costeCoche = 0;
	$costeHotel = 0;
    $ciudad = null;	
	
    // Número de noches
    try {
        $noches = filter_input(INPUT_POST, 'noches', FILTER_VALIDATE_INT);
        if (!is_numeric($noches) || $noches === false || $noches < 1) {
            throw new Exception('Noches debe ser numérico y mayor que 0');
        }
        $costeHotel = costeHotel($noches);
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }

    // Ciudad
    try {
        $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
        if (!$ciudad) {
            throw new Exception('Ciudad obligatoria o no valida');
        }

        $costeAvion = costeAvion($ciudad);
        
        if ($costeAvion == -1) {
            throw new Exception('Ciudad no válida');
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }

    // Días alquiler coche
    try {
        $coche = filter_input(INPUT_POST, 'coche', FILTER_VALIDATE_INT);	
        if ($coche === false || $coche < 0) {
            throw new Exception('Días alquiler coche obligatorio o dato no numérico');
        } else if ($coche > $noches) {
            throw new Exception('Dias de alquiler no puede superar a días de estancia');
        }
        $costeCoche = costeCoche($coche);
        if ($costeCoche == -1) {
            throw new Exception('Ciudad no válida');
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }

    $total = $costeHotel + $costeAvion + $costeCoche;

    $_SESSION['datos'] = compact('noches', 'ciudad', 'coche', 'total', 'errors');
	header("Location: ../PLA02_Coste_Hotel.php");

	function costeHotel($noches) {
		return $noches * PRECIO_HOTEL;
	}

	function costeAvion($ciudad) {
		if ($ciudad == 'Madrid') {
			return COSTE_AVION_MADRID;
		} else if ($ciudad == 'Paris') {
			return COSTE_AVION_PARIS;
		} else if ($ciudad == 'Los Angeles') {
			return COSTE_AVION_LOS_ANGELES;
		} else if ($ciudad == 'Roma') {
			return COSTE_AVION_ROMA;
		} else {
			return -1;
		}
	}

	function costeCoche($coche) {
		$costeCoche = $coche * COSTE_COCHE;
		if ($coche < 3) {
            return $costeCoche;
        } else if ($coche >= 3 && $coche < 7) {
			return $costeCoche - DESCUENTO_COCHE_3_DIAS;
		} else if ($coche >= 7) {
			return $costeCoche - DESCUENTO_COCHE_7_DIAS;
		}
	}
?>