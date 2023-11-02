<?php

class DoctorNotes
{

    private Database $db;
    private Vaccine $vaccine;
    private Schedule $sched;
    private Children $child;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->vaccine = new Vaccine();
        $this->sched = new Schedule();
        $this->child = new Children();
    }

    public function add($child_id, $doctor_name, $consultation_date, $age, $height, $weight, $head_circumference, $chest_circumference, $vaccine_administered, $notes, $next_visit){

        $vaccine_administered = explode(',', $vaccine_administered);

        if (empty($next_visit)) {
            $next_visit = NULL;
        } else {
            $next_visit = $next_visit;
        }

        foreach ($vaccine_administered as $vaccine) {

            $sql = "INSERT INTO doctor_notes (child_id, doctor_name, consultation_date, age, height, weight, head_circumference, chest_circumference, vaccine_administered, notes, next_visit) 
VALUES (:child_id, :doctor_name, :consultation_date, :age, :height, :weight, :head_circumference, :chest_circumference, :vaccine_administered, :notes, :next_visit)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":child_id", $child_id);
            $stmt->bindParam(":doctor_name", $doctor_name);
            $stmt->bindParam(":consultation_date", $consultation_date);
            $stmt->bindParam(":age", $age);
            $stmt->bindParam(":height", $height);
            $stmt->bindParam(":weight", $weight);
            $stmt->bindParam(":head_circumference", $head_circumference);
            $stmt->bindParam(":chest_circumference", $chest_circumference);
            $stmt->bindParam(":vaccine_administered", $vaccine);
            $stmt->bindParam(":notes", $notes);
            $stmt->bindParam(":next_visit", $next_visit);
            if ($stmt->execute()){

                $date_vaccinated = date("Y-m-d h:i:s");

                $sql = "INSERT INTO `child_vaccine` (`child_id`, `vaccine_id`, `datetime`) VALUES (:child_id, :vaccine_id, :dt)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":child_id", $child_id);
                $stmt->bindParam(":vaccine_id", $vaccine);
                $stmt->bindParam(":dt", $date_vaccinated);
                if ($stmt->execute()){
                    if($this->vaccine->decreaseQuanity($vaccine)){

                        // If the doctor set next visit, send a SMS to the parent
                        if (!empty($next_visit)){
                            $this->sched->setNextVisit($next_visit, $next_visit, $child_id);

                        }
                        return true;

                    }
                }

            }

        }



        return true;

    }

    public function initAdministerChild($id){

        $child = $this->child->getChild($id);

        $sql = "SELECT * FROM vaccines WHERE expiration_date >= CURDATE() AND vaccines.name NOT IN (SELECT vaccines.`name` FROM child_vaccine LEFT JOIN vaccines ON child_vaccine.vaccine_id = vaccines.id WHERE child_vaccine.child_id = :id) GROUP BY vaccines.`name`";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {

            if ($stmt->rowCount() > 0){
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Retrieve the list of vaccines that the child has not receive
                $options = "";

                foreach ($row as $vaccine){
                    $expiration = $vaccine['expiration_date'];
                    $date = date("Y-m-d");

                        $options .= '<option value="'. $vaccine['id'] .'">' . $vaccine['name'] . ' Expiration '. $vaccine['expiration_date'] .'</option>';
                    
                }
            }


            $data =
                array(
                    "child_id" => $child['child_id'],
                    "child_name" => ($child['child_firstname'] . ' ' . $child['child_middlename'] . ' ' . $child['child_lastname']),
                    "consultation_date" => date("Y-m-d"),
                    "age" => Misc::getAge($child['birth_date']),
                    "option" => $options
                );

            echo json_encode($data);

        }
    }


}