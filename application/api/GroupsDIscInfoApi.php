<?php   // модель, для работы с данными teach_group_disc_info (добавляем дату расписания и периодичность)

namespace application\api;

use application\core\Api;
use application\api\models\UsersInfo;
use application\api\models\Student;
use application\api\models\StudentControl;

class GroupsDiscInfoApi extends Api
{
    public $apiName = 'groups_disc_info';


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
        // Затем добавляем данные

        $result     = $this->model->addRasp(
            array('id'  => $this->requestParams['disc_id'],
                'date'  => $this->requestParams['date'],
                'rep'   => $this->requestParams['radio'],
                'par'   => $this->requestParams['pars'],
                'hall'  => $this->requestParams['lectureHall'])
        );

  
        // Теперь обновим основную таблицу student_control_id
        // Сначала получим список студентов по данной группе
        $stud  =  new Student();

        $stud_list  = $stud->getStudGroupsId(
            array('id_group'  => $this->requestParams['group_id'])
        );


        // определяем перую дату
        $data  = $this->requestParams['date'];

        // определяем интервал повтора занятий
        $up         = "2019-08-30";  // коонец семестра
        $repeat     = '';

        if ($this->requestParams['radio'] == 0) {
            $repeat = '+ 1 WEEK';
        }
        else $repeat = '+2 WEEK';



        $studControl    = new StudentControl();
        // заполняем таблицу - уникальную группу данными
        while ($data <= $up) 
        {

            // Перебираем все id
            foreach ($stud_list as $key => $value) {
                $studControl->addAction(
                    array('date'  => $data,
                    'id_stud'   => $value['id'],
                    'id_uniq'   => $this->requestParams['disc_id']) 
                );
            }

            // Добавляем период
            $data = date('Y-m-d', strtotime($repeat, strtotime($data)));         
        }
        
        return $this->response('Data updated', 201);
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

