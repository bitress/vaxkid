<?php
error_reporting(0);
include_once '../config/init.php';

class PDF extends FPDF
{

    function Header(){

        $mho_logo = '../assets/img/logo/mho_logo.jpg';
        $tagudin_logo = '../assets/img/logo/tagudin_logo.jpg';

        $this->Image($tagudin_logo, 34,8, 28);
        $this->Image($mho_logo, 220, 14, 24);

        $this->SetFont('Arial','',12);
        $this->Cell(0, 15,'Republic of the Philippines', 0, 0, 'C' );
        $this->Ln( 5);
        $this->Cell(0, 15,'Heritage Province of Ilocos Sur', 0, 0, 'C' );
        $this->Ln( 5 );
        $this->Cell(0, 15,'Municipality of Tagudin', 0, 0, 'C' );
        $this->SetFont('Arial','',18);
        $this->Ln( 5 );
        $this->Cell(0, 15,'Office of the Municipal Health Officer', 0, 0, 'C' );
        $this->Ln( 5 );
        $this->SetFont('Arial','I',9);
        $this->Cell(0, 15,'PCB, DOTs & ABTC Philhealth Accredited', 0, 0, 'C' );

        $this->Ln(20);
    }
}


$pdf = new PDF('L','mm','Letter');
$pdf->AddPage('L', 'Letter');

//$pdf->SetTextColor(255,0,0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $barangay = $_POST['barangay'];
    $display = $_POST['display'];
    $type = $_POST['type'];

}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $barangay = $_GET['barangay'];
    $display = $_GET['display'];
    $type = $_GET['type'];
}







if ($display === "Vaccination"){


    //$pdf->SetTextColor(255,0,0);
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(250,8,'MASTERLIST OF POST IMMUNIZATION 2022',1,0,'C');
    $pdf->Ln(8);
    $pdf->Cell(45,10,'Name',1,0,'C'); //vertically merged cell, height=2x row height=2x5=10
    $pdf->Cell(20,10,'Birthday',1,0,'C'); //vertically merged cell
    $pdf->Cell(40,10,'Mother',1,0,'C'); //vertically merged cell
    $pdf->Cell(44,10,'Address',1,0,'C'); //vertically merged cell
    $pdf->Cell(10,10,'BCG',1,0); //vertically merged cell
    $pdf->Cell(11,10,'Hep B',1,0); //vertically merged cell

    $pdf->Cell(15,5,'OPV',1,0, 'C'); //normal height, but occupy 4 columns (horizontally merged)
    $pdf->Cell(10,5,'IPV',1,0, 'C'); //normal height, but occupy 4 columns (horizontally merged)
    $pdf->Cell(10,5,'MCV',1,0, 'C'); //normal height, but occupy 4 columns (horizontally merged)
    $pdf->Cell(15,5,'PENTA',1,0,'C'); //normal height, but occupy 4 columns (horizontally merged)
    $pdf->Cell(15,5,'PCV',1,0,'C'); //normal height, but occupy 4 columns (horizontally merged)

    $pdf->Cell(15,10,'Remarks',1,0); //vertically merged cell
    $pdf->Cell(0,5,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible

//second line(row)
    $pdf->Cell(170,5,'',0,0); //dummy cell to align next cell, should be invisible
    $pdf->Cell(5,5,'1',1,0);
    $pdf->Cell(5,5,'2',1,0);
    $pdf->Cell(5,5,'3',1,0);

    $pdf->Cell(5,5,'1',1,0);
    $pdf->Cell(5,5,'2',1,0);

    $pdf->Cell(5,5,'1',1,0);
    $pdf->Cell(5,5,'2',1,0);

    $pdf->Cell(5,5,'1',1,0);
    $pdf->Cell(5,5,'2',1,0);
    $pdf->Cell(5,5,'3',1,0);

    $pdf->Cell(5,5,'1',1,0);
    $pdf->Cell(5,5,'2',1,0);
    $pdf->Cell(5,5,'3',1,0);

    $pdf->Ln();

    if ($barangay === "All"){

        if ($type === "All"){
            $sql = "SELECT child_info.child_firstname, child_info.child_middlename, child_info.child_lastname, child_info.mother_name, child_info.birth_date, child_info.address, child_info.barangay, 
            SUM(IF(vaccines.name = 'BCG', 1, 0)) AS bcg, 
            SUM(IF(vaccines.name = 'Hep B', 1, 0)) AS hep_b,
            SUM(IF(vaccines.name = 'OPV 1', 1, 0)) AS opv1,
            SUM(IF(vaccines.name = 'OPV 2', 1, 0)) AS opv2,
            SUM(IF(vaccines.name = 'OPV 3', 1, 0)) AS opv3,
            SUM(IF(vaccines.name = 'IPV 1', 1, 0)) AS ipv1,
            SUM(IF(vaccines.name = 'IPV 2', 1, 0)) AS ipv2,
            SUM(IF(vaccines.name = 'MCV 1', 1, 0)) AS mcv1,
            SUM(IF(vaccines.name = 'MCV 2', 1, 0)) AS mcv2,
            SUM(IF(vaccines.name = 'PENTA 1', 1, 0)) AS penta1,
            SUM(IF(vaccines.name = 'PENTA 2', 1, 0)) AS penta2,
            SUM(IF(vaccines.name = 'PENTA 3', 1, 0)) AS penta3,
            SUM(IF(vaccines.name = 'PCV 1', 1, 0)) AS pcv1,
            SUM(IF(vaccines.name = 'PCV 2', 1, 0)) AS pcv2,
            SUM(IF(vaccines.name = 'PCV 3', 1, 0)) AS pcv3
         FROM `child_vaccine` RIGHT JOIN child_info ON child_info.child_id = child_vaccine.child_id LEFT JOIN vaccines on child_vaccine.vaccine_id = vaccines.id  GROUP BY child_info.child_firstname, child_info.barangay";

        } else if ($type === "vaccinated"){

            $sql = "SELECT child_info.child_firstname, child_info.child_middlename, child_info.child_lastname, child_info.mother_name, child_info.birth_date, child_info.address, child_info.barangay, 
 SUM(IF(vaccines.name = 'BCG', 1, 0)) AS bcg, 
            SUM(IF(vaccines.name = 'Hep B', 1, 0)) AS hep_b,
            SUM(IF(vaccines.name = 'OPV 1', 1, 0)) AS opv1,
            SUM(IF(vaccines.name = 'OPV 2', 1, 0)) AS opv2,
            SUM(IF(vaccines.name = 'OPV 3', 1, 0)) AS opv3,
            SUM(IF(vaccines.name = 'IPV 1', 1, 0)) AS ipv1,
            SUM(IF(vaccines.name = 'IPV 2', 1, 0)) AS ipv2,
            SUM(IF(vaccines.name = 'MCV 1', 1, 0)) AS mcv1,
            SUM(IF(vaccines.name = 'MCV 2', 1, 0)) AS mcv2,
            SUM(IF(vaccines.name = 'PENTA 1', 1, 0)) AS penta1,
            SUM(IF(vaccines.name = 'PENTA 2', 1, 0)) AS penta2,
            SUM(IF(vaccines.name = 'PENTA 3', 1, 0)) AS penta3,
            SUM(IF(vaccines.name = 'PCV 1', 1, 0)) AS pcv1,
            SUM(IF(vaccines.name = 'PCV 2', 1, 0)) AS pcv2,
            SUM(IF(vaccines.name = 'PCV 3', 1, 0)) AS pcv3
         FROM `child_vaccine` INNER JOIN child_info ON child_info.child_id = child_vaccine.child_id LEFT JOIN vaccines on child_vaccine.vaccine_id = vaccines.id  GROUP BY child_info.child_firstname, child_info.barangay";

        } else if ($type === "not_vaccinated"){
            $sql = "SELECT child_info.child_firstname, child_info.child_middlename, child_info.child_lastname, child_info.mother_name, child_info.birth_date, child_info.address, child_info.barangay, 
       SUM(IF(vaccines.name = 'BCG', 1, 0)) AS bcg, 
            SUM(IF(vaccines.name = 'Hep B', 1, 0)) AS hep_b,
            SUM(IF(vaccines.name = 'OPV 1', 1, 0)) AS opv1,
            SUM(IF(vaccines.name = 'OPV 2', 1, 0)) AS opv2,
            SUM(IF(vaccines.name = 'OPV 3', 1, 0)) AS opv3,
            SUM(IF(vaccines.name = 'IPV 1', 1, 0)) AS ipv1,
            SUM(IF(vaccines.name = 'IPV 2', 1, 0)) AS ipv2,
            SUM(IF(vaccines.name = 'MCV 1', 1, 0)) AS mcv1,
            SUM(IF(vaccines.name = 'MCV 2', 1, 0)) AS mcv2,
            SUM(IF(vaccines.name = 'PENTA 1', 1, 0)) AS penta1,
            SUM(IF(vaccines.name = 'PENTA 2', 1, 0)) AS penta2,
            SUM(IF(vaccines.name = 'PENTA 3', 1, 0)) AS penta3,
            SUM(IF(vaccines.name = 'PCV 1', 1, 0)) AS pcv1,
            SUM(IF(vaccines.name = 'PCV 2', 1, 0)) AS pcv2,
            SUM(IF(vaccines.name = 'PCV 3', 1, 0)) AS pcv3
FROM `child_vaccine` RIGHT JOIN child_info ON child_info.child_id = child_vaccine.child_id LEFT JOIN vaccines on child_vaccine.vaccine_id = vaccines.id  WHERE child_vaccine.child_id IS NULL GROUP BY child_info.child_firstname, child_info.barangay";

        } else {
            echo "nothing to print";
        }

        $filename = "Vaccination_Report_All_Barangay_". date("Y-m-d");


    } else {
        $filename = "Vaccination_Report_". $barangay ."_". date("Y-m-d");

        if ($type === "All"){
            $sql = "SELECT child_info.child_firstname, child_info.child_middlename, child_info.child_lastname, child_info.mother_name, child_info.birth_date, child_info.address, child_info.barangay, 
 SUM(IF(vaccines.name = 'BCG', 1, 0)) AS bcg, 
            SUM(IF(vaccines.name = 'Hep B', 1, 0)) AS hep_b,
            SUM(IF(vaccines.name = 'OPV 1', 1, 0)) AS opv1,
            SUM(IF(vaccines.name = 'OPV 2', 1, 0)) AS opv2,
            SUM(IF(vaccines.name = 'OPV 3', 1, 0)) AS opv3,
            SUM(IF(vaccines.name = 'IPV 1', 1, 0)) AS ipv1,
            SUM(IF(vaccines.name = 'IPV 2', 1, 0)) AS ipv2,
            SUM(IF(vaccines.name = 'MCV 1', 1, 0)) AS mcv1,
            SUM(IF(vaccines.name = 'MCV 2', 1, 0)) AS mcv2,
            SUM(IF(vaccines.name = 'PENTA 1', 1, 0)) AS penta1,
            SUM(IF(vaccines.name = 'PENTA 2', 1, 0)) AS penta2,
            SUM(IF(vaccines.name = 'PENTA 3', 1, 0)) AS penta3,
            SUM(IF(vaccines.name = 'PCV 1', 1, 0)) AS pcv1,
            SUM(IF(vaccines.name = 'PCV 2', 1, 0)) AS pcv2,
            SUM(IF(vaccines.name = 'PCV 3', 1, 0)) AS pcv3
         FROM `child_vaccine` RIGHT JOIN child_info ON child_info.child_id = child_vaccine.child_id LEFT JOIN vaccines on child_vaccine.vaccine_id = vaccines.id  WHERE barangay = '$barangay' GROUP BY child_info.child_firstname, child_info.barangay";

        } else if ($type === "vaccinated"){

            $sql = "SELECT child_info.child_firstname, child_info.child_middlename, child_info.child_lastname, child_info.mother_name, child_info.birth_date, child_info.address, child_info.barangay, 
 SUM(IF(vaccines.name = 'BCG', 1, 0)) AS bcg, 
            SUM(IF(vaccines.name = 'Hep B', 1, 0)) AS hep_b,
            SUM(IF(vaccines.name = 'OPV 1', 1, 0)) AS opv1,
            SUM(IF(vaccines.name = 'OPV 2', 1, 0)) AS opv2,
            SUM(IF(vaccines.name = 'OPV 3', 1, 0)) AS opv3,
            SUM(IF(vaccines.name = 'IPV 1', 1, 0)) AS ipv1,
            SUM(IF(vaccines.name = 'IPV 2', 1, 0)) AS ipv2,
            SUM(IF(vaccines.name = 'MCV 1', 1, 0)) AS mcv1,
            SUM(IF(vaccines.name = 'MCV 2', 1, 0)) AS mcv2,
            SUM(IF(vaccines.name = 'PENTA 1', 1, 0)) AS penta1,
            SUM(IF(vaccines.name = 'PENTA 2', 1, 0)) AS penta2,
            SUM(IF(vaccines.name = 'PENTA 3', 1, 0)) AS penta3,
            SUM(IF(vaccines.name = 'PCV 1', 1, 0)) AS pcv1,
            SUM(IF(vaccines.name = 'PCV 2', 1, 0)) AS pcv2,
            SUM(IF(vaccines.name = 'PCV 3', 1, 0)) AS pcv3
         FROM `child_vaccine` INNER JOIN child_info ON child_info.child_id = child_vaccine.child_id LEFT JOIN vaccines on child_vaccine.vaccine_id = vaccines.id  WHERE barangay = '$barangay' GROUP BY child_info.child_firstname, child_info.barangay";

        } else if ($type === "not_vaccinated"){
            $sql = "SELECT child_info.child_firstname, child_info.child_middlename, child_info.child_lastname, child_info.mother_name, child_info.birth_date, child_info.address, child_info.barangay,  SUM(IF(child_vaccine.vaccine_id = 1, 1, 0)) AS bcg, SUM(IF(child_vaccine.vaccine_id = 2, 1, 0)) AS pcv, SUM(IF(child_vaccine.vaccine_id = 3, 1, 0)) AS ipv, SUM(IF(child_vaccine.vaccine_id = 4, 1, 0)) AS opv, SUM(IF(child_vaccine.vaccine_id = 5, 1, 0)) AS mcv, SUM(IF(child_vaccine.vaccine_id = 6, 1, 0)) AS penta FROM `child_vaccine` RIGHT JOIN child_info ON child_info.child_id = child_vaccine.child_id WHERE barangay = '$barangay' AND child_vaccine.child_id IS NULL GROUP BY child_info.child_firstname, child_info.barangay";

        } else {
            echo "nothing to print";
        }

    }

    $stmt = $db->prepare($sql);
    if ($stmt->execute()){
        $row = $stmt->fetchAll();

        foreach ($row as $r){


            $pdf->Cell(45, 6, ucwords(strtolower($r['child_firstname'] . ' ' . $r['child_middlename'] . ' ' . $r['child_lastname'])) , 1, 0, 'C');
            $pdf->Cell(20, 6, $r['birth_date'], 1, 0, 'C');
            $pdf->Cell(40, 6, ucwords(strtolower($r['mother_name'])), 1, 0, 'C');
            $pdf->Cell(44, 6, ucwords(strtolower($r['barangay'])), 1, 0, 'C');

            $pdf->Cell(10,6,($r['bcg'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(11,6,($r['hep_b'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['opv1'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['opv2'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['opv3'] != 0) ? "/" : "",1,0,'C');

            $pdf->Cell(5,6,($r['ipv1'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['ipv2'] != 0) ? "/" : "",1,0,'C');

            $pdf->Cell(5,6,($r['mcv1'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['mcv2'] != 0) ? "/" : "",1,0,'C');

            $pdf->Cell(5,6,($r['penta1'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['penta2'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['penta3'] != 0) ? "/" : "",1,0,'C');

            $pdf->Cell(5,6,($r['pcv1'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['pcv2'] != 0) ? "/" : "",1,0,'C');
            $pdf->Cell(5,6,($r['pcv3'] != 0) ? "/" : "",1,0,'C');

            $pdf->Cell(15,6,'',1,0); //vertically merged cell
            $pdf->Cell(0,6,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible


        }

    }





} else if ($display === "Schedule"){


    $pdf->SetFont('Arial','',9);
    if($type === "Today") {
        $title = "Schedule for Vaccination Today (". date("M d, Y", strtotime(date("Y-m-d"))) .")";
    } else {
        $title = "Schedule for Vaccination Tomorrow (". date("M d, Y", strtotime(date("Y-m-d", strtotime("+1 day")))) .")";
    }
    $pdf->Cell(250,8,$title,1,0,'C');
    $pdf->Ln(8);
    $pdf->Cell(60, 10, 'Name of Child', 1, 0, 'C');
    $pdf->Cell(60, 10, 'B-day', 1, 0, 'C');
    $pdf->Cell(65, 10, 'Mother', 1, 0, 'C');
    $pdf->Cell(65, 10, 'Address', 1, 0, 'C');
    $pdf->Ln();

    if ($type === 'Today'){

        if($barangay === "All"){
            $filename = "vaxkid-Schedule_For_All_Barangay";

            $sql = "SELECT * FROM `schedule` INNER JOIN child_info ON child_info.barangay = schedule.barangay WHERE CAST(start_date AS DATE) = CAST( curdate() AS DATE); ";
        } else {
            $filename = "vaxkid-Schedule_For_". $barangay;

            $sql = "SELECT * FROM `schedule` INNER JOIN child_info ON child_info.barangay = schedule.barangay WHERE CAST(start_date AS DATE) = CAST( curdate() AS DATE) AND schedule.barangay = '$barangay'";
        }
    } else if ($type === "Upcoming") {

        if ($barangay === "All"){
            $sql = "SELECT * FROM `schedule` INNER JOIN child_info ON child_info.barangay = schedule.barangay WHERE `start_date` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 DAY)";
        } else {
            $sql = "SELECT * FROM `schedule` INNER JOIN child_info ON child_info.barangay = schedule.barangay WHERE `start_date` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 DAY) AND schedule.barangay = '$barangay'";
        }

    } else {
        echo "Nothing to print";
    }


    /** @var Database $db */
    $stmt = $db->prepare($sql);
    if ($stmt->execute()){

        $row = $stmt->fetchAll();

        foreach ($row as $s) {
            $pdf->Cell(60, 6, $s['child_firstname'] . ' ' . $s['child_middlename'] . ' ' . $s['child_lastname'], 1, 0, 'C');
            $pdf->Cell(60, 6, date("M d, Y", strtotime($s['birth_date'])), 1, 0, 'C');
            $pdf->Cell(65, 6, $s['mother_name'], 1, 0, 'C');
            $pdf->Cell(65, 6, $s['address'], 1, 0, 'C');
            $pdf->Ln();
        }

    }

} else {
    echo "Nothing to print";
}

$pdf->Output('', $filename);