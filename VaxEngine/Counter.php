<?php

class Counter
{

    private Database $db;

    public function __construct()
    {

        $this->db = Database::getInstance();

    }

    public function vaccinatedKidsOverAll(){
        $sql = "SELECT COUNT(DISTINCT(child_id)) as count FROM `child_vaccine`";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $row['count'];
        }
    }

    public function unvaccinatedKidsOverAll() {
        $sql = "SELECT COUNT(*) as count FROM `child_info` WHERE NOT EXISTS (SELECT * FROM `child_vaccine` WHERE `child_vaccine`.`child_id` = `child_info`.child_id)";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $row['count'];
        }
    }


    public function countVaccinatedInEachBarangay() {

        $barangay = [ "Ag-aguman", "Ambalayat", "Baracbac", "Bario-an", "Baritao", "Becques", "Bimmanga", "Bio", "Bitalag", "Borono", "Bucao East", "Bucao West", "Cabaroan", "Cabugbugan", "Cabulanglangan", "Dacutan", "Dardarat", "Del Pilar", "Farola", "Gabur", "Garitan", "Jardin", "Lacong", "Lantag", "Las-ud", "Libtong", "Lubnac", "Magsaysay", "Malacañang", "Pacac", "Pallogan", "Pula", "Pudoc East", "Pudoc West", "Quirino", "Ranget", "Rizal", "Salvacion", "San Miguel", "Sawat", "Tallaoen", "Tampugo" ];

        $arr = array();
        foreach ($barangay as $bar) {

            $sql = "SELECT child_info.child_firstname, child_info.barangay FROM `child_vaccine` INNER JOIN child_info ON child_info.child_id = child_vaccine.child_id WHERE barangay = :br GROUP BY child_info.child_firstname, child_info.barangay; ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":br", $bar);

            if ($stmt->execute()) {


                $count = $stmt->rowCount();

                if ($count > 0) {
                    $arr[] = "{x: '$bar',y: " . $count . "}";
                }
            }
        }
        return $arr;
    }



    public function countUnvaccinatedInEachBarangay(){

        $barangay = [ "Ag-aguman", "Ambalayat", "Baracbac", "Bario-an", "Baritao", "Becques", "Bimmanga", "Bio", "Bitalag", "Borono", "Bucao East", "Bucao West", "Cabaroan", "Cabugbugan", "Cabulanglangan", "Dacutan", "Dardarat", "Del Pilar", "Farola", "Gabur", "Garitan", "Jardin", "Lacong", "Lantag", "Las-ud", "Libtong", "Lubnac", "Magsaysay", "Malacañang", "Pacac", "Pallogan", "Pula", "Pudoc East", "Pudoc West", "Quirino", "Ranget", "Rizal", "Salvacion", "San Miguel", "Sawat", "Tallaoen", "Tampugo" ];

        $arr = array();
        foreach ($barangay as $bar) {

            $sql = "SELECT COUNT(*) as count, barangay FROM `child_info` WHERE NOT EXISTS (SELECT * FROM `child_vaccine` WHERE `child_vaccine`.`child_id` = `child_info`.child_id) AND barangay = :br GROUP By barangay;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":br", $bar);


            if ($stmt->execute()){
                $count = $stmt->rowCount();

                if($count > 0){
                    $arr[] = "{x: '$bar',y: " . $count ."}";
                }


            }
        }
        return ($arr);
    }


    public function countVaccinatedYearly(){

        $sql = "SELECT COUNT(DISTINCT(child_id)) as count, EXTRACT(year FROM datetime) as `year` FROM `child_vaccine` GROUP BY EXTRACT(year FROM datetime)";
        $stmt = $this->db->query($sql);
        if ($stmt->execute()){

            $year = [];
            $count = [];
            $i = 0;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $years[$i] = intval($row['year']);
                $counts[$i] = intval($row['count']);
                $i++;
                $year = array("year" => $years);
                $count = array("count" => $counts);
            }

            $arr = array_merge($year, $count);

            echo json_encode($arr);

        }
    }


    public function generateHex() {

        $x = 0;
        $colors = [];
        while ($x <= 43){
            $x++;
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $colors[] = '#'.$rand;

        }

        echo json_encode($colors);



    }

}