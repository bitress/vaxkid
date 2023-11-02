<?php

require '../fpdf/fpdf.php';

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
$pdf->SetFont('Arial','',9);
$pdf->Cell(250,8,'MASTERLIST OF POST IMMUNIZATION 2022',1,0,'C');
$pdf->Ln(8);
$pdf->Cell(45, 10, 'Name of Child', 1, 0, 'C');
$pdf->Cell(20, 10, 'B-day', 1, 0, 'C');
$pdf->Cell(45, 10, 'Mother', 1, 0, 'C');
$pdf->Cell(40, 10, 'Address', 1, 0, 'C');
$pdf->Cell(10, 10, 'BCG', 1, 0, 'C');
$pdf->Cell(15, 10, 'PENTA', 1, 0, 'C');
$pdf->Cell(15, 10, 'PCV', 1, 0, 'C');
$pdf->Cell(15, 10, 'OPV', 1, 0, 'C');
$pdf->Cell(12, 10, 'IPV', 1, 0, 'C');
$pdf->Cell(8, 10, 'MCV', 1, 0, 'C');
$pdf->Cell(25, 10, 'Remarks', 1, 0, 'C');
$pdf->Ln();



$pdf->Cell(45, 6, 'Cyanne Justin Vega', 1, 0, 'C');
$pdf->Cell(20, 6, 'Dec 01, 2002', 1, 0, 'C');
$pdf->Cell(45, 6, 'Mother', 1, 0, 'C');
$pdf->Cell(40, 6, 'Bio, Tagudin, Ilocos Sur', 1, 0, 'C');
$pdf->Cell(10, 6, '/', 1, 0, 'C');
$pdf->Cell(15, 6, '3 dose', 1, 0, 'C');
$pdf->Cell(15, 6, '3 dose', 1, 0, 'C');
$pdf->Cell(15, 6, '3 dose', 1, 0, 'C');
$pdf->Cell(12, 6, '2 dose', 1, 0, 'C');
$pdf->Cell(8, 6, '/', 1, 0, 'C');
$pdf->Cell(25, 6, 'Sample Remark', 1, 0, 'C');
$pdf->Ln(500);


$pdf->Cell(45,10,'Name',1,0,'C'); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(20,10,'Birthday',1,0,'C'); //vertically merged cell
$pdf->Cell(40,10,'Mother',1,0,'C'); //vertically merged cell
$pdf->Cell(40,10,'Address',1,0,'C'); //vertically merged cell
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
$pdf->Cell(166,5,'',0,0); //dummy cell to align next cell, should be invisible
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


$pdf->Cell(45,6,'Name',1,0,'C'); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(20,6,'Birthday',1,0,'C'); //vertically merged cell
$pdf->Cell(40,6,'Mother',1,0,'C'); //vertically merged cell
$pdf->Cell(40,6,'Address',1,0,'C'); //vertically merged cell
$pdf->Cell(10,6,'',1,0); //vertically merged cell
$pdf->Cell(11,6,'',1,0); //vertically merged cell
$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);

$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);

$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);

$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);

$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);
$pdf->Cell(5,6,'',1,0);

$pdf->Cell(15,6,'Remarks',1,0); //vertically merged cell
$pdf->Cell(0,5,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible


//
////data rows
//$pdf->Cell(20,5,'',1,0);
//$pdf->Cell(50,5,'',1,0);
//$pdf->Cell(25,5,'',1,0);
//$pdf->Cell(25,5,'',1,0);
//$pdf->Cell(25,5,'',1,0);
//$pdf->Cell(25,5,'',1,0);


$pdf->Output();





