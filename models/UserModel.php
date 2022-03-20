<?php

class UserModel {
    
    private $basededatos;

    function __construct(){
        $this->basededatos = new PDO('mysql:host=localhost;'.'dbname=fichajes;charse=utf8','root','');
    }
    // traer todos los usuarios
    public function bringUsersDB() {
        $sentencia = $this->basededatos->prepare('SELECT * FROM usuarios');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // traer un usuario por su nomnbre
    public function bringUserByNameDB ($nombre) {
        $sentencia = $this->basededatos->prepare("SELECT * FROM usuarios WHERE username =?");
        $sentencia->execute(array($nombre));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    // traer user por su id
    public function bringUserDB ($userID) {
        $sentencia = $this->basededatos->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
        $sentencia->execute(array($userID));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    // borar un usuario
    public function borrarUser ($userID) {
        $sentencia = $this->basededatos->prepare("DELETE FROM usuarios WHERE id_usuario=?");
        $sentencia->execute(array($userID)); 
    }
    // hacer un usuario admin
    public function volverloAdmin ($userID) {
        $sentencia = $this->basededatos->prepare("UPDATE usuarios SET privilege_level=? WHERE id_usuario=?");
        $sentencia->execute(array(1,$userID)); 
    }
    // hacer un usuario normal
    public function quitarAdmin ($userID) {
        $sentencia = $this->basededatos->prepare("UPDATE usuarios SET privilege_level =? WHERE id_usuario=?");
        $sentencia->execute(array(0,$userID)); 
    }  
}