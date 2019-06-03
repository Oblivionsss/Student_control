<?php


$result = $this->db->add("INSERT INTO disciplyne(teach_id, Name, Hours) 
            VALUES (:teach_id, :name, :hours)",
            array('teach_id'  => $_SESSION['id'],
            'name'      => $_POST['NameDisc'],
            'hours'     => $_POST['CountHours']));
            
            if ($result) {
                return "Дисциплина успешно добавлена!";
            }
            else return "Ошибка при добавлении дисциплины";