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

    if(ISSET($_POST['save_blotter'])){
        $incident_place = mysqli_real_escape_string($conn, $_POST['incident_place']);
        $incident_details = mysqli_real_escape_string($conn, $_POST['incident_details']);

        $countBlotter = "SELECT COUNT(*) AS 'blotterCount' FROM tbl_blotter_details";
        
        $resultCountBlotter = mysqli_query($conn, $countBlotter);

        while($DataRows = mysqli_fetch_assoc($resultCountBlotter)){
            $blotterCount = $DataRows['blotterCount'];
        }

        if($blotterCount == 0){
            $blotterID = 1;
        }
        else{
            $blotterID = $blotterCount + 1;
        }

        $insertBlotterDetails = "INSERT INTO tbl_blotter_details VALUES('$blotterID', '$incident_place', '$incident_details', 'N', 'N', '0')";

        if(mysqli_query($conn, $insertBlotterDetails)){
            $_SESSION['successMessage'] = "Blotter details successfully added!";

            header("Refresh: 3;url=complainant-info.php?bID=$blotterID");
        }
        else{
            $_SESSION['errorMessage'] = "Dito".mysqli_error($conn);
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

                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item mr-3 nav-li">
                                <a href="admin.php" class="nav-link link"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="#about" class="nav-link link active"><i class="fas fa-clipboard"></i>&nbsp;File Blotter</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="#developer" class="nav-link link"><i class="fas fa-handshake"></i>&nbsp;Summon</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-resident.php" class="nav-link link"><i class="fas fa-id-card"></i>&nbsp;Resident</a>
                            </li>

                            <li class="nav-item mr-3 dropdown nav-li">
                                <a class="nav-link dropdown-toggle link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cogs"></i>&nbsp;Maintenance
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="#developer" class="nav-link link"><i class="fas fa-pen-square"></i>&nbsp;&nbsp;Manage Blotter</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="manage-user.php" class="nav-link link active"><i class="fas fa-user"></i>&nbsp;&nbsp;Manage User</a>
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

        <section id="file-blotter">
            <div class="container mb-5">
            <?php echo errorMessage(); echo successMessage(); ?>
                <div class="row">
                    <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                        <div class="card-header card-table-header">
                            <h1>Blotter Details</h1>
                        </div>
                        <div class="card-body">
                                <div class="container">
                                    <form class="needs-validation" action="file-blotter.php" method="POST" id="add-resident-form" novalidate>
                                       <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="lastname">Incident place</label>
                                                <input type="text" class="form-control" name="incident_place" required>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label for="gender">Incident Details</label>
                                                <textarea class="form-control" rows="10" name="incident_details" required></textarea>
                                                <div class="invalid-feedback">
                                                    Required field!
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="save_blotter" class="btn btn-success"><i class="far fa-check-circle"></i> Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                                </div>
                                    </form>
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