<?php

class Vaccine
{

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->log = new Activity();
    }

    public function getAllVaccines(){

        $sql = "SELECT * FROM `vaccines` ORDER BY expiration_date ASC";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
            $data = [];
            while($row = $stmt->fetch()) {
                $date = date("Y-m-d");
                $expiration = strtotime($row['expiration_date']);

                // Check vaccine quantity
                if ($row['quantity'] > 0) {

                    // Check if vaccine has not expired yet

                    $data[] = [
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "quantity" => $row['quantity'],
                        "dosage" => $row['dosage'],
                        "origin" => $row['origin'],
                        "manufacture_date" => $row['manufacture_date'],
                        "expiration_date" => $row['expiration_date'],
                        "no_quantity" => !(($row['quantity'] > 0 )),
                        "has_expired" => !(($expiration > strtotime($date)))
                    ];

                }
            }

//            echo json_encode($data);
            return ($data);

        }

    }

    public function isVaccineAdministered($id, $vaccine_id){

        $sql = "SELECT * FROM child_vaccine WHERE child_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()){
            $row = $stmt->fetch();
            if ($row['vaccine_id'] == $vaccine_id){
                return true;
            }
        }
    }

    public function fetchVaccineById($id){
        $sql = "SELECT * FROM vaccines WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()){
            echo json_encode($stmt->fetch());
        }
    }

    public function addVaccine($name, $quantity, $dosage, $origin, $manufacture_date, $expiration_date){

        try {

            $sql = "INSERT INTO `vaccines` (`name`, `quantity`, `dosage` , `origin`, `manufacture_date`, `expiration_date`) VALUES (:name, :quantity, :dosage, :origin, :md, :ed)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":quantity", $quantity);
            $stmt->bindParam(":dosage", $dosage);
            $stmt->bindParam(":origin", $origin);
            $stmt->bindParam(":md", $manufacture_date);
            $stmt->bindParam(":ed", $expiration_date);
            if ($stmt->execute()){
                $this->log->set("has added a new vaccine");
                return true;
            }

        } catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }

    }

    public function decreaseQuanity($id){
        $sql = "UPDATE vaccines SET `quantity` = quantity - 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()){
            return true;
        }
    }

    public function deleteVaccine($id){

        $sql = "DELETE FROM vaccines WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()){
            $this->log->set("has deleted a vaccine");
            return true;
        }

    }

    public function editVaccine($name, $quantity, $dosage, $origin, $manufacture_date, $expiration_date, $id){

        $sql = "UPDATE `vaccines` SET `name` = :name, `quantity` = :q, `dosage` = :dosage, `origin` = :origin, `manufacture_date` = :md, `expiration_date` = :ed WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":q", $quantity);
        $stmt->bindParam(":dosage", $dosage);
        $stmt->bindParam(":origin", $origin);
        $stmt->bindParam(":md", $manufacture_date);
        $stmt->bindParam(":ed", $expiration_date);
        if ($stmt->execute()){
            $this->log->set("has edited a vaccine");
            return true;
        }

    }

}