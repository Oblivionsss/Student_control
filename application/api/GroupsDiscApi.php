<?php   // модель, для работы с данными teach_group_disc

namespace application\api;

use application\core\Api;
use application\api\models\UsersInfo;

class GroupsDiscApi extends Api
{
    public $apiName = 'groups_disc';


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
        // $user   = $this->model->getById(
        //         'id'    => $this->id);
        
        // return $this->response($user, 201);
        
        return $this->response('Method Not Allowed', 405);
    }


    /**
     * Метод POST
     * Создание новой записи
     * Отсутсвует необходимость в создании данного метода
     * @return string
     */

    public function createAction()
    {
        // Сначала валидация ><
        // Проверить на уникальность - предложить сменить имя дисциплины 
        // В случае вынужденной необходимости

        // Затем добавляем данные
        $result     = $this->model->addUniq(
            array('id_teach'    => $this->id,
                'id_disc'       => $this->requestParams['disc_id'],
                'id_group'      => $this->requestParams['groups_id'])
        );
        
        return $this->response('Личная группа добавлена!', 201);
    }


    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * параметры запроса ФИО, д.р, ссылка YD;
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

