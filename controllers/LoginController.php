<?php

require_once 'models/LoginModel.php';
require_once 'view/LoginView.php';
require_once "Helpers/AuthHelper.php";

class LoginController {
    private $model;
    private $view;
    private $equipoModel;
    private $divisionModel;
    private $EquipoView;
    private $authHelper;
    private $userModel;

    function __construct() {
        $this->model = new LoginModel();
        $this->view = new LoginView();
        $this->EquipoView = new EquipoView();
        $this->equipoModel = new EquipoModel();
        $this->divisionModel = new DivisionesModel();
        $this->userModel = new UserModel();
        $this->authHelper = new AuthHelper();
    }
    // 
  
    // se loguea el usuario y se guarda en la sesion el nombre del usuario 
    public function login ($username="", $password="") {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->bringUserByNameDB($username);
            if (!empty($user)) {
                if (password_verify($password, $user->password)) {
                    $this->showLogin($username,$user);
                }
                else {
                    $this->EquipoView->traerHome($this->equipoModel->traerEquipos(), $this->divisionModel->traerDivisiones(), 'La contraseña es incorrecta. ');
                }
            }
            else {
                $this->EquipoView->traerHome($this->equipoModel->traerEquipos(), $this->divisionModel->traerDivisiones(), 'El usuario no existe. ');
            }
        }
        else {
            $this->EquipoView->traerHome($this->equipoModel->traerEquipos(), $this->divisionModel->traerDivisiones(), 'Faltan completar campos. ');
        }
    }
    // se inicia sesion y se verifica si el usuario es administrador o no, si es administrador se redirige a la pagina de administración
    public function showLogin($username,$user=null) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = $user->privilege_level;
        if ($_SESSION['admin'] == 1) {
            $this->authHelper->location("home");
        }
        if ($_SESSION['admin'] == 0) {
            $this->authHelper->location("home");
        }
    }
    // se cierra la sesion y se redirige a la pagina de inicio
    public function logout () {
        session_start();
        session_destroy();
        $this->authHelper->location("home");
    }
    // si hay algun error al registrar el usuario se muestra el error
    public function showRegister ($error="",$exito="") {
        $this->view->showRegister($error,$exito);
    }
    
    // se registra el usuario sin permiso de adminstrador y se redirige a la pagina de de usuario normal
    public function completeRegister () {
        if (!empty($_POST['registerUsername'])&&!empty( $_POST['registerPassword'])) {
            $username = $_POST['registerUsername'];
            $password =  $_POST['registerPassword'];
            $passwordHash = password_hash($password,PASSWORD_BCRYPT);
            $alreadyRegistered = false;
            foreach ($this->userModel->bringUsersDB() as $user) {
                if ($username == $user->username && $password !="") {
                    $alreadyRegistered = true;
                    $this->showRegister('Usuario en uso');
                }
            }
            if($alreadyRegistered == false ){
                $this->model->crearUsuario($username,$passwordHash);
                $this->showLogin($username);
            }
        }
        else{
            $this->showRegister('Faltan completar campos');
        }
    }
}