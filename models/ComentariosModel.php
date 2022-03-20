<?php

class ComentariosModel {
    
    private $basededatos;

    function __construct(){
        $this->basededatos = new PDO('mysql:host=localhost;'.'dbname=fichajes;charse=utf8','root','');
    }
    // trae todos los comentarios
    public function getComentarios(){
        $sentencia = $this->basededatos->prepare("SELECT * FROM comentarios");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // trae un comentario por id
    public function getComentario($id){
        $sentencia = $this->basededatos->prepare("SELECT * FROM comentarios WHERE id_comentario = ? ");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
   
    public function getLimitedComents($id, $inicio) {
        $sentencia = $this->basededatos->prepare("SELECT * FROM comentarios WHERE id_equipo=? AND id_comentario>=? LIMIT 5");
        $sentencia->execute(array($id, $inicio));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getFirstAndLast ($id) {
        $sentencia = $this->basededatos->prepare("(SELECT id_comentario FROM comentarios WHERE id_equipo=? ORDER BY id_comentario ASC LIMIT 1) UNION ALL (SELECT id_comentario FROM comentarios WHERE id_equipo=? ORDER BY id_comentario DESC LIMIT 1)");
        $sentencia->execute(array($id, $id));
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }

    // trae los comentarios de un equipo ordenado descendente
    public function traeruserComent($id){
        $sentencia = $this->basededatos->prepare('SELECT * FROM comentarios  WHERE id_equipo=? ORDER BY id_comentario DESC ');
        $sentencia->execute(array($id));
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }

    // inserta un comentario
    public function insertComent($username,$id_equipo,$comentario,$puntaje,$fecha){
        $sentencia = $this->basededatos->prepare('INSERT INTO comentarios(username,id_equipo,comentario,puntaje,fecha) VALUES(?,?,?,?,?)');
        $sentencia->execute([$username,$id_equipo,$comentario,$puntaje,$fecha]);
    }
    // borrar un comentario
    public function deleteComent($id){
        $sentencia = $this->basededatos->prepare('DELETE FROM comentarios WHERE id_comentario = ?');
        $sentencia->execute(array($id));
    }

}