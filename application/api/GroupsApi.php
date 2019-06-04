<?php 
// Валидация для юзера

namespace application\api;

use application\core\Api;

use application\lib\ValidationCreate;

use application\api\models\Disciplyne;

class GroupsApi extends Api
{
    public $apiName = 'groups';


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
        $namegr     = $this->requestParams['nameGroups'];

        return $this->response('Method Not Allowed', 405);
        //
    }


    /**
     * Метод POST
     * Создание новой записи группы
     * @return string
     */
    public function createAction()
    {
        // Проверка данных
        $result     = ValidationCreate::checkDate($this->apiName);

        // Если проверка данных не прошла
        // Возврат ошибки
        if ($result != '') {
            return $this->response($result, 404);
        }

        else {
            $namegr     = $this->requestParams['nameGroups'];
            $course     = $this->requestParams['Course'];
            $step       = $this->requestParams['level'];
            
            // Проверка на уникальность группы
            $result = $this->checkUniq($namegr);

            if ( !$result ) {
                return $this->response("Такая группа уже существует", 404);
            }

            // Добавление группы
            $result = $this->model->addGroup(
                array('namegr'  => $namegr,
                'course'        => $course,
                'step'          => $step)
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

    /**
    * //
    * Проверка уникальности группы
    * @return mas
    */
    protected function checkUniq($namegr)
    {
        $result     = $this->model->checkUniq(
            array('namegr'  => $namegr)
        );

        if (!empty($result)) {
            return false;
        }
        else return true;
    }
}