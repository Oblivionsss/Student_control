<?php 
// Валидация для юзера

namespace application\api;

use application\core\Api;

use application\lib\ValidationCreate;

use application\api\models\Student;

class StudentApi extends Api
{
    public $apiName = 'student';


    /**
     * Метод GET
     * Отсутствует
     * @return string
     */
    public function indexAction()
    {   
        // Нет необходимости в реализации данного метода
        return $this->response('Method Not Allowed', 405);
    }


    /**
     * Метод GET
     * Получение данных отдельной записи (по id)
     * @return string
     */
    public function viewAction()
    {
        return $this->response('Method Not Allowed', 405);
    }


    /**
     * Метод POST
     * Создание новой записи группы
     * @return string
     */
    public function createAction()
    {
        $result     = ValidationCreate::checkDate($this->apiName);

        // Возврат ошибки
        if ($result != '') {
            return $this->response($result, 404);
        }

        // Добавляем студента в student_list
        // Получаем id студента
        else {
            // Добавление группы
            $result = $this->model->addStud(
                array('nameSt'  => $_POST['nameSt'],
                'nameSn'        => $_POST['nameSn'],
                'groups'        => $_POST['groups_id'])
            );

            return $this->response('Data updated', 201);
        }
    }


    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * @return string
     */
    public function updateAction()
    {
        return $this->response('Method Not Allowed', 405);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function deleteAction()
    {
        return $this->response('Method Not Allowed', 405);
    }

}