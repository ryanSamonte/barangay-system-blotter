<?php 
    require_once('../functions/connection.php');
    require_once('../functions/sessions.php');
    // require('../fpdf181/fpdf.php');
    require('textbox.php');
?>

<?php

    global $conn;

    if(isset($_SESSION['id'])){
        if($_SESSION['privilege'] == '2'){
            echo "<script>window.location.href='../denied.php';</script>";
        }
        else{
            $userid = $_SESSION['id'];
            $profileimg = $_SESSION['profileimg'];

            $retrieveUserInfoQuery = "SELECT * FROM tbl_user WHERE userid='$userid'";

            $result = mysqli_query($conn, $retrieveUserInfoQuery);

            while($DataRows = mysqli_fetch_assoc($result)){
                $firstname = $DataRows['firstname'];
            }
        }
    }
    else{
        echo "<script>window.location.href='../login.php';</script>";
    }

    if(ISSET($_GET['bID'])){
        $blotterIDFromURL = $_GET['bID'];
    }

    if(ISSET($_POST['generate_Resolution'])){
        $resolution_details = mysqli_real_escape_string($conn, $_POST['resolution_details']);

        if(strlen($resolution_details) > 2000){
            $_SESSION['errorMessage'] = "You've exceeded the (2000) character limit";
        }
        else{
            $updateIsResolved = "UPDATE tbl_blotter_details SET isResolved = 'Y' WHERE blotter_id = '$blotterIDFromURL'";

            if(mysqli_query($conn, $updateIsResolved)){
                $pdf = new PDF_TextBox('P', 'mm', 'Legal'); 
                $pdf->AddPage();
                $pdf->SetXY(0,30);
                $pdf->SetMargins(25.4, 25.4);
                $pdf->SetRightMargin(100);
                $pdf->SetFont('Times','B', 12);
                $pdf->Image('../img/sipac-logo.png',25,20,30);
                $pdf->Image('../img/navotaas-logo.jpg',160,23,40);
                $pdf->Image('../img/navotas-watermark.png',10,80,200);
                $pdf->Cell(25,15,'', 0, 0);
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

                $pdf->Cell(170,10,'KASUNDUANG NABUO SA PATAWAG', 0, 1, 'C');

                $pdf->drawTextBox($resolution_details, 170 , 100, 'J', 'T', false);

                $dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow'";

                $resultDateNow = mysqli_query($conn, $dateNow);

                while($DataRows = mysqli_fetch_array($resultDateNow)){
                    $pdf->Cell(25,10,'', 0, 1);
                    $pdf->Cell(175,5, "             Ginawa ito ngayong ika-".$DataRows['dayNow']." ng ".$DataRows['monthNow'].", ".$DataRows['yearNow']." sa Bulwagang Barangay Sipac-Almacen,", 0, 1, 'J');
                    $pdf->Cell(175,5, "Lungsod ng Navotas.", 0, 1, 'J');
                }

                $pdf->Cell(25,10,'', 0, 1);
                $pdf->Cell(175,5, "Lagda ng Maysumbong:", 0, 1, 'J');
                $pdf->Cell(25,10,'', 0, 1);

                $pdf->Cell(25,10,'', 0, 1);
                $pdf->Cell(175,5, "Lagda ng Ipinagsusumbong:", 0, 1, 'J');
                $pdf->Cell(25,20,'', 0, 1);

                $pdf->Cell(175,5, "______________", 0, 1, 'J');
                $pdf->Cell(175,5, "Punong Pangkat", 0, 1, 'J');

                $pdf->Cell(25,15,'', 0, 1);
                $pdf->Cell(175,5, "__________________", 0, 1, 'J');
                $pdf->Cell(175,5, "Lupon Tagapamayapa", 0, 1, 'J');

                $pdf->Cell(25,15,'', 0, 1);
                $pdf->Cell(175,5, "__________________", 0, 1, 'J');
                $pdf->Cell(175,5, "Lupon Tagapamayapa", 0, 1, 'J');


                $dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow', EXTRACT(HOUR FROM NOW()) AS 'hourNow', EXTRACT(MINUTE FROM NOW()) AS 'minNow'";

                $resultDateNow = mysqli_query($conn, $dateNow);

                while($DataRows = mysqli_fetch_array($resultDateNow)){
                    $pdf->Output('I', $DataRows['yearNow']."_".$DataRows['monthNow']."_".$DataRows['dayNow']."_".$DataRows['hourNow']."_".$DataRows['minNow']."_summon_resolution.pdf");
                }
            }
            else{
                $_SESSION['errorMessage'] = mysqli_error($conn);
            }
        }
    }
?>

<?php
    global $conn;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BrgySipac</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="../img/sipac-logo.png">

        <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="../fonts/webfonts/fontawesome-all.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script
          src="https://code.jquery.com/jquery-3.1.1.min.js"
          integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
          crossorigin="anonymous"></script>
        <script src="semantic/dist/semantic.min.js"></script>
        <script src='js/jquery-3.3.1.min.js'></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="../js/index.js"></script>
        <script>
            
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
        </script>
    </head>
    <body>
        <section id="admin-header">
            <div class="overlay">
            <nav class="navbar navbar-expand-xl p-0 navigation">
                <div class="container">
                    <a href="admin.php" class="navbar-brand mr-5">
                        <img src="../img/sipac-logo.png" alt="" width="70px" class="brand-pic">
                        <p class="h4 p-brand">BrgySipac</p>
                    </a>

                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item mr-3 nav-li">
                                <a href="admin.php" class="nav-link link"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="file-blotter.php" class="nav-link link"><i class="fas fa-clipboard"></i>&nbsp;File Blotter</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-blotter.php" class="nav-link link active"><i class="fas fa-folder-open"></i>&nbsp;Blotter Record</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-resident.php" class="nav-link link"><i class="fas fa-id-card"></i>&nbsp;Resident</a>
                            </li>

                            <li class="nav-item dropdown nav-li mr-3">
                                <a class="nav-link dropdown-toggle link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cogs"></i>&nbsp;Maintenance
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="blotter-history.php" class="nav-link link"><i class="fas fa-pen-square"></i>&nbsp;&nbsp;Blotter History</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="manage-user.php" class="nav-link link"><i class="fas fa-user"></i>&nbsp;&nbsp;User Account</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown nav-li">
                                <a class="nav-link dropdown-toggle link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file"></i>&nbsp;Report
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="court-referral.php" class="nav-link link"><i class="fas fa-gavel"></i>&nbsp;&nbsp;Court Referral</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="manage-user.php" class="nav-link link"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Resolution</a>
                                </div>
                            </li>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle user-option" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../uploads/<?php echo $profileimg; ?>" alt="" class="profile-img">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link link" href="#">Welcome <?php echo $firstname.'!'; ?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item nav-link link" href="../logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
          </div>
        </section>

        
        <section id="add-family-member">
            <div class="container">
            <?php echo errorMessage(); echo successMessage(); ?>
                <div class="row">
                    <div class="col">
                        <div class="card card-table mb-5" style="padding-left:0px; padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1 class="card-title" id="exampleModalLabel">Blotter Details</h1>
                            </div>

                            <?php
                                if(ISSET($_GET['bID'])){
                                    $blotterIDFromURL = $_GET['bID'];
                                }

                                $retriveBlotterInfo = "SELECT * FROM tbl_blotter_details WHERE blotter_id = '$blotterIDFromURL'";

                                $result = mysqli_query($conn, $retriveBlotterInfo);

                                while($DataRows = mysqli_fetch_assoc($result)){
                                    $blotter_id = $DataRows['blotter_id'];
                                    $incident_place = $DataRows['incident_place'];
                                    $incident_details = $DataRows['incident_details'];
                                    $summon_date = $DataRows['summon_date'];
                                    $summon_time = $DataRows['summon_time'];
                            ?>

                            <div class="card-body">
                                <div class="container">
                                    <form class="needs-validation" action="summon-resolution-info.php?bID=<?php echo $blotterIDFromURL; ?>" method="post" id="add-resident-form" novalidate>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname" class="input-label">Incident place</label>
                                                <input type="text" class="form-control" value="<?php echo $incident_place; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname" class="input-label">Incident details</label>
                                                <textarea type="text" class="form-control" rows="8" disabled><?php echo $incident_details; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname" class="input-label">Complainant(s)</label>
                                                <textarea type="text" class="form-control" rows="5" disabled><?php
                                                    $retrieveComplainant = "SELECT * FROM tbl_complainant WHERE blotter_id = '$blotterIDFromURL'";

                                                    $resultComplainant = mysqli_query($conn, $retrieveComplainant);

                                                    while($DataRows = mysqli_fetch_assoc($resultComplainant)){
                                                        $lastname = $DataRows['lastname'];
                                                        $firstname = $DataRows['firstname'];
                                                        $middlename = $DataRows['middlename'];

                                                        echo $lastname.", ".$firstname." ".$middlename."\n";
                                                    }
                                                ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname" class="input-label">Respondent(s)</label>
                                                <textarea type="text" class="form-control" rows="5" disabled><?php
                                                    $retrieveComplainant = "SELECT * FROM tbl_respondent WHERE blotter_id = '$blotterIDFromURL'";

                                                    $resultComplainant = mysqli_query($conn, $retrieveComplainant);

                                                    while($DataRows = mysqli_fetch_assoc($resultComplainant)){
                                                        $lastname = $DataRows['lastname'];
                                                        $firstname = $DataRows['firstname'];
                                                        $middlename = $DataRows['middlename'];

                                                        echo $lastname.", ".$firstname." ".$middlename."\n";
                                                    }
                                                ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-6">
                                                <label for="lastname" class="input-label">Summon date</label>
                                                <input type="text" class="form-control" value="<?php echo $summon_date; ?>" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastname" class="input-label">Summon time</label>
                                                <input type="text" class="form-control" value="<?php echo $summon_time; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname" class="input-label">Summon resolution details</label>
                                                <textarea type="text" class="form-control" rows="8" name="resolution_details" required></textarea>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="generate_Resolution" class="btn btn-success"><i class="far fa-check-circle"></i> Generate resolution</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                                </div>
                                <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </section>

        <footer id="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col text-center my-3">
                        <img src="../img/sipac-logo.png" alt="nnhs-logo" class="img-fluid" width="50px">
                        <p class="cdate" style="font-size: 15px; display:inline-block;">&copy; 2018</p>
                    </div>
                </div>
            </div>
        </footer>

        <script>
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>