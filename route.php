<?php

require_once 'controllers/LoginController.php';
require_once 'controllers/EquipoController.php';
require_once 'controllers/DivisionController.php';
require_once 'controllers/UserController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['operacion'])) {
    $operacion = $_GET['operacion'];
} else {
    $operacion = 'home';     // acción por defecto si no envían
}

    $EquipoController = new EquipoController(); 
    $DivisionController = new DivisionController(); 
    $LoginController = new LoginController();
    $UserController = new UserController();
    
    $parametros = explode('/', $operacion);

    switch ($parametros[0]) {
        case 'home': 
            $EquipoController->equipos();
            break;
        case 'divisiones': 
            $DivisionController->divisiones();
            break;  
        case 'equipo': 
            $EquipoController->verEquipo($parametros[1]);
            break; 
        case 'filtrar': 
            $EquipoController->filtrar();
            break;  
        case 'adminDivisiones': 
            $DivisionController->adminDivisiones();
            break;  
        case 'adminEquipo':
            $EquipoController->adminEquipo();
            break;
        case 'usersList':
            $UserController->showUsersAPI();
            break;
        case 'register':
            $LoginController->showRegister();
            break;
        case 'registerMesage':
            $LoginController->completeRegister();
            break;
        case 'login':
            $LoginController->login();
            break;
        case 'eliminarEquipo': 
            $EquipoController->eliminarEquipo($parametros[1]);
            break;  
        case 'eliminarDivision': 
            $DivisionController->eliminarDivision($parametros[1]);
            break; 
        case 'agregarEquipo': 
            $EquipoController->agregarEquipo();
            break;  
        case 'agregarDivision': 
            $DivisionController->agregarDivision();
            break;
        case 'logout':
            $LoginController->logout();
            break;
        case 'eliminarUser':
           // $UserController->deleteUser($parametros[1]);
        case "modificarEquipo":
            $EquipoController->TraerParamodificarEquipo($parametros[1]);
            break;
        case "actualizarEquipo":
            $EquipoController->actualizarEquipo();
            break;
        case "modificarDivision":
            $DivisionController->TraerParamodificarDivision($parametros[1]);
            break;
        case "actualizarDivision":
            $DivisionController->actualizarDivision();
            break;
        case "busquedaAvanzada":
            $EquipoController->busquedaAvanzada();
            break;
        default:
            $EquipoController->pageNoteFound();
            break;
    }
