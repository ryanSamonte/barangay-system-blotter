<?php
    require('../fpdf181/fpdf.php');
    require_once('../functions/connection.php');

global $conn;

if(ISSET($_GET['bID'])){
    $blotterIDFromURL = $_GET['bID'];
}

$pdf = new FPDF('P', 'mm', 'Legal');
$pdf->SetMargins(25.4, 25.4);
$pdf->SetRightMargin(100);

$pdf->AddPage();
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(170,10,'TANGGAPAN NG LUPONG TAGAPAMAYAPA', 0, 1, 'C');
$pdf->Cell(25,10,'', 0, 1);
$pdf->SetFont('times','B', 12);
$pdf->Cell(25,10,'KAY/KINA:', 0, 0);
$pdf->SetFont('times','U', 11);

$retrieveNames = "SELECT lastname, firstname, middlename FROM tbl_complainant WHERE blotter_id = '$blotterIDFromURL'";

$resultNames = mysqli_query($conn, $retrieveNames);

while($DataRows = mysqli_fetch_array($resultNames)){
    $pdf->Cell(100,10,$DataRows['lastname'].", ".$DataRows['firstname']." ".$DataRows['middlename'], 0, 1, 'L');
    $pdf->Cell(25,10,'', 0, 0);
}
$pdf->Cell(25,10,'', 0, 1);
$pdf->SetFont('times','B', 12);
$pdf->Cell(92,10,'          Kayo ay inaasahang humarap sa akin sa ika-', 0, 0, 'J');

$retrieveSummonDate = "SELECT EXTRACT(YEAR FROM summon_date) AS 'summonYear', MONTHNAME(summon_date) AS 'summonMonth', EXTRACT(DAY FROM summon_date) AS 'summonDay', DAYOFWEEK(summon_date) AS 'dayNum' FROM `tbl_blotter_details` WHERE blotter_id = '$blotterIDFromURL'";

$resultSummonDate = mysqli_query($conn, $retrieveSummonDate);

while($DataRows = mysqli_fetch_array($resultSummonDate)){
    if($DataRows['dayNum'] == 1){
        $dayName = "Linggo";
    }
    else if($DataRows['dayNum'] == 2){
        $dayName = "Lunes";
    }
    else if($DataRows['dayNum'] == 3){
        $dayName = "Martes";
    }
    else if($DataRows['dayNum'] == 4){
        $dayName = "Miyerkules";
    }
    else if($DataRows['dayNum'] == 5){
        $dayName = "Huwebes";
    }
    else if($DataRows['dayNum'] == 6){
        $dayName = "Biyernes";
    }
    else if($DataRows['dayNum'] == 7){
        $dayName = "Sabado";
    }
    $pdf->Cell(80,10, $DataRows['summonDay']." ng ".$DataRows['summonMonth'].", ".$DataRows['summonYear']." araw ng ".$dayName, 0, 1, 'J');
}

$retrieveSummonTime = "SELECT TIME_FORMAT(summon_time, '%r') AS 'summonTime' FROM `tbl_blotter_details` WHERE blotter_id = '$blotterIDFromURL'";

$resultSummonTime = mysqli_query($conn, $retrieveSummonTime);

while($DataRows = mysqli_fetch_array($resultSummonTime)){
    $pdf->Cell(130,10,'sa ganap na ika- '.$DataRows['summonTime']." para sa pagdinig ng inyong sumbong.", 0, 1,'J');
}


$dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow'";

$resultDateNow = mysqli_query($conn, $dateNow);

while($DataRows = mysqli_fetch_array($resultDateNow)){
    $pdf->Cell(25,10,'', 0, 1);
    $pdf->Cell(130,10, "Ginawa ito ngayong ika-".$DataRows['dayNow']." ng ".$DataRows['monthNow'].", ".$DataRows['yearNow'].".", 0, 1, 'J');
}

$pdf->Cell(25,10,'', 0, 1);
$pdf->Cell(25,10,'', 0, 1);
$pdf->SetFont('times','U', 12);
$pdf->Cell(170,10, 'ANTONIO BRAINARDO P. LINANG', 0, 1, 'R');
$pdf->SetFont('times','B', 10);
$pdf->Cell(168,10, 'Punong Barangay/Tagapangulo ng Lupon', 0, 1, 'R');
$pdf->Cell(170,10,'---------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'R');
$pdf->SetFont('times','B', 10);
$pdf->Cell(170,10, 'ULAT NG OPISYAL NA NAGDALA NG PATAWAG', 0, 1, 'C');
$pdf->Cell(170,10, 'Inihatid ko ang patawag na ito sa nagsusumbong na si ________________________________________________.', 0, 1, 'L');

$dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow', EXTRACT(HOUR FROM NOW()) AS 'hourNow', EXTRACT(MINUTE FROM NOW()) AS 'minNow'";

$resultDateNow = mysqli_query($conn, $dateNow);

while($DataRows = mysqli_fetch_array($resultDateNow)){
    $pdf->Cell(170,10, "Ngayong ika-".$DataRows['dayNow']." ng ".$DataRows['monthNow'].", ".$DataRows['yearNow'].", sa pamamagitan ng:", 0, 1, 'J');
    $pdf->SetFont('times','B', 9);
    $pdf->Cell(170,10, "(Isulat ang (mga) pangalan ng nagrereklamo sa paraan kung paano ito ipinarating sa kanya/kanila.)", 0, 1, 'J');
    $pdf->SetFont('times','B', 10);
    $pdf->Cell(170,10, "_____________1. Iniabot ko ng tuwiran sa kanya/kanila ang patawag, o", 0, 1, 'J');
    $pdf->Cell(170,10, "_____________2. Iniabot ko sa kanya/kanila ang patawag at siya/sila ay tumangging tanggapin ito, o", 0, 1, 'J');
    $pdf->Cell(170,10, "_____________3. Iniwan ko ang patawag sa isang taong nasa hustong gulang at may sariling pagpapasiya", 0, 1, 'J');
    $pdf->Cell(170,10, "na naninirahan sa bahay ng isinusumbong, o", 0, 1, 'J');
    $pdf->Cell(170,10, "_____________4. Iniwan ko ang patawag sa kanya/kanilang opisina/lugar ng hanapbuhay ", 0, 1, 'J');
    $pdf->Cell(170,10, "kay_______________________________(pangalan)Isang taong namamahala sa tanggapan/hanapbuhay.", 0, 1, 'J');

    $pdf->Cell(25,10,'', 0, 1);
    $pdf->SetFont('times','B', 10);
    $pdf->Cell(168,10, '_________________________________________', 0, 1, 'R');
    $pdf->Cell(163,10, 'Lagda ng Opisyal na nagdala ng patawag', 0, 1, 'R');

$pdf->Output('I', $DataRows['yearNow']."_".$DataRows['monthNow']."_".$DataRows['dayNow']."_".$DataRows['hourNow']."_".$DataRows['minNow']."_summon_comp.pdf");
}
?>