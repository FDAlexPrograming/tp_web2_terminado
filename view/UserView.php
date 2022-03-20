<?php
require_once "Helpers/AuthHelper.php";
require_once "libraries/smarty-master/libs/Smarty.class.php";

class UserView{

    private $smarty;
    private $authHelper;

    function __construct(){
        $this->smarty = new Smarty();
        $this->authHelper = new AuthHelper();
    }

    public function usersTable () {
        $this->smarty->assign('SESSION', $this->authHelper->session());
        $this->smarty->assign('admin', $this->authHelper->isAdmin());
        $this->smarty->assign('title', "Usuarios");
        $this->smarty->display('templates/usersList.tpl');
    }

    

}