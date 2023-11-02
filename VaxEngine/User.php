<?php

class User
{

    /**
     * @var Database
     */
    private $db;
    /**
     * @var mixed
     */
    private $user;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->user = Session::get('uid');
    }

    /**
     * Get logged in user data
     * @return mixed|void
     */
    public function getData()
    {
        $sql = "SELECt * FROM `users` INNER JOIN rhu ON rhu.user_d = users.id WHERE users.id = :uid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":uid", $this->user);
        if ($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Check if user mho
     * @return bool
     */
    public function mhoAccessOnly()
    {
        $u = $this->getData();
        if ($u['role'] === 'mho'){
            return true;
        }
    }



    /**
     * Get user data
     * @return mixed|void
     */
    public function getUserData($id)
    {
        $sql = "SELECt * FROM `users` INNER JOIN rhu ON rhu.user_d = users.id WHERE users.id = :uid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":uid", $id);
        if ($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Get all user data
     * @return mixed|void
     */
    public function getAllUserData()
    {
        $sql = "SELECt * FROM `users` INNER JOIN rhu ON rhu.user_d = users.id WHERE role = 'midwife' ORDER BY user_d";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function editUserData($username, $email, $newpassword, $confirmpassword, $id, $role = 'midwife'){

        $password = password_hash($confirmpassword, PASSWORD_DEFAULT);

        $sql = "UPDATE `users` SET `username` = :un, `email` = :email, `password` = :pass, `role` = :role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":un", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pass", $password);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()){
            return true;
        }

    }


    public function editUserSettings($username, $firstname, $middlename, $lastname, $address, $assigned, $email, $contact_number, $oldpassword, $newpass, $confirmpass, $user_d){


        if (empty($username) || empty($firstname) || empty($middlename) || empty($lastname) || empty($address) || empty($assigned) || empty($email) || empty($contact_number)) {
            echo "Fields are required";
            return false;
        }

//        if ($this->checkUsernameExist($username)){
//            echo "Username is already taken";
//            return false;
//        }

        $sql = "UPDATE `rhu` SET firstname = :fn, middlename = :mn, lastname = :ln, address = :address, contact_number = :cn, assigned_barangay = :assigned WHERE user_d = :uid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":fn", $firstname);
        $stmt->bindParam(":mn", $middlename);
        $stmt->bindParam(":ln", $lastname);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":assigned", $assigned);
        $stmt->bindParam(":cn", $contact_number);
        $stmt->bindParam(":uid", $user_d);
        if ($stmt->execute()){
            $user = $this->getUserData($user_d);
            if (empty($oldpassword) || empty($newpass) || empty($confirmpass)){
                  $hashed_password = $user['password'];
            } else {

                if (password_verify($oldpassword, $user['password'])){
                    $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
                } else {
                    echo "Old password is incorrect";
                    return false;
                }

            }

            $sql = "UPDATE `users` SET `username` = :un, `email` = :email, `password` = :pass WHERE `id` = :uid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":un", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $hashed_password);
            $stmt->bindParam(":uid", $user_d);
            if ($stmt->execute()){
                return true;
            }
        }


    }



    private function checkUsernameExist($username){

        $sql = "SELECT * FROM `users` WHERE username = :un LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":un", $username);
        if ($stmt->execute()){
            if ($stmt->rowCount() > 0){
                return true;
            }
        }

    }

}