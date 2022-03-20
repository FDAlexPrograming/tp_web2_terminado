<?php
require_once 'view/DivisionesView.php';
require_once "models/DivisionesModel.php";
require_once 'Helpers/AuthHelper.php';
require_once 'models/EquipoModel.php';

class DivisionController{
    private $model;
    private $view;
    private $equipoModel; 
    private $authHelper;

    function __construct(){
        $this->model = new DivisionesModel();
        $this->view = new DivisionesView;
        $this->equipoModel = new EquipoModel;
        $this->authHelper = new AuthHelper();
    }
    // obtiene todas las divisiones
    public function divisiones(){
        $divisiones =  $this->model->traerDivisiones();
        $this->view->traerDivisiones($divisiones);
    }
    // obtiene una division por id
    public function TraerParamodificarDivision($id){
        $this->authHelper->checkLoggedIn();
        $division =  $this->model-> TraerParaActualizarDivision($id);
        $this->view->TraerParamodificarDivision($division);
    }
    // adminstra la modificacion de una division
    public function adminDivisiones($error='',$exito=""){
        $this->authHelper->checkLoggedIn();
        $divisiones =  $this->model->traerDivisiones();
        $this->view->adminDivisiones($divisiones,$error,$exito);
    }
    // actualiza una division
    public function actualizarDivision(){
        $this->authHelper->checkLoggedIn();
        if (!empty($_POST['cantidad'])&&!empty($_POST['division'])) {
            $cantidad = $_POST['cantidad'];
            $division = $_POST['division'];
            $id =  $_POST['id_division'];
        $this->model->actualizarDivision($id,$cantidad,$division);
        $this->adminDivisiones('','Se modifico exitosamente la division');
        }else{
            $this->adminDivisiones('Falta completar campos ');
        }
    }
    // elimina una division
    public function eliminarDivision($id){
        $this->authHelper->checkLoggedIn();
        $enUso = false;
        foreach ($this->equipoModel->traerEquipos() as $equipos ) {
            if ($equipos->id_division == $id) {
                $enUso = true;
                $this->adminDivisiones('No podes eliminar a una division en uso');
                break;
            }
        }
        if($enUso == false ){
            $this->model->borrarDivisionBaseDeDatos($id);
            $this->adminDivisiones('','division eliminada');
        }
    }
    // crea una division
    public function agregarDivision(){
        $this->authHelper->checkLoggedIn();
        if (!empty($_POST['division'])&&!empty($_POST['cantidad'])) {
            $divisionNueva = $_POST['division'];
            $cantidad = $_POST['cantidad'];
            $enUso = false;
            foreach ($this->model->traerDivisiones() as $divisiones ) {
                if (($divisiones->division) == ($divisionNueva)) {
                    $enUso = true;
                    $this->adminDivisiones('La division que queres agregar ya esta en uso');
                }
            }
            if($enUso == false ){
                $this->model->insertarDivision($cantidad,$divisionNueva);
                $this->adminDivisiones('','Agregado con exíto');
            }
        }else{
            $this->adminDivisiones('Falta completar campos ');
        }
    }
}