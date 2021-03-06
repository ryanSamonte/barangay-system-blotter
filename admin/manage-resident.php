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
            
            
            $insertUserQuery = "INSERT INTO `tbl_resident`(`lastname`, `firstname`, `middlename`, `gender`, `birthdate`, `age`, `contactnum`, `occupation`, `civilstatus`, `religion`, `housenum`, `streetname`, `archivestatus`, `blotterrecords`) VALUES ('$lastname','$firstname','$middlename','$gender','$birthdate', '$age' ,'$contactnum','$occupation','$civilstatus','$religion','$housenum','$streetname','0','0')";
        
            if(mysqli_query($conn, $insertUserQuery)){
                $_SESSION['successMessage'] = "New resident info successfully added!";
            }
            else{
                $_SESSION['errorMessage'] = mysqli_error($conn);
            }
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
                                <a href="manage-blotter.php" class="nav-link link"><i class="fas fa-folder-open"></i>&nbsp;Blotter Record</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="" class="nav-link active link"><i class="fas fa-id-card"></i>&nbsp;Resident</a>
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
                                <h1>Resident</h1>
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
                                                                <a href="update-profile.php?id=<?php echo $residentid; ?>" class="btn btn-warning btn-table" data-toggle="tooltip" data-placement="top" title="Update Profile" data-animation="true"><i class="far fa-edit"></i></a>
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
                                    <label for="datepicker" class="input-label">Birthdate</label>
                                    <input type="text" class="form-control" name="birthdate" id="datepicker" placeholder="e.g. 1999/06/01" required>
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

                                <div class="col-md-4">
                                    <label for="civilstatus" class="input-label">Civil Status</label>
                                    <select name="civilstatus" id="civilstatus" class="form-control">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="religion" class="input-label">Religion</label>
                                    <input type="text" class="form-control" name="religion" id="religion" placeholder="e.g. Catholic" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                    <label for="housenum" class="input-label">House number</label>
                                    <input type="text" class="form-control" name="housenum" id="housenum" placeholder="e.g. 47" required>
                                    <div class="invalid-feedback">
                                        Required field!
                                    </div>
                                </div>

                                <div class="col-md-9">
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