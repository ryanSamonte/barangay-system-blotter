<?php 
    require_once('../functions/connection.php');
    require_once('../functions/sessions.php'); 
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
        $blotterIDfromURL = $_GET['bID'];
    }

    if(ISSET($_POST['nextStep'])){
        $checkRespondent = "SELECT COUNT(*) AS 'respondentCount' FROM tbl_respondent WHERE blotter_id = '$blotterIDfromURL'";

        $resultRespondent = mysqli_query($conn, $checkRespondent);

        while($DataRows = mysqli_fetch_assoc($resultRespondent)){
            $respondentCount = $DataRows['respondentCount'];
        }

        if($respondentCount == 0){
            $_SESSION['errorMessage'] = "Insert respondent first!";
            header("Refresh: 2;url=respondent-info.php?bID=$blotterIDfromURL");
        }
        else{
            header("Location: summon-info.php?bID=$blotterIDfromURL");
        }
    }

    if(ISSET($_GET['resID'])){
        $useridFromURL = $_GET['resID'];

        $countResidentResp = "SELECT COUNT(*) AS 'countResidentResp' FROM tbl_respondent WHERE resident_id = '$useridFromURL' AND blotter_id = '$blotterIDfromURL'";

        $resultRetriveResidentResp = mysqli_query($conn, $countResidentResp);

        while($DataRows = mysqli_fetch_assoc($resultRetriveResidentResp)){
            $countResidentasRespondent = $DataRows['countResidentResp'];
        }

        $countResidentComp = "SELECT COUNT(*) AS 'countResidentComp' FROM tbl_complainant WHERE resident_id = '$useridFromURL' AND blotter_id = '$blotterIDfromURL'";

        $resultRetriveResidentComp = mysqli_query($conn, $countResidentComp);

        while($DataRows = mysqli_fetch_assoc($resultRetriveResidentComp)){
            $countResidentasComplainant = $DataRows['countResidentComp'];
        }

        if($countResidentasRespondent >= 1 || $countResidentasComplainant >= 1){
            $_SESSION['errorMessage'] = "Resident already added as respondent/complainant!";
            header("Refresh: 2;url=respondent-info.php?bID=$blotterIDfromURL");
        }
        else{
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE archivestatus = 0 AND residentid = '$useridFromURL'";

            $result = mysqli_query($conn, $retriveResidentQuery);

            while($DataRows = mysqli_fetch_assoc($result)){
                $firstname = $DataRows['firstname'];
                $middlename = $DataRows['middlename'];
                $lastname = $DataRows['lastname'];
                $gender = $DataRows['gender'];
                $birthdate = $DataRows['birthdate'];
                $age = $DataRows['age'];
                $contactnum = $DataRows['contactnum'];
                $occupation = $DataRows['occupation'];
                $housenum = $DataRows['housenum'];
                $streetname = $DataRows['streetname'];
                $blotterrecords = $DataRows['blotterrecords'];
                $archivestatus = $DataRows['archivestatus'];
                $residentid = $DataRows['residentid'];
            }

            $insertRespondent = "INSERT INTO tbl_respondent(resident_id, lastname, firstname, middlename, gender, age, contactnum, occupation,housenum,streetname,blotter_id) VALUES('$residentid', '$lastname', '$firstname', '$middlename', '$gender', '$age', '$contactnum', '$occupation', '$housenum', '$streetname', '$blotterIDfromURL')";

            $updateBlotterRecord = "UPDATE tbl_resident SET blotterrecords = $blotterrecords + 1 WHERE residentid = '$useridFromURL'";

            if(mysqli_query($conn, $insertRespondent) && mysqli_query($conn, $updateBlotterRecord)){
                $_SESSION['successMessage'] = "Respondent info successfully added!";
                header("Refresh: 2;url=respondent-info.php?bID=$blotterIDfromURL");
            }
            else{
                $_SESSION['errorMessage'] = mysqli_error();
            }
        }
    }
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
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/index.js"></script>

        <script>
            
//   $( function() {
//     $( "#datepicker" ).datepicker();
//   } );
$( function() {
    $( "#datepicker" ).datepicker( "yy-mm-dd", "dateFormat", $( this ).val() );
});
        </script>
    </head>
    <body>
        <section id="admin-header">
            <nav class="navbar navbar-expand-xl p-0 navigation">
                <div class="container">
                    <a href="" class="navbar-brand mr-5">
                        <img src="../img/sipac-logo.png" alt="" width="70px" class="brand-pic">
                        <p class="h4 p-brand">BrgySipac</p>
                    </a>
                </div>
            </nav>
        </section>

        <section id="file-blotter">
            <div class="container mb-5">
            <?php echo errorMessage(); echo successMessage(); ?>
                <div class="row">
                    <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                        <div class="card-header card-table-header">
                            <h1>Respondent Information</h1>
                        </div>
                        <div class="card-body">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-table">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-inverse">
                                                    <thead>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Age</th>
                                                        <th>Contact #</th>
                                                        <th>Address</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE archivestatus = 0";

                                                            $result = mysqli_query($conn, $retriveResidentQuery);

                                                            while($DataRows = mysqli_fetch_assoc($result)){
                                                                $firstname = $DataRows['firstname'];
                                                                $middlename = $DataRows['middlename'];
                                                                $lastname = $DataRows['lastname'];
                                                                $gender = $DataRows['gender'];
                                                                $birthdate = $DataRows['birthdate'];
                                                                $age = $DataRows['age'];
                                                                $contactnum = $DataRows['contactnum'];
                                                                $housenum = $DataRows['housenum'];
                                                                $streetname = $DataRows['streetname'];
                                                                $blotterrecords = $DataRows['blotterrecords'];
                                                                $archivestatus = $DataRows['archivestatus'];
                                                                $residentid = $DataRows['residentid'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($firstname.' '.$middlename.' '.$lastname); ?></td>
                                                            <td><?php echo htmlentities($gender); ?></td>
                                                            <td><?php echo htmlentities($age); ?></td>
                                                            <td><?php echo htmlentities($contactnum); ?></td>
                                                            <td><?php echo htmlentities('#'.$housenum.' '.$streetname); ?></td>
                                                            <td class="text-right">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="respondent-info.php?bID=<?php echo $blotterIDfromURL; ?>&amp;resID=<?php echo $residentid; ?>" class="btn btn-danger">&plus;&nbsp;&nbsp;Add as Respondent</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer mr-3">
                            <form action="respondent-info.php?bID=<?php echo $blotterIDfromURL; ?>" method="POST">
                                <button type="submit" name="nextStep" class="btn btn-success"><i class="far fa-arrow-alt-circle-right"></i> Next</button>
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
                        <p class="cdate" style="font-size: 15px; display:inline-block;">&copy; <?php echo date("Y"); ?></p>
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