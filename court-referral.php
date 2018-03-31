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

    if(ISSET($_POST['submit'])){
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
        $birthdate = date_create(mysqli_real_escape_string($conn, $_POST['birthdate']));
        $birthdateNewFormat = date_format($birthdate, "Y-m-d");
        $contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);
        $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
        $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
        $religion = mysqli_real_escape_string($conn, $_POST['religion']);
        $housenum = mysqli_real_escape_string($conn, $_POST['housenum']);
        $streetname = mysqli_real_escape_string($conn, $_POST['streetname']);
        
        
        $insertUserQuery = "INSERT INTO `tbl_household_head`(`lastname`, `firstname`, `middlename`, `gender`, `birthdate`, `age`, `contactnum`, `occupation`, `civilstatus`, `religion`, `housenum`, `streetname`, `archivestatus`, `blotterrecords`, `residenttype`) VALUES ('$lastname','$firstname','$middlename','$gender','$birthdateNewFormat', DATEDIFF(CURRENT_DATE(), '$birthdateNewFormat') / 365 ,'$contactnum','$occupation','$civilstatus','$religion','$housenum','$streetname','0','0','Household head')";
    
        if(mysqli_query($conn, $insertUserQuery)){
            $_SESSION['successMessage'] = "New household head successfully added!";
        }
        else{
            $_SESSION['errorMessage'] = mysqli_error($conn);
        }
    }

    if(ISSET($_GET['archive'])){
        $useridFromURL = $_GET['archive'];

        $updateArchiveStatusQuery = "UPDATE tbl_resident SET archivestatus = '1' WHERE residentid = '$useridFromURL'";

        if(mysqli_query($conn, $updateArchiveStatusQuery)){
            $_SESSION['successMessage'] = "User info successfully archived!";
            header("Refresh: 3;url=manage-resident.php");
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
            <nav class="navbar navbar-expand-xl p-0">
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
                                    <a href="#developer" class="nav-link link"><i class="fas fa-gavel"></i>&nbsp;&nbsp;Court Referral</a>
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
        </section>

        <section id="manage-resident" class="mb-5">
            <div class="container">
            <?php echo errorMessage(); echo successMessage(); ?>
                <div class="row">
                    <div class="col">
                        <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1>Blotter Record</h1>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table table-hover table-inverse">
                                        <thead>
                                            <th>Place</th>
                                            <th>Details</th>
                                            <th>Summon Count</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $retriveBlotter = "SELECT * FROM tbl_blotter_details WHERE archive_status = 0";

                                                $result = mysqli_query($conn, $retriveBlotter);

                                                while($DataRows = mysqli_fetch_assoc($result)){
                                                    $blotter_id = $DataRows['blotter_id'];
                                                    $incident_place = $DataRows['incident_place'];
                                                    $incident_details = $DataRows['incident_details'];
                                                    $summon_count = $DataRows['summon_count'];

                                                    if(strlen($incident_details) > 50){
                                                        $newIncidentDetails = substr($incident_details, 0, 50)."...";
                                                    }
                                                    else{
                                                        $newIncidentDetails = $incident_details;
                                                    }
                                                ?>
                                            <tr>
                                                <td><?php echo htmlentities($incident_place); ?></td>
                                                <td><?php echo htmlentities($newIncidentDetails); ?></td>
                                                <td><?php echo htmlentities($summon_count); ?></td>
                                                <td class="text-right">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="court-referral-info.php?bID=<?php echo $blotter_id; ?>" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="top" title="Generate Court Referral"><i class="fas fa-gavel"></i></a>
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

        <a href="javascript:" id="return-to-top" class="top-arr">
            <i class="fas fa-chevron-up"></i>
        </a>

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