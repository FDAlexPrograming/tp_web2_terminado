<?php
    require_once "models/ComentariosModel.php";
    require_once("apiController/ApiController.php");
    require_once "view/ApiView.php";

    class ApiComentController extends ApiController{

    public function getComents($operacion = []) {
        if (empty($operacion)) {
            $users = $this->comentariomodel->getComentarios();
            $this->view->response($users, 200); // 200 OK
        }
        else {
            $id = $operacion[":ID"];
            $user = $this->comentariomodel->traeruserComent($id);
            if ($user) {
                $this->view->response($user, 200);
            }
            else {
                $this->view->response("no existe el objeto de la posicion $id", 404);
            }
        }
    }
    
    public function getLimitedComents ($operacion = []) {
        if (empty($operacion)) {
            $users = $this->comentariomodel->getComentarios();
            $this->view->response($users, 200); // 200 OK
        }
        else {
            if ($operacion[":INIT"] == "firstAndLast") {
                $id = $operacion[":ID"];
                $elements = $this->comentariomodel->getFirstAndLast($id);
                $this->view->response($elements, 200); // 200 OK
            }
            else {
                $id = $operacion[":ID"];
                $inicio = $operacion[":INIT"];
                $users = $this->comentariomodel->getLimitedComents($id, $inicio);
                $this->view->response($users, 200); // 200 OK
            }
        }
    }

    public function addComent() {   
        $coments = $this->getBody(); // la obtengo del body
        // inserta la tarea
        $comentId = $this->comentariomodel->insertComent($coments->username,$coments->id_equipo,$coments->comentario,$coments->puntaje,$coments->fecha);
        // obtengo la recien creada
       
        $comentarioNuevo = $this->comentariomodel->getComentario($comentId);
        echo($comentarioNuevo);
        if (!$comentarioNuevo) {
            $this->view->response($comentarioNuevo, 200);
        }else{
            $this->view->response("no se pudo crear el comentario", 500);
           
            }
    }

    public function deleteComents ($operacion = null) {
        $id = $operacion[":ID"];
        $this->comentariomodel->deleteComent($id);
        $this->view->response("usuario $id borrado con exito", 200);
    }

    

}

