<?php

class DivisionesModel {
    
    private $basededatos;

    function __construct(){
        $this->basededatos = new PDO('mysql:host=localhost;'.'dbname=fichajes;charse=utf8','root','');
    }
    // obtener todas las divisiones
    public function traerDivisiones(){
        $sentencia = $this->basededatos->prepare('SELECT * FROM divisiones');
        $sentencia->execute();
        $divisiones = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $divisiones;
    }
    // traer la division por nombre de la division
    public function traerIdDivisiones($division){
        $sentencia = $this->basededatos->prepare('SELECT * FROM divisiones WHERE division=?');
        $sentencia->execute(array($division));
        $divisiones = $sentencia->fetch(PDO::FETCH_OBJ);
        return $divisiones;
    }
    // borra la division 
    public function borrarDivisionBaseDeDatos($id){
        $sentencia = $this->basededatos->prepare("DELETE FROM divisiones WHERE id_division=?");
        $sentencia->execute(array($id));   
    }
    // inserta una nueva division
    public function insertarDivision($cantidad,$division){
        $sentencia = $this->basededatos->prepare("INSERT INTO divisiones( division,cantidad_equipos) /* nombre de la base de datos */VALUES(?,?)");
        $sentencia->execute(array($division,$cantidad));   
    }
    // obtener la id de la division a actualizar
    public function TraerParaActualizarDivision($id){
        $sentencia = $this->basededatos->prepare('SELECT * FROM divisiones WHERE id_division=?');
        $sentencia->execute(array($id));
        return  $sentencia->fetch(PDO::FETCH_OBJ);
    }
    // actualizar la division
    public function actualizarDivision($id,$cantidad,$division){
        $sentencia = $this->basededatos->prepare('UPDATE  divisiones SET cantidad_equipos=?, division=?  WHERE id_division = ?' );
        $sentencia->execute(array($cantidad,$division,$id));  
    }

}