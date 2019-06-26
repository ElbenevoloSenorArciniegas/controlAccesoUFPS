<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    La vie est composé de combien de fois nous rions avant de mourir  \\
include_once realpath('AutorizacionController.php');
include_once realpath('EntradaController.php');
include_once realpath('IdentificadorController.php');
include_once realpath('IntentoController.php');
include_once realpath('PersonaController.php');

$ruta = strip_tags($_POST['ruta']);
    	$rtn = "";
    	switch ($ruta) {
           case 'AutorizacionInsert':
    			$rtn = AutorizacionController::insert();
    			break;
    		case 'AutorizacionList':
    			$rtn = AutorizacionController::listAll();
    			break;
        case 'AutorizacionListByPersona':
          $rtn = AutorizacionController::listByPersona();
          break;
           case 'EntradaInsert':
    			$rtn = EntradaController::insert();
    			break;
    		case 'EntradaList':
    			$rtn = EntradaController::listAll();
    			break;
           case 'IdentificadorInsert':
    			$rtn = IdentificadorController::insert();
    			break;
    		case 'IdentificadorList':
    			$rtn = IdentificadorController::listAll();
    			break;
           case 'IntentoInsert':
    			$rtn = IntentoController::insert();
    			break;
    		case 'IntentoList':
    			$rtn = IntentoController::listAll();
    			break;
           case 'PersonaInsert':
    			$rtn = PersonaController::insert();
    			break;
    		case 'PersonaList':
    			$rtn = PersonaController::listAll();
    			break;
        case "PersonaSelect":
          $rtn = PersonaController::select();
          break;
    		default:
    			$rtn="404 Ruta no encontrada.";
    			break;
    	}

echo $rtn;

//That's all folks!