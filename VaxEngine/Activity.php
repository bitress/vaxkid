<?php

    class Activity {

        public function __construct()
        {
            $this->db = Database::getInstance();
        }

        /**
         * Insert activity into database
         * @param $user
         * @param $activity
         * @return bool|void
         */
        public function set($activity, $id = null){
            if (Session::get('isLoggedIn')){
                $user = Session::get('uid');
            } else {
                $user = $id;
            }

            $datetime = date("Y-m-d H:i:s");

            $sql = "INSERT INTO `logs` (`user`, `activity`, `date_created`) VALUES (:user, :act, :dc)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user", $user);
            $stmt->bindParam(":act", $activity);
            $stmt->bindParam(":dc", $datetime);
            if ($stmt->execute()){
                return true;
            }
        }

        public function fetch(){

            $user = Session::get('uid');

            $sql = "SELECT * FROM `logs` INNER JOIN `rhu` ON `rhu`.`user_d` = `logs`.`user` WHERE `logs`.`user` = :id ORDER BY date_created DESC ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $user);
            if ($stmt->execute()){
                return $stmt->fetchAll();
            }

        }
}