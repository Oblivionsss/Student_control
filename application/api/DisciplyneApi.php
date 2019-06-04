<?php 
// Валидация для юзера

namespace application\api;

use application\core\Api;

use application\lib\ValidationCreate;

use application\api\models\Disciplyne;

class DisciplyneApi extends Api
{
    public $apiName = 'disc';


    /**
     * Метод GET
     * Отсутствует
     * @return string
     */
    public function indexAction()
    {   
        // Определяем тип возвращаемых данных
        if (!isset($this->requestParams['uniq'])) {
            $this->viewAction();
        }
        
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
        $result     = $this->model->getAll();

        if (!empty($result))
            return $this->response($result, 201);
        else return $this->response("Данных по запросу нет", 202);

    }


    /**
     * Метод POST
     * Создание новой записи дисциплины
     * Отсутсвует необходимость в создании данного метода
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

        // Иначе добавляем новую дисциплину
        else {

            // Добавляем новую дисциплину в disciplyne
            $result = $this->model->addDisc(
                array('teach_id'  => $this->id,
                'name'      => $this->requestParams['NameDisc'],
                'hours'     => $this->requestParams['CountHours'])
            );
            
            // Ошибка обновления
            if ($result == true)
                return $this->response('Data updated', 201);
            else return $this->response("Ошибка добавления данных", 404);
        }
    }


    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * параметры запроса Name, Surname, Mattern, DateOfBirth, yanDSK
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