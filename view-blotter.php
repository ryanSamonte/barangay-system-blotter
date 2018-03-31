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
                                if(ISSET($_GET['bId'])){
                                    $blotterIDFromURL = $_GET['bId'];
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
                                    <form class="needs-validation" action="add-family-member.php?id=<?php echo $householdheadid; ?>" method="post" id="add-resident-form" novalidate>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname">Incident place</label>
                                                <input type="text" class="form-control" value="<?php echo $incident_place; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname">Incident details</label>
                                                <textarea type="text" class="form-control" rows="8" disabled><?php echo $incident_details; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname">Complainant(s)</label>
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
                                                <label for="lastname">Respondent(s)</label>
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
                                                <label for="lastname">Summon date</label>
                                                <input type="text" class="form-control" value="<?php echo $summon_date; ?>" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastname">Summon time</label>
                                                <input type="text" class="form-control" value="<?php echo $summon_time; ?>" disabled>
                                            </div>
                                        </div>
                                </div>
                                </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="complainant-summon.php?bID=<?php echo $blotter_id; ?>" class="btn btn-success btn-block" target="_blank"><i class="far fa-handshake"></i>&nbsp;Generate summon for Complainant</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="respondent-summon.php?bID=<?php echo $blotter_id; ?>" class="btn btn-danger btn-block" target="_blank"><i class="far fa-handshake"></i>&nbsp;Generate summon for Respondent</a>
                                            </div>
                                        </div>
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