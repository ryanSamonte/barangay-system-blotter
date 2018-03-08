<?php 
    require_once('../functions/connection.php');
    require_once('../functions/sessions.php'); 
?>

<?php

    global $conn;

    if(isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        $profileimg = $_SESSION['profileimg'];

        $retrieveUserInfoQuery = "SELECT * FROM tbl_user WHERE userid='$userid'";

        $result = mysqli_query($conn, $retrieveUserInfoQuery);

        while($DataRows = mysqli_fetch_assoc($result)){
            $firstname = $DataRows['firstname'];
        }
    }
    else{
        echo "<script>window.location.href='../login.php';</script>";
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
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/index.js"></script>
    </head>
    <body>
        <section id="admin-header">
            <div class="overlay">
            <nav class="navbar navbar-expand-lg p-0 navigation sticky-top">
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
                                <a href="" class="nav-link active link"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="#about" class="nav-link link"><i class="fas fa-clipboard"></i>&nbsp;File Blotter</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="#developer" class="nav-link link"><i class="fas fa-handshake"></i>&nbsp;Summon</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-resident.php" class="nav-link link"><i class="fas fa-id-card"></i>&nbsp;Resident</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="#developer" class="nav-link link"><i class="fas fa-pen-square"></i>&nbsp;Manage Blotter</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle user-option" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../uploads/<?php echo $profileimg; ?>" alt="" class="profile-img">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Welcome <?php echo $firstname.'!'; ?></a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
          </div>
        </section>

        <section id="dashboard" class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="manage-resident.php">
                        <div class="card text-center" style="width: 100%;">
                            <div class="card-header count-header-cont">
                                <h5 class="card-title count-title">Resident/s</h5>
                            </div>
                            <div class="card-body count-resident">
                                <?php
                                    $retriveResidentCountQuery = "SELECT COUNT(*) AS 'residentcount' FROM tbl_resident WHERE archivestatus = 0";

                                    $result = mysqli_query($conn, $retriveResidentCountQuery);

                                    while($DataRows = mysqli_fetch_assoc($result)){
                                        $residentcount = $DataRows['residentcount'];
                                ?>
                                <p class="card-text count-lbl"><i class="fas fa-id-card"></i>&nbsp;&nbsp;<?php echo htmlentities($residentcount); ?></p>
                                    <?php } ?>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="login.html">
                        <div class="card text-center" style="width: 100%;">
                            <div class="card-header count-header-cont" style="background-color: #F39C12;">
                                <h5 class="card-title count-title">Blotter/s</h5>
                            </div>
                            <div class="card-body count-blotter">
                                <p class="card-text count-lbl"><i class="fas fa-clipboard link-icon"></i>&nbsp;&nbsp;20</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="login.html">
                        <div class="card text-center" style="width: 100%;">
                            <div class="card-header count-header-cont" style="background-color: #37BD28;">
                                <h5 class="card-title count-title">Summon/s</h5>
                            </div>
                            <div class="card-body count-summon">
                                <p class="card-text count-lbl"><i class="fas fa-handshake"></i>&nbsp;&nbsp;20</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="login.html">
                        <div class="card text-center" style="width: 100%;">
                            <div class="card-header count-header-cont" style="background-color: #F03434;">
                                <h5 class="card-title count-title">Pending Blotter/s</h5>
                            </div>
                            <div class="card-body count-pending-blotter">
                                <p class="card-text count-lbl"><i class="fas fa-calendar-times"></i>&nbsp;&nbsp;20</p>
                            </div>
                        </div>
                        </a>
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

        <!-- <script src="js/index.js"></script> -->
        <script src='js/jquery-3.3.1.min.js'></script>
    </body>
</html>