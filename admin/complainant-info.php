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
        $checkComplainant = "SELECT COUNT(*) AS 'complainantCount' FROM tbl_complainant WHERE blotter_id = '$blotterIDfromURL'";

        $resultComplainant = mysqli_query($conn, $checkComplainant);

        while($DataRows = mysqli_fetch_assoc($resultComplainant)){
            $complainantCount = $DataRows['complainantCount'];
        }

        if($complainantCount == 0){
            $_SESSION['errorMessage'] = "Insert complainant first!";
            header("Refresh: 2;url=complainant-info.php?bID=$blotterIDfromURL");
        }
        else{
            header("Location: respondent-info.php?bID=$blotterIDfromURL");
        }
    }

    if(ISSET($_GET['resID'])){
        $useridFromURL = $_GET['resID'];

        $countResident = "SELECT COUNT(*) AS 'countResident' FROM tbl_complainant WHERE resident_id = '$useridFromURL' AND blotter_id = '$blotterIDfromURL'";

        $resultRetriveResident = mysqli_query($conn, $countResident);

        while($DataRows = mysqli_fetch_assoc($resultRetriveResident)){
            $countResidentasComplainant = $DataRows['countResident'];
        }

        if($countResidentasComplainant >= 1){
            $_SESSION['errorMessage'] = "Resident already added as complainant!";
            header("Refresh: 2;url=complainant-info.php?bID=$blotterIDfromURL");
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

            $insertComplainant = "INSERT INTO tbl_complainant(resident_id, lastname, firstname, middlename, gender, age, contactnum, occupation,housenum,streetname,blotter_id) VALUES('$residentid', '$lastname', '$firstname', '$middlename', '$gender', '$age', '$contactnum', '$occupation', '$housenum', '$streetname', '$blotterIDfromURL')";

            if(mysqli_query($conn, $insertComplainant)){
                $_SESSION['successMessage'] = "Complainant info successfully added!";
                header("Refresh: 3;url=complainant-info.php?bID=$blotterIDfromURL");
            }
            else{
                $_SESSION['errorMessage'] = mysqli_error();
            }
        }
    }

    if(ISSET($_POST['add_Complainant'])){
        $lastnameInput = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstnameInput = mysqli_real_escape_string($conn, $_POST['firstname']);
        $middlenameInput = mysqli_real_escape_string($conn, $_POST['middlename']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            if($gender == "Male"){
                $gender = 'M';
            }
            else{
                $gender = 'F';
            }
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);
        $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
        $housenum = mysqli_real_escape_string($conn, $_POST['housenum']);
        $streetname = mysqli_real_escape_string($conn, $_POST['streetname']);
        
        
        $insertUserQuery = "INSERT INTO `tbl_complainant`(`resident_id`, `lastname`, `firstname`, `middlename`, `gender`, `age`, `contactnum`, `occupation`, `housenum`, `streetname`, `blotter_id`) VALUES ('0', '$lastnameInput','$firstnameInput','$middlenameInput','$gender','$age','$contactnum','$occupation','$housenum','$streetname','$blotterIDfromURL')";
    
        if(mysqli_query($conn, $insertUserQuery)){
            $_SESSION['successMessage'] = "Complainant info successfully added!";
            header("Refresh: 3;url=complainant-info.php?bID=$blotterIDfromURL");
        }
        else{
            $_SESSION['errorMessage'] = mysqli_error($conn);
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
                            <h1>Complainant Information</h1>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row mb-5">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add-non-resident">
                                            &plus; Non-resident
                                        </button>
                                    </div>
                                </div>

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
                                                                            <a href="complainant-info.php?bID=<?php echo $blotterIDfromURL; ?>&amp;resID=<?php echo $residentid; ?>" class="btn btn-success">&plus;&nbsp;&nbsp;Add as Complainant</a>
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
                            <form action="complainant-info.php?bID=<?php echo $blotterIDfromURL; ?>" method="POST">
                                <button type="submit" name="nextStep" class="btn btn-success"><i class="far fa-arrow-alt-circle-right"></i> Next</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="add-resident-modal">
            <div class="modal fade" id="add-non-resident" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">&plus; Add non-resident complainant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="needs-validation" action="complainant-info.php?bID=<?php echo $blotterIDfromURL; ?>" method="post" id="add-non-resident-form" novalidate>
                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                    <label for="lastname" class="input-label">Last name</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="e.g. Dela Cruz" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="firstname" class="input-label">First name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="e.g. Juan" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="middlename" class="input-label">Middle name</label>
                                    <input type="text" class="form-control" name="middlename" id="middlename" placeholder="e.g. Marcial" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                    <label for="gender" class="input-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="datepicker" class="input-label">Age</label>
                                    <input type="text" class="form-control" name="age" placeholder="e.g. 18" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="contactnum" class="input-label">Contact number</label>
                                    <input type="text" class="form-control" name="contactnum" id="contactnum" placeholder="e.g. 09123456789" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                    <label for="occupation" class="input-label">Occupation</label>
                                    <input type="text" class="form-control" name="occupation" id="occupation" placeholder="e.g. Manager" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="housenum" class="input-label">House number</label>
                                    <input type="text" class="form-control" name="housenum" id="housenum" placeholder="e.g. 47" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label for="streetname" class="input-label">Street name</label>
                                    <input type="text" class="form-control" name="streetname" id="streetName" placeholder="e.g. San Rafael" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="add_Complainant" class="btn btn-success"><i class="far fa-check-circle"></i> Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    </div>
                    </form>
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