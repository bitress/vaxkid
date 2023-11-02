<?php

class Login
{

    /**
     * @var Database
     */
    private $db;
    private Activity $log;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->log = new Activity();
    }

    /**
     * Check if a user is logged in
     * @return bool|void
     */
    public function isLoggedIn(){
        if (Session::get('isLoggedIn') && Session::get('uid')) {
            return true;
        } else {
            return false;
        }
    }

    public function checkLogin(){
        $res = array();
       if ($this->isLoggedIn()){
           $res['status'] = true;
           $res['role'] = Session::get('role');
       } else {
           $res['status'] = false;
       }
       echo json_encode($res);
    }

    /**
     * Logout user
     * @return void
     */
    public function logout()
    {

        $this->log->set("has logged out");
        Session::destroy('isLoggedIn');
        Session::destroy('uid');
        Session::destroy('role');

        header("Location: index.html");

    }

    /**
     * Login the user
     * @param $username user's username
     * @param $password user's password
     * @param $role user's role
     * @return bool|void
     */
    public function userLogin($username, $password, $role){
        $sql = "SELECT * FROM users WHERE username = :username AND role = :role LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":role", $role);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashed_password = $row['password'];
                $role = $row['role'];
                if (password_verify($password, $hashed_password)) {
                    $this->log->set("has logged in", $row['id']);
                    Session::set('isLoggedIn', true);
                    Session::set('role', $role);
                    Session::set('uid', $row['id']);
                    return true;
                } else {
                    echo "Incorrect Password";
                }
            } else {
                echo "No username found";

            }
        }
    }

}