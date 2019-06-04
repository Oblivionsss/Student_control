<?php   // модель работы с данными сущности users_info
// Валидация для юзера

namespace application\api;

use application\core\Api;
use application\api\models\UsersInfo;

class UsersInfoApi extends Api
{
    public $apiName = 'users_info';


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
        $user   = $this->model->getById(
                'id'    => $this->id);
        
        return $this->response($user, 201);
    }


    /**
     * Метод POST
     * Создание новой записи
     * Отсутсвует необходимость в создании данного метода
     * @return string
     */

    public function createAction()
    {
        return $this->response('Method Not Allowed', 405);
    }


    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * параметры запроса ФИО, д.р, ссылка YD;
     * @return string
     */
    public function updateAction()
    {
        // Проверка на валидацию
        // Получение всех необходимых переменных
        // Запрос в бд на обновление данных     
        $user   = $this->model->update(
            array ('Name'   => $this->requestParams['Name'],
                'Surname'   => $this->requestParams['Surname'],
                'Matern'    => $this->requestParams['Matern'],
                'DateOfBirth' => $this->requestParams['DateOfBirth'],
                'YD'        => $this->requestParams['YD'],
                'id'        => $this->id)
        );
        
        // возрат статуса апдейта
        return $this->response('Data updated', 201);
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