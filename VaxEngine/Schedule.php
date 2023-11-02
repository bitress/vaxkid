<?php

use GuzzleHttp\Exception\GuzzleException;
use Spatie\CalendarLinks\Link;
class Schedule
{

    /**
     * @var Database
     */
    private Database $db;
    /**
     * @var SmsSender
     */
    private SmsSender $sms;
    /**
     * @var Children
     */
    private Children $children;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->sms = new SmsSender();
        $this->children = new Children();
        $this->log = new Activity();
    }


    /**
     * Fetch All Schedules
     * @return array|false|void
     */
    public function fetch(){

        $sql = "SELECT * FROM `schedule` ORDER BY `schedule_id`";
        $stmt = $this->db->query($sql);
        if ($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }

    /**
     * Fetch schedules into JSON
     * @return void
     * @throws JsonException
     */
    public function getJSON(): void
    {
        $eventArr = array();
        foreach ($this->fetch() as $r){
            $eventArr[] = $r;
        }
        echo json_encode($eventArr, JSON_THROW_ON_ERROR);

    }

    public function fetchById($id){

        $sql = "SELECT * FROM schedule WHERE schedule_id = :sid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":sid", $id);
        if ($stmt->execute()){
            echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        }

    }

    public function edit($barangay, $message, $start, $end, $sid){

        $sql = "UPDATE schedule SET barangay = :b, message = :m, start_date = :s, end_date = :e WHERE schedule_id = :sid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":m", $message);
        $stmt->bindParam(":s", $start);
        $stmt->bindParam(":e", $end);
        $stmt->bindParam(":b", $barangay);
        $stmt->bindParam(":sid", $sid);
        if ($stmt->execute()){
            return true;
        }

    }

    public function set($message, $start_date, $end_date, $barangay, $isNextVisit = false, $child_id = null, $mother = null){

        try {

            if ($isNextVisit){
                $sql = "INSERT INTO `schedule` (message, start_date, end_date, barangay, isNextVisit, child_id) VALUES (:message, :start_date, :end_date, :barangay, :next_visit, :id)";
            } else {
                $sql = "INSERT INTO `schedule` (`message`, `start_date`, `end_date`, `barangay`) VALUES (:message, :start_date, :end_date, :barangay)";
            }

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":message", $message);
            $stmt->bindParam(":start_date", $start_date);
            $stmt->bindParam(":end_date", $end_date);
            $stmt->bindParam(":barangay", $barangay);
            if ($isNextVisit){
                $str = '1';
                $stmt->bindParam(":next_visit", $str);
                $stmt->bindParam(":id", $child_id);
            }
            if ($stmt->execute()){
                $this->log->set("has set a schedule");
                return true;
            }
        } catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
        return  false;
    }

    public function delete($id) {

        try {
            $sql = "DELETE FROM `schedule` WHERE `schedule_id` = :sid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":sid", $id);
            if ($stmt->execute()){
                return true;
            }

            return false;
        } catch (Exception $e){
            echo "Error: ". $e->getMessage();
        }
    }

    /**
     * @param $start
     * @param $end
     * @param $child_id
     * @return bool|void
     */
    public function setNextVisit($start, $end, $child_id){

        $c = $this->children->getChild($child_id);

        $message = "Good day, " . $c['mother_name'] . ".
Today is the schedule of the vaccination for ". $c['child_firstname']. "
Please come at RHU Tagudin on ". date("F j, Y",strtotime($start)) .".";

        if($this->set($message, $start, $end, 'n/a', true, $child_id, $c['mother_name'])){
            return true;
        }

    }


    public function sendToScheduledBarangay() {

        $SEND_BEFORE_DAYS = 1;
        $sql = "SELECT * FROM `schedule` WHERE DATEDIFF(`start_date`,CURDATE()) >= :sbd AND `status` = 'not_sent'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":sbd", $SEND_BEFORE_DAYS);
        if ($stmt->execute()){
            $schedule = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $c = $this->children->getAllChildren();
            // Fetch all schedule data
            foreach ($schedule as $sched) {

                // Fetch all child data
                foreach ($c as $child){

                    // Check if child barangay is in schedule
                    if ($sched['barangay'] === $child['barangay']){
                        if (SMS_SENDER === "gsm"){
                            $message = $this->generateSMSContent($sched['message'], true);
                            if($this->sms->init($child['contact_number'], $message)){
                                
                               
                                    $message = "A notice to Barangay " . $child['barangay'] . ", has been sent successfully";
                                    $datetime = date("Y-m-d h:i:s");
                            
                                   $sql = "UPDATE `schedule` SET `status` = 'sent' WHERE schedule_id = :sid";
                                    $stmt = $this->db->prepare($sql);
                                    $stmt->bindParam(":sid", $sched['schedule_id']);
                              
                                    if ($stmt->execute()){
                            
                                        $sql = "INSERT INTO `notification` (`message`, `datetime`)  VALUES (:message, :dt)";
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->bindParam(":message", $message);
                                        $stmt->bindParam(":dt", $datetime);
                                        if ($stmt->execute()){
                                            return true;
                                        }
                            
                                    } 
                            }
                        } else if (SMS_SENDER === "api") {
                            try {
                                $message = $this->generateSMSContent($sched['message']);

                                if($this->sms->fortresInit($child['contact_number'], $message)){
                                    if($this->markAsSent($sched['schedule_id'], $child['barangay'])){
                                        return true;
                                    }
                                }
                            } catch (GuzzleException $e){
                                echo $e->getMessage();
                            }
                        } else {
                            echo "Error: Please contact the server administrator";
                        }
                    }

                    if ($sched['isNextVisit'] === '1'){

                        if (SMS_SENDER === "gsm"){
                            $message = $this->generateSMSContent($sched['message'], true);
                            if($this->sms->init($child['contact_number'], $message)){
                                
                                      $message = "A notice to " . $child['mother_name'] . ", has been sent successfully";
                                    $datetime = date("Y-m-d h:i:s");
                            
                                    $sql = "UPDATE `schedule` SET `status` = 'sent' WHERE schedule_id = :sid";
                                    $stmt = $this->db->prepare($sql);
                                    $stmt->bindParam(":sid", $sched['schedule_id']);
                              

                                    if ($stmt->execute()){
                            
                                        $sql = "INSERT INTO `notification` (`message`, `datetime`)  VALUES (:message, :dt)";
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->bindParam(":message", $message);
                                        $stmt->bindParam(":dt", $datetime);
                                        if ($stmt->execute()){
                                            return true;
                                        }
                            
                                    }
                            }
                        } else if (SMS_SENDER === "api") {
                            try {
                                $message = $this->generateSMSContent($sched['message']);

                                if($this->sms->fortresInit($child['contact_number'], $message)){
                                    if($this->markAsSent($sched['schedule_id'], $child['mother_name'], true)){
                                        return true;
                                    }
                                }
                            } catch (GuzzleException $e){
                                echo $e->getMessage();
                            }
                        } else {
                            echo "Error: Please contact the server administrator";
                        }

                    }



                }
            }

        }
    }




    public function fetchAsNotification(){

        $sql = "SELECT * FROM notification ORDER BY datetime DESC LIMIT 15";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){

            $row = $stmt->fetchAll();

            $output = "";
            foreach ($row as $notify){
                $output .= '<a class="dropdown-item dropdown-notifications-item" href="#!">';
                $output .= '    <div class="dropdown-notifications-item-icon bg-warning"><i class="fa fa-bell"></i></div>';
                $output .= '    <div class="dropdown-notifications-item-content">';
                $output .= '       <div class="dropdown-notifications-item-content-details">'. date("M d, Y", strtotime($notify['datetime'])) .'</div>';
                $output .= '       <p class="">'. htmlentities($notify['message']) .'</p>';
                $output .= '</div>';
                $output .= '</a>';
            }

echo $output;
        }



        
    }



    private function markAsSent($schedule_id, $recipient, $isNextVisit = false){

        if ($isNextVisit){
            $message = "A notice to Barangay " . $recipient . ", has been sent successfully";
        } else {
            $message = "A notice to " . $recipient . ", has been sent successfully";
        }


        $datetime = date("Y-m-d h:i:s");

        $sql = "UPDATE `schedule` SET `status` = '1' WHERE schedule_id = :sid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":sid", $schedule_id);
        if ($stmt->execute()){

            $sql = "INSERT INTO `notification` (`message`, `datetime`)  VALUES (:message, :dt)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":message", $message);
            $stmt->bindParam(":dt", $datetime);
            if ($stmt->execute()){
                return true;
            }

        }
    }

    /**
     * Create a sms body
     * @param bool $isSms
     * @return string
     */
    public function generateSMSContent($body, bool $isSms = false)
    {
        if ($isSms){
            $body = preg_replace('/\s+/', '+', $body);
        }
        return $body;
    }

    private function makeCalendar($start, $end, $title, $description, $address){
        $from = DateTime::createFromFormat('Y-m-d', $start);
        $to = DateTime::createFromFormat('Y-m-d', $end);

        $link = Link::create($title, $from, $to)
            ->description($description)
            ->address($address);

        return $link->ics();

    }


}