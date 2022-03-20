<?php

class AuthHelper{

    function __construct(){
    }

    public function islogin(){
        if(!isset($_SESSION)){ 
            session_start();
        }
    }

    // comprueba si el usuario esta logueado
    public function checkLoggedIn(){
        $this->islogin();
        if(!isset($_SESSION["username"])) {
            header("Location: ".BASE_URL."home");
            die();
        }
    }

    // devuelve el nombre del usuario
    public function session() {
        $this->islogin();
        $session = null;
        if (!empty($_SESSION)) {
            $session = $_SESSION['username'];
        }
        return $session;
    }

    // comprueba si el usuario es admin, devuelve 1 si es admin, 0 si no
    public function isAdmin() {
        $this->islogin();
        $admin = null;
        if (!empty($_SESSION)) {
            $admin = $_SESSION['admin'];
        }
        return $admin;
    }

    // redirige a la pagina a un ubicacion dada
    public function location($where){
        header("Location:".BASE_URL."$where");
    }
}