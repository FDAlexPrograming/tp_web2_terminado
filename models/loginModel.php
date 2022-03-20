<?php

class LoginModel {
    
    private $basededatos;

    function __construct(){
        $this->basededatos = new PDO('mysql:host=localhost;'.'dbname=fichajes;charse=utf8','root','');
    }
    // crear usuario
    public function crearUsuario($username,$password){
        $sentencia = $this->basededatos->prepare("INSERT INTO usuarios(username, password) VALUES(?, ?)");
        $sentencia->execute([$username,$password]);
    }
}