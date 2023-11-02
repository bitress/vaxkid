<?php

class Calendar
{

    private Database $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function fetch(){

        $data = array();

        $sql = "SELECT * FROM `schedule` ORDER BY schedule_id";
        $stmt =  $this->db->prepare($sql);
        if ($stmt->execute()){

            $result = $stmt->fetchAll();

            foreach ($result as $row){

                if ($row['barangay'] != 'n/a') {

                    $data[] = array(
                        'id' => $row['schedule_id'],
                        'title' => $row['barangay'],
                        'start' => $row['start_date'],
                        'end' => $row['end_date']
                    );

                }
            }

            echo json_encode($data);
        }

    }

}