<?php

require_once 'models/UserModel.php';
require_once 'view/UserView.php';
require_once "Helpers/AuthHelper.php";

class UserController {
    private $view;
    private $authHelper;

    function __construct() {
        $this->view = new UserView();
        $this->authHelper = new AuthHelper();
    }

    public function showUsersAPI() {
        $this->authHelper->checkLoggedIn();
        $this->view->usersTable();
    }

    
}