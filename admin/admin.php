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
        <script src="../js/index.js"></script>
    </head>
    <body>
        <section id="admin-header">
            <div class="overlay">
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
                                <a href="" class="nav-link active link"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="file-blotter.php" class="nav-link link"><i class="fas fa-clipboard"></i>&nbsp;File Blotter</a>
                            </li>

                            <li class="nav-item mr-3 nav-li">
                                <a href="manage-blotter.php" class="nav-link link"><i class="fas fa-folder-open"></i>&nbsp;Blotter Record</a>
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

        <section id="dashboard" class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="manage-resident.php">
                        <div class="card text-center mb-3" style="width: 100%;">
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

                    <div class="col-md-4">
                        <a href="manage-blotter.php">
                        <div class="card text-center mb-3" style="width: 100%;">
                            <div class="card-header count-header-cont" style="background-color: #F39C12;">
                                <h5 class="card-title count-title">Blotter/s</h5>
                            </div>
                            <div class="card-body count-blotter">
                                <?php
                                    $retrieveBlotterCountQuery = "SELECT COUNT(*) AS 'blotterCount' FROM tbl_blotter_details WHERE (CAST(CONCAT(summon_date, ' ', summon_time) AS datetime) >= NOW()) AND archive_status = 0 AND isResolved = 'N'";

                                    $result = mysqli_query($conn, $retrieveBlotterCountQuery);

                                    while($DataRows = mysqli_fetch_assoc($result)){
                                        $blottercount = $DataRows['blotterCount'];
                                ?>
                                <p class="card-text count-lbl"><i class="fas fa-clipboard link-icon"></i>&nbsp;&nbsp;<?php echo htmlentities($blottercount); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="blotter-history.php">
                        <div class="card text-center mb-3" style="width: 100%;">
                            <div class="card-header count-header-cont" style="background-color: #F03434;">
                                <h5 class="card-title count-title">Blotter History</h5>
                            </div>
                            <div class="card-body count-pending-blotter">
                                <?php
                                    $retrieveBlotterHistoCountQuery = "SELECT COUNT(*) AS 'blotterHistoCount' FROM tbl_blotter_details WHERE (CAST(CONCAT(summon_date, ' ', summon_time) AS datetime) < NOW()) AND archive_status = 0";

                                    $result = mysqli_query($conn, $retrieveBlotterHistoCountQuery);

                                    while($DataRows = mysqli_fetch_assoc($result)){
                                        $blotterhistocount = $DataRows['blotterHistoCount'];
                                ?>
                                <p class="card-text count-lbl"><i class="fas fa-archive"></i>&nbsp;&nbsp;<?php echo htmlentities($blotterhistocount); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1>Blotter Record per Street</h1>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table table-hover table-inverse text-center">
                                        <thead>
                                            <th>No</th>
                                            <th>Street Name</th>
                                            <th>Incident Count</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $retrieveStreet = "SELECT * FROM tbl_street WHERE street_desc != 'Others' ORDER BY blotter_count DESC";
                                                $no = 0;
                                                $result = mysqli_query($conn, $retrieveStreet);

                                                while($DataRows = mysqli_fetch_assoc($result)){
                                                    $street_id = $DataRows['street_id'];
                                                    $street_desc = $DataRows['street_desc'];
                                                    $blotter_count = $DataRows['blotter_count'];
                                                    $no++;
                                                ?>
                                            <tr>
                                                <td class="p-1"><?php echo htmlentities($no); ?></td>
                                                <td class="p-1"><?php echo htmlentities($street_desc); ?></td>
                                                <td class="p-1"><?php echo htmlentities($blotter_count); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1 style="font-size: 23px;">Upcoming Summon</h1>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table table-hover table-inverse text-center">
                                        <thead>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $retrieveBlotter = "SELECT * FROM tbl_blotter_details WHERE (CAST(CONCAT(summon_date, ' ', summon_time) AS datetime) >= NOW()) AND archive_status = 0 AND isResolved = 'N' ORDER BY CAST(CONCAT(summon_date, ' ', summon_time) AS datetime) ASC LIMIT 9";
                                                $no = 0;

                                                $result = mysqli_query($conn, $retrieveBlotter);

                                                while($DataRows = mysqli_fetch_assoc($result)){
                                                    $blotter_id = $DataRows['blotter_id'];
                                                    $incident_place = $DataRows['incident_place'];
                                                    $incident_details = $DataRows['incident_details'];
                                                    $summon_date = $DataRows['summon_date'];
                                                    $summon_time = $DataRows['summon_time'];
                                                    $no++;
                                                ?>
                                            <tr>
                                                <td class="p-1"><?php echo htmlentities($no); ?></td>
                                                <td class="p-1"><?php echo htmlentities($summon_date); ?></td>
                                                <td class="p-1"><?php echo htmlentities($summon_time); ?></td>
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
        <!-- <script src="js/index.js"></script> -->
        <script src='js/jquery-3.3.1.min.js'></script>
    </body>
</html>