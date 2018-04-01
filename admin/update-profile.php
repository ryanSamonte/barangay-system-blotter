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
?>

<?php
    global $conn;

    $lastNameErr="";

    if(ISSET($_GET['id'])){
        $residentidFromURL = $_GET['id'];
    }

    if(ISSET($_POST['updateProfile'])){
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);   
        $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            if($gender == "Male"){
                $gender = 'M';
            }
            else{
                $gender = 'F';
            }
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        
        $date = new DateTime($birthdate);
        $now = new DateTime();

        $extractDate = "SELECT EXTRACT(YEAR FROM '$birthdate') AS 'yearInput', EXTRACT(MONTH FROM '$birthdate') AS 'monthInput', EXTRACT(DAY FROM '$birthdate') AS 'dayInput', EXTRACT(YEAR FROM NOW()) AS 'yearNow', EXTRACT(MONTH FROM NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow'";

        $resultDate = mysqli_query($conn, $extractDate);

        while($DataRows = mysqli_fetch_assoc($resultDate)){
            $yearInput = $DataRows['yearInput'];
            $monthInput = $DataRows['monthInput'];
            $dayInput = $DataRows['dayInput'];

            $yearNow = $DataRows['yearNow'];
            $monthNow = $DataRows['monthNow'];
            $dayNow = $DataRows['dayNow'];
        }

        if($date > $now){
            $_SESSION['errorMessage'] = "Invalid date input!";
        }
        else{
            if($monthInput < $monthNow){
                $age = $yearNow - $yearInput;
            }
            else if($monthInput > $monthNow){
                $age = (($yearNow - 1) - $yearInput);
            }
            else{
                if($dayInput < $dayNow){
                    $age = $yearNow - $yearInput;
                }
                else{
                    $age = (($yearNow - 1) - $yearInput);
                }
            }
        

            $contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);
            $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
            $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
            $religion = mysqli_real_escape_string($conn, $_POST['religion']);
            $housenum = mysqli_real_escape_string($conn, $_POST['housenum']);
            $streetname = mysqli_real_escape_string($conn, $_POST['streetname']);
            
            
            $updateUserQuery = "UPDATE `tbl_resident` SET `lastname` = '$lastname', `firstname` = '$firstname', `middlename` = '$middlename', `gender` = '$gender', `birthdate` = '$birthdate', `age` = '$age', `contactnum` = '$contactnum', `occupation` = '$occupation', `civilstatus` = '$civilstatus', `religion` = '$religion', `housenum` = '$housenum', `streetname` = '$streetname' WHERE residentid = '$residentidFromURL'";
        
            if(mysqli_query($conn, $updateUserQuery)){
                $_SESSION['successMessage'] = "Resident info successfully updated!";
                header("Refresh: 2;url=manage-resident.php");
            }
            else{
                $_SESSION['errorMessage'] = mysqli_error($conn);
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
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/js/gijgo.min.js" type="text/javascript"></script>
        <script src="../js/index.js"></script>
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
                                <a href="user.php" class="nav-link link"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="file-blotter.php" class="nav-link link"><i class="fas fa-clipboard"></i>&nbsp;File Blotter</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-blotter.php" class="nav-link link"><i class="fas fa-folder-open"></i>&nbsp;Blotter Record</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-resident.php" class="nav-link link active"><i class="fas fa-id-card"></i>&nbsp;Resident</a>
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
                                    <a href="summon-resolution.php" class="nav-link link"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Resolution</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="resident-list.php" class="nav-link link"><i class="fas fa-users"></i>&nbsp;&nbsp;Resident List</a>
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
                                <h1 class="card-title" id="exampleModalLabel">Resident Profile</h1>
                            </div>

                            <?php
                                if(ISSET($_GET['id'])){
                                    $residentid = $_GET['id'];
                                }

                                $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE archivestatus = 0 AND residentid = '$residentid'";

                                $result = mysqli_query($conn, $retriveResidentQuery);

                                while($DataRows = mysqli_fetch_assoc($result)){
                                    $firstname = $DataRows['firstname'];
                                    $middlename = $DataRows['middlename'];
                                    $lastname = $DataRows['lastname'];
                                    $gender = $DataRows['gender'];

                                    if($gender == 'M'){
                                        $genderfull = 'Male';
                                    }
                                    else{
                                        $genderfull = 'Female';
                                    }
                                    $birthdate = $DataRows['birthdate'];
                                    $age = $DataRows['age'];
                                    $contactnum = $DataRows['contactnum'];
                                    $occupation = $DataRows['occupation'];
                                    $civilstatus = $DataRows['civilstatus'];
                                    $religion = $DataRows['religion'];
                                    $housenum = $DataRows['housenum'];
                                    $streetname = $DataRows['streetname'];
                                    $blotterrecords = $DataRows['blotterrecords'];
                                    $archivestatus = $DataRows['archivestatus'];
                                    $residentid = $DataRows['residentid'];
                            ?>

                            <div class="card-body">
                                <div class="container">
                                    <form class="needs-validation" action="update-profile.php?id=<?php echo $residentidFromURL; ?>" method="post" id="add-resident-form" novalidate>
                                        <div class="form-row mb-3">
                                            <div class="col-md-4">
                                                <label for="lastname" class="input-label">Last name</label>
                                                <input type="text" class="form-control" value="<?php echo $lastname; ?>" name="lastname" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="firstname" class="input-label">First name</label>
                                                <input type="text" class="form-control" value="<?php echo $firstname; ?>" name="firstname" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="middlename" class="input-label">Middle name</label>
                                                <input type="text" class="form-control" value="<?php echo $middlename; ?>" name="middlename" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-4">
                                                <label for="gender" class="input-label">Gender</label>
                                                <select name="gender" id="gender"  value="<?php echo $genderfull; ?>" class="form-control" name="gender">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="datepicker" class="input-label">Birthdate</label>
                                                <input type="text" class="form-control" name="birthdate" id="datepicker" value="<?php echo $birthdate; ?>" placeholder="e.g. 1999/06/01" required>
                                                <script>
                                                    var datepicker = $('#datepicker').datepicker({
                                                    // uiLibrary: 'bootstrap4'
                                                    // 
                                                    uiLibrary: 'bootstrap4', 
                                                    iconsLibrary: 'fontawesome',
                                                    format: 'yyyy-mm-dd'
                                                    });
                                                </script>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="contactnum" class="input-label">Age</label>
                                                <input type="text" class="form-control" value="<?php echo $age; ?>" disabled>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-4">
                                                <label for="contactnum" class="input-label">Contact number</label>
                                                <input type="text" class="form-control" value="<?php echo $contactnum; ?>" name="contactnum" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="occupation" class="input-label">Occupation</label>
                                                <input type="text" class="form-control" value="<?php echo $occupation; ?>" name="occupation" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="civilstatus" class="input-label">Civil Status</label>
                                                <input type="text" class="form-control" value="<?php echo $civilstatus; ?>" name="civilstatus" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-4">
                                                <label for="religion" class="input-label">Religion</label>
                                                <input type="text" class="form-control" value="<?php echo $religion; ?>" name="religion" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="housenum" class="input-label">House number</label>
                                                <input type="text" class="form-control" value="<?php echo $housenum; ?>" name="housenum" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="streetname" class="input-label">Street name</label>
                                                <select class="form-control" name="streetname" required>
                                                    <?php
                                                        $retrieveStreet = "SELECT * FROM tbl_street WHERE street_desc != 'Others'";

                                                        $resultStreet = mysqli_query($conn, $retrieveStreet);

                                                        while($DataRows = mysqli_fetch_assoc($resultStreet)){
                                                            $streetName = $DataRows['street_desc'];
                                                    ?>
                                                        <option value="<?php echo $streetName; ?>"><?php echo $streetName; ?></option>
                                                    <?php } ?>
                                                </select>
                                    <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>
                                <?php } ?>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="updateProfile" class="btn btn-success"><i class="far fa-check-circle"></i> Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                                </div>
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