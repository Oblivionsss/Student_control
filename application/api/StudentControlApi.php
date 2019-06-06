<?php   // student_control_id

namespace application\api;

use application\core\Api;
use application\core\StudentControl;

class StudentControlApi extends Api
{
    public $apiName     = 'studentControl';
    // получаем добавляем данные при добавлении даты
    protected function indexAction() 
    {
        
    }

    // Подгружаем данные для ответа на гет запрос
    protected function viewAction() 
    {
        // Получаем список студентов из дат, и успеваемостью студентов
        $result = $this->model->getStudGroupsId(
            array('disc_id'  => $this->requestParams['disc_id'],
            )
        );

        return $result;

        // return $this->response('Method Not Allowed', 405);
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

    // // добавляем данные при добавлении даты
    // protected function addAction($id_stud, $id_uniq, $date) 
    // {
    //     $this->model->addAction(
    //         array('date'  => $data,
    //         'id_stud'   => $id_stud,
    //         'id_uniq'   => $id_uniq) 
    //     );
    // }

    // Специальная пользовательская функция, 
    // позволяющая получить данные по датам
    protected function getDate()
    {
        
    }
}