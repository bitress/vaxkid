<?php

class Children
{

    /**
     * @var Database
     */
    private Database $db;
    private $log;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->log = new Activity();
    }

    public function getAllChildren($barangay = null){



        if($barangay === null){
            $sql = "SELECT * FROM child_info ORDER BY child_info.child_id DESC";

        } else {
            $barangay = explode(",", $barangay);
            $query = "";
            foreach ($barangay as $bar){
                $query .= " OR barangay = '$bar'";
            }
            $sql = "SELECT * FROM child_info WHERE barangay = '1' ".$query." ORDER BY child_info.child_id DESC";
        }
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getChild($id){

        $sql = "SELECT * FROM child_info  WHERE child_info.child_id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()){
            return $stmt->fetch();

        }
    }

    /**
     * @throws JsonException
     */
    public function getChildJSON($id){
        $data = $this->getChild($id);
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    public function insertInfo($firstname, $middlename, $lastname, $birth_date, $birth_time, $birthplace, $hospital, $obstetrician, $pediatrician, $gender, $mother, $father, $address, $barangay, $contact, $delivery_type, $weight, $length, $head_circumference, $chest_circumference, $blood_type, $eye_color, $hair_color, $dm, $nsd){

        $sql = "INSERT INTO `child_info` 
    (child_firstname, child_middlename, child_lastname, birth_date, birth_time, birth_place, gender, hospital, obstetrician, pediatrician, mother_name, father_name, address, barangay, contact_number, typeofdelivery, weight, length, head_circumference, chest_circumference, blood_type, eye_color, hair_color, distinguishing_marks, newborn_screening_date)
    VALUES (:firstname, :middlename, :lastname, :birthday, :birth_time, :birthplace, :gender, :hospital, :obstetrician, :pediatrician, :mother, :father, :address, :barangay, :contact, :tod, :weight, :length, :hc, :cc, :bt, :ec, :h_color, :dm, :nsd)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":middlename", $middlename);
        $stmt->bindParam(":birthday", $birth_date);
        $stmt->bindParam(":birth_time", $birth_time);
        $stmt->bindParam(":birthplace", $birthplace);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":hospital", $hospital);
        $stmt->bindParam(":obstetrician", $obstetrician);
        $stmt->bindParam(":pediatrician", $pediatrician);
        $stmt->bindParam( ":mother", $mother);
        $stmt->bindParam( ":father", $father);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":barangay", $barangay);
        $stmt->bindParam( ":contact", $contact);
        $stmt->bindParam(":tod", $delivery_type);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":hc", $head_circumference);
        $stmt->bindParam(":cc", $chest_circumference);
        $stmt->bindParam(":bt", $blood_type);
        $stmt->bindParam(":ec", $eye_color);
        $stmt->bindParam(":h_color", $hair_color);
        $stmt->bindParam(":dm", $dm);
        $stmt->bindParam(":nsd", $nsd);
        if ($stmt->execute()){
            $this->log->set("has added a new child in to the database");
            return true;
        }

    }



    /**
     * Delete child using its id
     * @param $child_id
     * @return bool
     */
    public function deleteChild($child_id){

        try {

            $sql = "DELETE FROM `child_info` WHERE `child_id` = :uid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":uid", $child_id);
            if ($stmt->execute()){

            $sql = "DELETE FROM `child_vaccine` WHERE `child_id` = :uid";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":uid", $child_id);
                if ($stmt->execute()){
                    $sql = "DELETE FROM `doctor_notes` WHERE child_id = :uid";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(":uid", $child_id);
                    if ($stmt->execute()){
                        $this->log->set("has deleted a child in the database");
                        return true;
                    }
                }
            }

        } catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }

}

    public function editInfo($firstname, $middlename, $lastname, $birthdate, $birthtime, $birthplace, $gender, $hospital, $obstetrician, $pediatrician, $child_id, $mother, $father, $address, $barangay, $contact, $delivery_type, $weight, $length, $head_circumference, $chest_circumference, $blood_type, $eye_color, $hair_color, $dm, $nsd){

        $sql = "UPDATE `child_info` SET `child_firstname`= :firstname, `child_lastname` = :lastname, `child_middlename` = :middlename, `birth_date`= :bdate,`birth_time`= :btime,`birth_place`= :bplace,`gender`= :gender,`hospital`= :hospital,`obstetrician`= :obstetrician,`pediatrician`= :pediatrician, mother_name = :mother, father_name = :father, address = :address, barangay = :barangay, contact_number = :contact, typeofdelivery = :tod, weight = :weight, length = :length, head_circumference = :hc, chest_circumference = :cc, blood_type = :bt, eye_color = :ec, hair_color = :h_color, distinguishing_marks = :dm, newborn_screening_date = :nsd WHERE child_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":middlename", $middlename);
        $stmt->bindParam(":bdate", $birthdate);
        $stmt->bindParam(":btime", $birthtime);
        $stmt->bindParam(":bplace", $birthplace);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":hospital", $hospital);
        $stmt->bindParam(":obstetrician", $obstetrician);
        $stmt->bindParam(":pediatrician", $pediatrician);
        $stmt->bindParam(":id", $child_id);
        $stmt->bindParam( ":mother", $mother);
        $stmt->bindParam( ":father", $father);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":barangay", $barangay);
        $stmt->bindParam( ":contact", $contact);
        $stmt->bindParam(":tod", $delivery_type);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":hc", $head_circumference);
        $stmt->bindParam(":cc", $chest_circumference);
        $stmt->bindParam(":bt", $blood_type);
        $stmt->bindParam(":ec", $eye_color);
        $stmt->bindParam(":h_color", $hair_color);
        $stmt->bindParam(":dm", $dm);
        $stmt->bindParam(":nsd", $nsd);
        if ($stmt->execute()){

            $this->log->set("has edited $firstname $lastname data");
            return true;
        }
    }

    public function searchChild($query)
    {

        $query = "%$query%";

        $sql = "SELECT * FROM `child_info` WHERE child_firstname LIKE :query OR child_lastname LIKE :query LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":query", $query);
        if ($stmt->execute()){
            $output = "";
            $output = '<div class="overflow-auto">';
            $output = '<ul class="list-group text-xs">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $output .= '<li class="list-group-item view-child" data-id="'. $row['child_id'] .'">' . $row['child_firstname'] . ' ' . $row['child_middlename'] .' ' . $row['child_lastname'] .'</li>';            }
            $output .= '</ul>';
            $output .= '</div>';

            echo $output;
        }

    }


}