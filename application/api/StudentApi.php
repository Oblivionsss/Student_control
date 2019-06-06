<?php   // student_list 
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
        
        $result = $this->model->getAllStudGroupsId(
            array('id_group'    => $this->requestParams['group_id'])
        );
        return $this->response($result, 201);
    }


    /**
     * Метод GET
     * Получение данных отдельной записи (по id группы)
     * @return string
     */
    public function viewAction()
    {
        if (isset($this->requestParams['all'])) {
            $this->indexAction();
        }

        // Получаем список студентов по id - группы
        $result = $this->model->getStudGroupsId();
        
        return $result;

        // return $this->response('Method Not Allowed', 405);
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
                array('nameSt'  => $this->requestParams['nameSt'],
                'nameSn'        => $this->requestParams['nameSn'],
                'groups'        => $this->requestParams['groups_id'])
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

    public function getStud($groups_id)
    {
        // Получаем список студентов по id - группы
        $result = $this->model->getStudGroupsId(
            array('id_group'  => $groups_id)
        );
        
        return $result;

        // return $this->response('Method Not Allowed', 405);
    }

}