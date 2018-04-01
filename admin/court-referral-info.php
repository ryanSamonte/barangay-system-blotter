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
$pdf->SetFont('Times','B', 12);
$pdf->Image('../img/sipac-logo.png',25,20,30);
$pdf->Image('../img/navotaas-logo.jpg',160,23,40);
$pdf->Image('../img/navotas-watermark.png',10,80,200);
$pdf->Cell(170,5,'Republika ng Pilipinas', 0, 1, 'C');
$pdf->Cell(170,5,'Lungsod ng Navotas', 0, 1, 'C');
$pdf->Cell(170,5,'BARANGAY- SIPAC ALMACEN', 0, 1, 'C');
$pdf->Cell(170,5,'Tanggapan ng Punong Barangay', 0, 1, 'C');
$pdf->Cell(25,15,'', 0, 1);
$pdf->SetFont('times','', 12);

$retrieveNames = "SELECT lastname, firstname, middlename, housenum, streetname FROM tbl_complainant WHERE blotter_id = '$blotterIDFromURL'";

$resultNames = mysqli_query($conn, $retrieveNames);

while($DataRows = mysqli_fetch_array($resultNames)){
    $pdf->Cell(60,5,$DataRows['lastname'].", ".$DataRows['firstname']." ".$DataRows['middlename'], 0, 0, 'L');
    $pdf->SetFont('times','B', 11);
    $pdf->Cell(25,5,'ADDRESS:', 0, 0, 'L');
    $pdf->SetFont('times','', 12);
    $pdf->Cell(60,5, $DataRows['housenum'].", ".$DataRows['streetname'], 0, 1, 'L');
}
$pdf->SetFont('times','', 12);
$pdf->Cell(25,10,'**Maysumbong**', 0, 1);
$pdf->Cell(35,10,'------Laban kay/kina------', 0, 1, 'L');

$retrieveNames = "SELECT lastname, firstname, middlename, housenum, streetname FROM tbl_respondent WHERE blotter_id = '$blotterIDFromURL'";

$resultNames = mysqli_query($conn, $retrieveNames);

while($DataRows = mysqli_fetch_array($resultNames)){
    $pdf->Cell(60,5,$DataRows['lastname'].", ".$DataRows['firstname']." ".$DataRows['middlename'], 0, 0, 'L');
    $pdf->SetFont('times','B', 11);
    $pdf->Cell(25,5,'ADDRESS:', 0, 0, 'L');
    $pdf->SetFont('times','', 12);
    $pdf->Cell(60,5, $DataRows['housenum'].", ".$DataRows['streetname'], 0, 1, 'L');
}

$pdf->Cell(25,10,'**Ipinagsusumbong**', 0, 1);
$pdf->Cell(170,10,'KATIBAYAN UPANG MAKADULOG SA HUKUMAN', 0, 1, 'C');

$pdf->Cell(25,10,'', 0, 1);

$retrieveSummonCount = "SELECT summon_count FROM tbl_blotter_details WHERE blotter_id = '$blotterIDFromURL'";

$resultSummonCount = mysqli_query($conn, $retrieveSummonCount);

while($DataRows = mysqli_fetch_array($resultSummonCount)){
    $pdf->Cell(175,5,'             Sa Kabila ng ('.$DataRows['summon_count'].') paghaharap at pag-uusap na isinagawa ng mga Lupong Tagapamayapa.', 0, 1, 'J');
}
$pdf->Cell(138,5,'Walang naganap na kasunduan sa magkabilang panig, nang maysumbong na si/sina:', 0, 0, 'J');
$pdf->Cell(25,10,'', 0, 1);

$retrieveNames = "SELECT lastname, firstname, middlename, housenum, streetname FROM tbl_complainant WHERE blotter_id = '$blotterIDFromURL'";

$resultNames = mysqli_query($conn, $retrieveNames);

while($DataRows = mysqli_fetch_array($resultNames)){
    $pdf->Cell(170,5,$DataRows['lastname'].", ".$DataRows['firstname']." ".$DataRows['middlename'], 0, 1, 'C');
}
$pdf->Cell(25,5,'', 0, 1, 'L');
$pdf->Cell(138,5,'may sapat na taong gulang laban sa Ipinagsusumbong na si/sina:', 0, 0, 'J');
$pdf->Cell(25,10,'', 0, 1);

$retrieveNames = "SELECT lastname, firstname, middlename, housenum, streetname FROM tbl_respondent WHERE blotter_id = '$blotterIDFromURL'";

$resultNames = mysqli_query($conn, $retrieveNames);

while($DataRows = mysqli_fetch_array($resultNames)){
    $pdf->Cell(170,5,$DataRows['lastname'].", ".$DataRows['firstname']." ".$DataRows['middlename'], 0, 1, 'C');
}
$pdf->Cell(25,5,'', 0, 1, 'L');
$pdf->Cell(170,5,'may sapat na taong gulang. Hindi nagawa ng Ipinagsusumbong na mapalubag ang damdamin ng', 0, 1, 'J');
$pdf->Cell(170,5,'maysumbong. Kaya minarapat ng maysumbong na ang kanyang usapin ay idulog na sa mataas na', 0, 1, 'J');
$pdf->Cell(170,5,'hukuman.', 0, 1, 'J');

$dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow'";

$resultDateNow = mysqli_query($conn, $dateNow);

while($DataRows = mysqli_fetch_array($resultDateNow)){
    $pdf->Cell(25,10,'', 0, 1);
    $pdf->Cell(175,5, "             Ginawa ito ngayong ika-".$DataRows['dayNow']." ng ".$DataRows['monthNow'].", ".$DataRows['yearNow']." sa Bulwagang Barangay Sipac-Almacen,", 0, 1, 'J');
    $pdf->Cell(175,5, "Lungsod ng Navotas.", 0, 1, 'J');
}

$pdf->Cell(25,10,'', 0, 1);
$pdf->Cell(175,5, "Lagda:", 0, 1, 'J');
$pdf->Cell(25,10,'', 0, 1);
$pdf->Cell(175,5, "______________", 0, 1, 'J');
$pdf->Cell(175,5, "Punong Pangkat", 0, 1, 'J');

$pdf->Cell(25,15,'', 0, 1);
$pdf->Cell(175,5, "__________________", 0, 1, 'J');
$pdf->Cell(175,5, "Lupon Tagapamayapa", 0, 1, 'J');

$pdf->Cell(25,15,'', 0, 1);
$pdf->Cell(175,5, "__________________", 0, 1, 'J');
$pdf->Cell(175,5, "Lupon Tagapamayapa", 0, 1, 'J');

$pdf->SetFont('times','', 8);
$pdf->Cell(25,5,'', 0, 1);
$pdf->Cell(170,5, "Note: Not valid without seal", 0, 1, 'R');

$dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow', EXTRACT(HOUR FROM NOW()) AS 'hourNow', EXTRACT(MINUTE FROM NOW()) AS 'minNow'";

$resultDateNow = mysqli_query($conn, $dateNow);

while($DataRows = mysqli_fetch_array($resultDateNow)){
    $pdf->Output('I', $DataRows['yearNow']."_".$DataRows['monthNow']."_".$DataRows['dayNow']."_".$DataRows['hourNow']."_".$DataRows['minNow']."_court_referral.pdf");
}
?>