<?php 
    require_once('../functions/connection.php');
    require_once('../functions/sessions.php'); 
?>

<?php

    global $conn;

    if(isset($_SESSION['id'])){
        if($_SESSION['privilege'] == '1'){
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
        $housenum = mysqli_real_escape_string($conn, $_POST['housenum']);
        $streetname = mysqli_real_escape_string($conn, $_POST['streetname']);
        
        
        $insertUserQuery = "INSERT INTO `tbl_resident`(`lastname`, `firstname`, `middlename`, `gender`, `birthdate`, `age`, `contactnum`, `housenum`, `streetname`, `archivestatus`, `blotterrecords`) VALUES ('$lastname','$firstname','$middlename','$gender','$birthdateNewFormat', DATEDIFF(CURRENT_DATE(), '$birthdateNewFormat') / 365 ,'$contactnum','$housenum','$streetname','0','0')";
    
        if(mysqli_query($conn, $insertUserQuery)){
            $_SESSION['successMessage'] = "New resident successfully added!";
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
        <script src="js/index.js"></script>
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
                    <a href="user.php" class="navbar-brand mr-5">
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
                                <a href="#developer" class="nav-link link"><i class="fas fa-handshake"></i>&nbsp;Summon</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-resident.php" class="nav-link link active"><i class="fas fa-id-card"></i>&nbsp;Resident</a>
                            </li>

                            <li class="nav-item dropdown nav-li mr-3">
                                <a class="nav-link dropdown-toggle link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cogs"></i>&nbsp;Maintenance
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="#developer" class="nav-link link"><i class="fas fa-pen-square"></i>&nbsp;&nbsp;Manage Blotter</a>
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

        <section id="manage-resident" class="mb-5">
            <div class="container">
            <?php echo errorMessage(); echo successMessage(); ?>
                <div class="row text-center mb-5">
                    <div class="col">
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add-resident">
                            &plus; Add new resident
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1>Household Head</h1>
                            </div>
                            <div class="card-body p-0">
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
                                                            <div class="col-md-4">
                                                                <a href="view-profile.php?id=<?php echo $residentid; ?>" class="btn btn-primary btn-table" data-toggle="tooltip" data-placement="top" title="View Profile"><i class="fas fa-eye"></i></a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="" class="btn btn-warning btn-table" data-toggle="tooltip" data-placement="top" title="Update Profile" data-animation="true"><i class="far fa-edit"></i></a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="manage-resident.php?archive=<?php echo $residentid; ?>" class="btn btn-danger btn-table" data-toggle="tooltip" data-placement="top" title="Archive Profile" data-animation="true"><i class="far fa-file-archive"></i></a>
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

        <section id="add-resident-modal">
            <div class="modal fade" id="add-resident" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">&plus; Add new resident</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="add-resident-form" novalidate>
                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                    <label for="lastname">Last name</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="e.g. Dela Cruz" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="firstname">First name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="e.g. Juan" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="middlename">Middle name</label>
                                    <input type="text" class="form-control" name="middlename" id="middlename" placeholder="e.g. Marcial" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="datepicker">Birthdate</label>
                                    <input type="text" class="form-control" name="birthdate" id="datepicker" placeholder="e.g. 03/01/2018" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="contactnum">Contact number</label>
                                    <input type="text" class="form-control" name="contactnum" id="contactnum" placeholder="e.g. 09123456789" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                    <label for="housenum">House number</label>
                                    <input type="text" class="form-control" name="housenum" id="housenum" placeholder="e.g. 47" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <label for="streetname">Street name</label>
                                    <input type="text" class="form-control" name="streetname" id="streetName" placeholder="e.g. San Rafael" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success"><i class="far fa-check-circle"></i> Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </section>

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