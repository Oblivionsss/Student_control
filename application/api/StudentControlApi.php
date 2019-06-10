<?php   // student_control_id

namespace application\api;

use application\core\Api;

use application\api\models\StudentControl;
use application\api\models\GroupsDiscInfo;

class StudentControlApi extends Api
{

    public $apiName     = 'studentControl';

    private $lower;
    private $up     = '2019-08-30';
    private $sort   = "DESC";
    private $today;
    private $limit  = 5;


    // получаем добавляем данные при добавлении даты
    protected function indexAction() 
    {
        
    }

    // Подгружаем данные для ответа на гет запрос
    protected function viewAction() 
    {
        // Получаем список студентов из дат, и успеваемостью студентов    
        // $result = $this->model->getStudGroupsId(
        //     array('disc_id'  => $this->requestParams['disc_id'],
        //     )
        // );
        
        $uniq       = $this->requestParams['disc_id'];
        // Получаем сегодняшнюю дату
        // $today;     // дата относительная//

        if (isset($this->requestParams['days'])) {
            $this->today  = $this->requestParams['days']; 
        }
        else {
            $this->today  = date("Y-m-d");
        } 
        

        // Получаем дату добавления предмета 
        if ( isset( $this->getDate($uniq)[0]["dateAdd"]) ) 
            $lowerDefault   = $this->getDate($uniq)[0]["dateAdd"];
        else return $this->response('ошибка, отсутствуют данные', 404);
            
        // Верхняя граница по умочанию
        // $up         = "2019-08-30"; 

        // Нижняя граница по умолчанию
        $this->lower      = $lowerDefault;

        // Верхняя граница дат фактическая  
        $uppDefault = $this->model->getMaxDate(
            array('id_uniq'  => $uniq)
        );

        $uppDefault;
        
        if (isset ($uppDefault[0]['datetime']))
            $uppDefault = $uppDefault[0]['datetime'];
        else  return $this->response('ошибка, отсутствуют данные', 404); 





        // Рассчет нижней выборки
        // Получаем последние даты до сегодняшнего дня
        // Если дата обращения >= даты выборки
        if ($this->today      >= $this->lower) {
            // Верхняя граница - сегодняшняя дата
            $this->up         = $this->today;
            
            
            $databefore = $this->model->getDate(
                $this->lower, $this->up, 
                $this->sort, $this->limit, 
                array('id_uniq'  => $uniq)
            );

            // Проверяем факт. строк 
            $rowBefore  = count($databefore);
            // var_dump($rowBefore);
            
            // Добавим недостающее количество данных по выборке
            // В выборку после нашей даты 
            if ($rowBefore <= 5) {
                $this->limit  = 5 - $rowBefore;
            }
            else return $this->response('Оибка в дате', 404);
            
        }
        else {
            // Иначе выдаем все ближайшие 10 дат
            // $up == верхняя граница выборок
            $this->sort   = "ASC";
            $this->up     = $uppDefault;
            $this->limit  = 10;
            
            $data   = $this->model->getDate(
                $this->lower, $this->up, 
                $this->sort, $this->limit, 
                array('id_uniq'  => $uniq)
            );
            
            asort($data);
            $this->getAllData($data, $uniq);    
        }
        
        
        // Теперь получаем все даты верхней границы
        // Если дата запрос <= фактической границы семестра
        if ( date('Y-m-d', strtotime("+1 DAY", strtotime($this->today))) <= $uppDefault ) {
            $this->today = date('Y-m-d', strtotime("+1 DAY", strtotime($this->today)))  ;
            // Меняем метод сортировки
            $this->sort   = "ASC";
            // Нижняя граница - сегодняшняя дата
            $this->lower  = $this->today;
            // Верхняя граница - факт.граница сема
            $this->up     = $uppDefault;
            
            $this->limit  = 5 + $this->limit;            
         
            
            // Получаем даты 
            $dateafter  = $this->model->getDate(
                $this->lower, $this->up, 
                $this->sort, $this->limit, 
                array('id_uniq'  => $uniq)
            );
        }
        else {
            // Иначе выдаем последние 10 дат 
            $this->sort   = "DESC";
            $this->lower  = $lowerDefault;
            $this->up     = $uppDefault;
            $this->limit  = 10;
            

            $data   = $this->model->getDate(
                $this->lower, $this->up, 
                $this->sort, $this->limit, 
                array('id_uniq'  => $uniq)
            );

            asort($data);
            $this->getAllData($data, $uniq); 
        }
        
        
        // Объединим получившиеся данные
        $date = array_merge($databefore, $dateafter);
        
        // Сортируем в порядке возрастания
        asort($date);
        // Подключаем файл загрузки данных 
        $this->getAllData($date, $uniq);


        // return $this->response('Method Not Allowed', 405);
    }

    protected function createAction() 
    {
        echo "hello";
    }

    // функция обработки индивидуальных данных студента
    protected function updateAction() 
    {
        // сначала проверяем все данные 
        // затем идем в модель 
        $this->model->updateData(
            array('id'  => $this->requestParams['id'],
            'status'    => $this->requestParams['status']) 
        );

        return $this->response('данные обновлены', 202);
    }

    protected function deleteAction() 
    {
        $result = $this->model->deleteData(
            array ('id_uniq' => $this->requestParams['uniq'],
            'days'  => $this->requestParams['days'])
        );

        return $this->response('проверка, данные удалены', 202); 
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
    // получаем дату добавления
    protected function getDate($uniq)
    {
        // Получаем сегодняшнюю дату
        $today      = date("Y-m-d"); 

        
        $GroupsDiscInfo = new GroupsDiscInfo();

        $lowerDefault= $GroupsDiscInfo->getAddDate(
            array('id_uniq'       => $uniq)
        );
        
        return $lowerDefault;
    }

    public function getAllData($data, $uniq) 
    {
        // Определяем верхние и нижние значения массива
        $lower = NULL;
        $upper = NULL;
        foreach($data as $arr)
        {
            foreach($arr as $key => $value)
            {
                if ($key == 'datetime' && ($value >= $upper))
                {
                    $upper = $value;
                }
            }
        }

        $lower     = $upper;
        
        foreach($data as $arr)
        {
            foreach($arr as $key => $value)
            {
                if ($key == 'datetime' && ($value <= $lower))
                    $lower = $value;
            }
        }

        
        // Запрос, который возвращает все данные за нужный период 
        $date    = $this->model->getAllData(
            $lower, $upper,
            array('id_uniq' => $uniq)
        );
        
        // var_dump($data);
        $mas    = [];
        foreach ($data as $key => $value) {
            
            $mas['datetime'][]  = array(
                '0' => date("d-M", strtotime($value['datetime'])),
                '1' => $value['datetime']);
        }



        $result = array();
        // Группируем данные по датам
        foreach($date as $key => $val)
        {
            $result[$val['id_stud']][] = $val;
        } 

        // var_dump($mas);

        return $this->response(array($mas, $result), 201);
        exit();
    }
}