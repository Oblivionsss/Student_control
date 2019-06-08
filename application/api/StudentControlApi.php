<?php   // student_control_id

namespace application\api;

use application\core\Api;

use application\api\models\StudentControl;
use application\api\models\GroupsDiscInfo;

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
        // $result = $this->model->getStudGroupsId(
        //     array('disc_id'  => $this->requestParams['disc_id'],
        //     )
        // );
        
        $uniq       = $this->requestParams['disc_id'];
        // Получаем сегодняшнюю дату
        $today;     // дата относительная//

        if (isset($this->requestParams['days'])) {
            $today  = $this->requestParams['days']; 
        }
        else {
            $today  = date("Y-m-d");
        } 
        

        // Получаем дату добавления предмета 
        $lowerDefault   = $this->getDate($uniq)[0]["dateAdd"];
            
        // Верхняя граница по умочанию
        $up         = "2019-08-30"; 

        // Нижняя граница по умолчанию
        $lower      = $lowerDefault;

        // Верхняя граница дат фактическая  
        $uppDefault = $this->model->getMaxDate(
            array('id_uniq'  => $uniq)
        );

        $uppDefault = $uppDefault[0]['datetime']; 

        // Ограничения на выборку 
        $limit = 5;

        // Сортировка выборки по умолчанию в порядке убывания
        $sort = "DESC";



        // Рассчет нижней выборки
        // Получаем последние даты до сегодняшнего дня
        // Если дата обращения >= даты выборки
        if ($today      >= $lower) {
            // Верхняя граница - сегодняшняя дата
            $up         = $today;
            

            $databefore = $this->model->getDate($lower, $up, $sort, $limit, array('id_uniq'  => $uniq));
            
            // Проверяем факт. строк 
            $rowBefore  = count($databefore);

            // Добавим недостающее количество данных по выборке
            // В выборку после нашей даты 
            if ($rowBefore < 5) {
                $limit  = 5 - $rowBefore;
            }
        }
        else {
            // Иначе выдаем все ближайшие 10 дат
            // $up == верхняя граница выборок
            $sort   = "ASC";
            $up     = $uppDefault;
            $limit  = 10;
            
            $data   = $this->model->getDate($lower, $up, $sort, $limit, array('id_uniq'  => $uniq));

            asort($data);
            return $data;
        }

        
        // Теперь получаем все даты верхней границы
        // Если дата запрос <= фактической границы семестра
        if ( date('Y-m-d', strtotime("+1 DAY", strtotime($today))) <= $uppDefault ) {
            
            // Меняем метод сортировки
            $sort   = "ASC";
            // Нижняя граница - сегодняшняя дата
            $lower  = $today;
            // Верхняя граница - факт.граница сема
            $up     = $uppDefault;
            
            $limit  = 5 + $limit ;            


            
            // Получаем даты 
            $dateafter  = $this->model->getDate($lower, $up, $sort, $limit, array('id_uniq'  => $uniq));
        }
        else {
            // Иначе выдаем последние 10 дат 
            $sort   = "DESC";
            $lower  = $lowerDefault;
            $up     = $uppDefault;
            $limit  = 10;
            

            $data   = $this->model->getDate($lower, $up, $sort, $limit, array('id_uniq'  => $uniq)); 
            asort($data);
            return $data;
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
    }
}