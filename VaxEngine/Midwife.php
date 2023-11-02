<?php

class Midwife
{

    private Database $db;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->log = new Activity();
    }

    public function fetchMidwives($isRhuTable = false){

        if ($isRhuTable){
            $sql = "SELECT * FROM users INNER JOIN rhu ON rhu.user_d = users.id WHERE users.role = 'midwife' ORDER BY rhu.id";
        } else {
            $sql = "SELECT * FROM users INNER JOIN rhu ON rhu.user_d = users.id WHERE users.role = 'midwife' ORDER BY rhu.id";
        }

        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function fetchMidwife($id) {

        $sql = "SELECT * FROM `rhu` WHERE `user_d` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()){
            if ($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo json_encode($row);

            }

        }

    }

    public function delete($id)
    {
       $sql = "DELETE FROM `users` WHERE `id` = :id";
       $stmt = $this->db->prepare($sql);
       $stmt->bindParam(":id", $id);
       if($stmt->execute()){
        return true;
       }
    }

    public function add($firstname, $middlename, $lastname, $username, $email, $position, $assigned, $address, $phone, $newpass, $confirmpass){

        try {

            $newpass = password_hash($newpass, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES (:un, :email, :pwd, :ro)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":un", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pwd", $newpass);
            $role = 'midwife';
            $stmt->bindParam(":ro", $role);
            if ($stmt->execute()){

                $id = $this->db->lastInsertId();
                $sql = "INSERT INTO `rhu` (`user_d`, `firstname`, `middlename`, `lastname`, `position`, `address`, `contact_number`, `assigned_barangay`) 
VALUES (:uid, :fname, :mname, :lname, :position, :address, :number, :barangay)";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":uid", $id);
                $stmt->bindParam(":fname", $firstname);
                $stmt->bindParam(":mname", $middlename);
                $stmt->bindParam(":lname", $lastname);
                $stmt->bindParam(":position", $position);
                $stmt->bindParam(":address", $address);
                $stmt->bindParam(":number", $phone);
                $stmt->bindParam(":barangay", $assigned, PDO::PARAM_STR);

                if ($stmt->execute()){
                    $this->log->set("has added a new midwife");
                    return true;
                }
            }

        } catch (Exception $e){
            echo "Error" . $e->getMessage();
        }
    }

    public function edit($id, $firstname, $middlename, $lastname, $position, $address, $contact_number, $assigned_barangay)
    {

        try {

            $sql = "UPDATE rhu SET firstname = :fn, middlename = :mn, lastname = :ln, position = :pos, address = :addr, contact_number = :cn, assigned_barangay = :assigned WHERE `user_d` = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":fn", $firstname);
            $stmt->bindParam(":mn", $middlename);
            $stmt->bindParam(":ln", $lastname);
            $stmt->bindParam(":pos", $position);
            $stmt->bindParam(":addr", $address);
            $stmt->bindParam(":cn", $contact_number);
            $stmt->bindParam(":assigned", $assigned_barangay);
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()){
                return true;
            }

        } catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

}