
<?php

class EquipoModel {
    
    private $basededatos;

    function __construct(){
        $this->basededatos = new PDO('mysql:host=localhost;'.'dbname=fichajes;charse=utf8','root','');
    }
    // trae todos los equipos
    public function traerEquipos(){
        $sentencia = $this->basededatos->prepare('SELECT a.*,b.* FROM equipos a INNER JOIN divisiones b ON a.id_division = b.id_division');
        $sentencia->execute();
        $equipos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $equipos;
    }
    // trae un equipo por id 
    public function traerEquipo($id){
        $sentencia = $this->basededatos->prepare('SELECT a.*,b.* FROM equipos a INNER JOIN divisiones b ON a.id_division = b.id_division WHERE id_equipo=?');
        $sentencia->execute(array($id));
        $equipo = $sentencia->fetch(PDO::FETCH_OBJ);
        return $equipo;
    }
    // trae todos todos los equippos de una division
    public function traerEquipoPorDivision($division){
        $sentencia = $this->basededatos->prepare('SELECT a.*,b.* FROM equipos a LEFT JOIN divisiones b ON a.id_division = b.id_division WHERE division =?');
        $sentencia->execute(array($division));
        $equipos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $equipos;
    }
    // borra un equipo por id
    public function borrarEquipoBaseDeDatos($id){
        $sentencia = $this->basededatos->prepare("DELETE FROM equipos WHERE id_equipo=?");
        $sentencia->execute(array($id)); 
    }
    // inserta un equipo
    public function insertarEquipo($division,$equipo,$descripcion,$posicion){
        $sentencia = $this->basededatos->prepare("INSERT INTO equipos( id_division, nombre, descripcion,posicion) /* nombre de la base de datos */VALUES(?,?,?,?)");
        $sentencia->execute(array($division,$equipo,$descripcion,$posicion));   

    }
    // trae id del equipo a actualizar 
    public function TraerParaActualizar($id){
        $sentencia = $this->basededatos->prepare('SELECT * FROM equipos WHERE id_equipo=?');
        $sentencia->execute(array($id));
        return  $sentencia->fetch(PDO::FETCH_OBJ);
    }
    // actualiza un equipo
    public function actualizarEquipo($id,$nombre,$descripcion,$posicion,$division){
        $sentencia = $this->basededatos->prepare('UPDATE  equipos SET nombre=?,descripcion=?,posicion=?,id_division=?  WHERE id_equipo = ?' );
        $sentencia->execute(array($nombre,$descripcion,$posicion,$division,$id));  
    }

    public function busquedaAvanzada($loquebusco){
        $sentencia = $this->basededatos->prepare('SELECT * FROM equipos a INNER JOIN divisiones b ON a.id_division = b.id_division WHERE a.nombre LIKE ? OR a.posicion LIKE ?');
        $sentencia->execute(array("%$loquebusco%","%$loquebusco%"));
        $busqueda = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $busqueda;
    }                 
}    
