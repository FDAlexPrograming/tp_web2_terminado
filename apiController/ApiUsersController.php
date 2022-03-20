<?php
    require_once "models/UserModel.php";
    require_once("apiController/ApiController.php");
    require_once "view/ApiView.php";

    class ApiUsersController extends ApiController {

    
        public function getUser($operacion = []) {
            if (empty($operacion)) {
                $users = $this->usermodel->bringUsersDB();
                $this->view->response($users, 200);
            }
            else {
                $id = $operacion[":ID"];
                $user = $this->usermodel->bringUserDB($id);
                if ($user) {
                    $this->view->response($user, 200);
                }
                else {
                    $this->view->response("no existe el objeto de la posicion $id", 404);
                }
            }
        }

        public function deleteUser ($operacion = null) {
            $id = $operacion[":ID"];
            $this->usermodel->borrarUser($id);
            $this->view->response("usuario $id borrado con exito", 200);
        }

        public function doAdmin ($operacion = null) {
            $id = $operacion[":ID"];
            $this->usermodel->volverloAdmin($id);
            $this->view->response("usuario $id convertido en admin", 200);
        }

        public function quitAdmin ($operacion = null) {
            $id = $operacion[":ID"];
            $this->usermodel->quitarAdmin($id);
            $this->view->response("usuario $id convertido en cliente", 200);
        }

    }






