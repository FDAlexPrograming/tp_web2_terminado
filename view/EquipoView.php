<?php

require_once "Helpers/AuthHelper.php";
require_once "libraries/smarty-master/libs/Smarty.class.php";

class EquipoView {

    private $smarty;
    private $authHelper;

    function __construct(){
        $this->smarty = new Smarty();
        $this->authHelper = new AuthHelper();
    }

    public function session($title){
        $this->smarty->assign('SESSION', $this->authHelper->session());
        $this->smarty->assign('admin', $this->authHelper->isAdmin());
        $this->smarty->assign('title',$title);
    }

    public function traerHome($equipos,$divisiones,$loginError = ''){
        $this->session('Inicio');
        $this->smarty->assign('equipo',$equipos);
        $this->smarty->assign('division',$divisiones);
        $this->smarty->assign('loginError',$loginError);
        $this->smarty->display("templates/equipos.tpl");
    }

    public function verUnEquipo($equipo,$usuario="",){
        $this->session('Detalle del equipo');
        $this->smarty->assign('equipo',$equipo);
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->assign('loginError');
        $this->smarty->display("templates/detalleEquipo.tpl");
    }

    public function TraerParamodificar($divisiones,$equipo,$id_division){
        $this->session('Modificar Equipo');
        $this->smarty->assign('divisiones', $divisiones);
        $this->smarty->assign('id', $id_division);
        $this->smarty->assign('equipo', $equipo);
        $this->smarty->display('templates/actualizar.tpl');
    }

    public function adminEquipo($equipos,$divisiones,$error,$exito){
        $this->session('Administrador Equipos');
        $this->smarty->assign('equipo',$equipos);
        $this->smarty->assign('division',$divisiones);
        $this->smarty->assign('error',$error);
        $this->smarty->assign('exito',$exito);
        $this->smarty->display("templates/adminEquipos.tpl");
    }

    public function pageNotFound(){
        $this->smarty->assign('loginError');
        $this->session('Página no encontrada');
        $this->smarty->display("templates/404.tpl");
    }
}
