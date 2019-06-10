<?php   // Модель работы с данными сущности teach_group_disc_info

namespace application\api\models;

use application\core\ModelApi;

class GroupsDiscInfo extends ModelApi
{  
    public function addRasp($mas)
    {
        $sql    = "INSERT INTO teach_group_disc_info(teachdiscgroup, 
        dateAdd, rep, par, lectureHall)
        VALUES (:id, :date, :rep, :par, :hall)";

        $result = $this->db->query($sql, $mas);

        return;
    }

    // Возврат даты добавления
    public function getAddDate($mas) 
    {
        $sql    = "SELECT dateAdd
        FROM teach_group_disc_info
        WHERE teachdiscgroup=:id_uniq";


        $result = $this->db->row($sql, $mas);

        return $result;
    }


    // 
    public function getIdRasp($mas)
    {
        // подзапрос на доступное для данного пользователя расписание
        // Заменить CurrentData()
        $sql    = 
        "SELECT DISTINCT 
            student_control_id.datetime,
            teach_group_disc_info.par,
            disciplyne.name,            
            teach_group_disc_info.lectureHall,  
            groups_id.NameOfGrups,
            student_control_id.id_uniq
        FROM 
            teach_group_disc_info 
        JOIN teach_group_disc 
            ON teach_group_disc_info.teachdiscgroup=teach_group_disc.id 
        JOIN student_control_id 
            ON student_control_id.id_uniq=teach_group_disc.id 
        JOIN disciplyne
            ON disciplyne.id=teach_group_disc.id_disc
        JOIN groups_id
            ON groups_id.id=teach_group_disc.id_group
        WHERE 
            datetime >= '2019-03-12' 
        AND 
            teach_group_disc.id_teach=:id
        ORDER BY 
            student_control_id.datetime, 
            teach_group_disc_info.par 
        ASC LIMIT 5";

        $result = $this->db->row($sql, $mas);
        
        $mas    = [];
        foreach ($result as $key => $value) {
            $mas[$value['datetime']][] = $value;
        }
        
        return $mas;
    }
}




// // SELECT t1.col, t3.col 
// FROM table1 join table2 ON table1.primarykey = table2.foreignkey
// join table3 ON table2.primarykey = table3.foreignkey