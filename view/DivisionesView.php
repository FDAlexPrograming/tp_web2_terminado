<?php

require_once "Helpers/AuthHelper.php";
require_once "libraries/smarty-master/libs/Smarty.class.php";

class DivisionesView {

    private $smarty;
    private $authHelper;

    function __construct(){
        $this->smarty = new Smarty();
        $this->authHelper = new AuthHelper();
    }

    public function session($title){
        $this->smarty->assign('SESSION', $this->authHelper->session());
        $this->smarty->assign('title',$title);
    }

    public function traerDivisiones($divisiones,$loginError = ''){
        $this->session('Divisiones');
        $this->smarty->assign('admin', $this->authHelper->isAdmin());
        $this->smarty->assign('division',$divisiones);
        $this->smarty->assign('loginError',$loginError);
        $this->smarty->display("templates/divisiones.tpl");
    }

    public function adminDivisiones($divisiones,$error,$exito){
        $this->session('Administrador Divisiones');
        $this->smarty->assign('admin', $this->authHelper->isAdmin());
        $this->smarty->assign('division',$divisiones);
        $this->smarty->assign('error',$error);
        $this->smarty->assign('exito',$exito);
        $this->smarty->display("templates/adminDivisiones.tpl");
      
    }

    public function TraerParamodificarDivision($divisiones,$equipos="",$id_division=""){
        $this->session('Modificar Division');
        $this->smarty->assign('admin', $this->authHelper->isAdmin());
        $this->smarty->assign('equipo',$equipos);
        $this->smarty->assign('divisiones', $divisiones);
        $this->smarty->assign('contador', $id_division);
        $this->smarty->display('templates/actualizar.tpl');
    }
}
