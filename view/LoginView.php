<?php
require_once "Helpers/AuthHelper.php";
require_once "libraries/smarty-master/libs/Smarty.class.php";

class LoginView{

    private $smarty;
    private $authHelper;

    function __construct(){
        $this->smarty = new Smarty();
        $this->authHelper = new AuthHelper();
    }

    public function showRegister($error,$exito) {
        $this->smarty->assign('SESSION', $this->authHelper->session());
        $this->smarty->assign('admin', $this->authHelper->isAdmin());
        $this->smarty->assign('loginError');
        $this->smarty->assign('error',$error);
        $this->smarty->assign('exito',$exito);
        $this->smarty->assign('title', "Registrarse");
        $this->smarty->display('templates/register.tpl');
    }
}
    