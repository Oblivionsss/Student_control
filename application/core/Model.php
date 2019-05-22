<?php

namespace application\core;
use application\lib\Db;

abstract class Model {

	public $db;
	public $params = [];

	public function __construct() {
        $this->db = new Db;
        
        
        if (isset($_POST['login']) and isset($_POST['password'])) {
            
            $this->params = array (
                'login'     => $_POST['login'], 
                'password'  => $_POST["password"]
            );
        }
	}

}