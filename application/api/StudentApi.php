<?php 

namespace application\api;

use application\core\Api;

class StudentApi extends Api
{
    public $apiName     = 'disc';
    protected function indexAction() 
    {
        echo "hello";
    }
    protected function viewAction() 
    {
        echo "hello"; 
    }
    protected function createAction() 
    {
        echo "hello";
    }
    protected function updateAction() 
    {
        echo "hello";
    }
    protected function deleteAction() 
    {
        echo "hello";    
    }
}