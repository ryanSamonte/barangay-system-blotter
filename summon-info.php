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

    if(ISSET($_POST['saveBlotter'])){
        $summondate = mysqli_real_escape_string($conn, $_POST['summondate']);
        $summonhour = mysqli_real_escape_string($conn, $_POST['summonhour']);
        $summonmin = mysqli_real_escape_string($conn, $_POST['summonmin']);
        $summontime = $summonhour.":".$summonmin;
        $date = new DateTime($summondate);
        $now = new DateTime();

        if(($summonhour > 24 || $summonmin > 59)){
            $_SESSION['errorMessage'] = "Invalid date/time input!";
            echo $summontime;
            echo $summondate;
        }
        else{
            $summonCountQuery = "SELECT COUNT(*) AS summonCount FROM `tbl_blotter_details` 
                                 WHERE (CAST(CONCAT('$summondate',' ','$summontime') AS datetime) 
                                 BETWEEN 
                                 CAST(CONCAT(summon_date,' ',summon_time) AS datetime) 
                                 AND 
                                 ADDTIME(CAST(CONCAT(summon_date,' ',summon_time) AS datetime), '2:00'))
                                 OR 
                                 (CAST(CONCAT('$summondate',' ','$summontime') AS datetime)
                                 BETWEEN 
                                 DATE_SUB(CAST(CONCAT(summon_date,' ',summon_time) AS datetime), INTERVAL 2 HOUR)
                                 AND 
                                 CAST(CONCAT(summon_date,' ',summon_time) AS datetime))";

            $resultSummonCount = mysqli_query($conn, $summonCountQuery);

            while($DataRows = mysqli_fetch_assoc($resultSummonCount)){
                $summonCount = $DataRows['summonCount'];
            }
            
            if($summonCount >= 1){
                $_SESSION['errorMessage'] = "Summon schedule already exists!";
            }
            else{
                $insertSummon = "UPDATE tbl_blotter_details 
                                 SET summon_date = '$summondate', summon_time = '$summontime', summon_count = summon_count + 1
                                 WHERE blotter_id = '$blotterIDfromURL'";

                if(mysqli_query($conn, $insertSummon)){
                    $_SESSION['successMessage'] = "Blotter record successfully added!";

                    header("Refresh: 2;url=manage-blotter.php");
                }
                else{
                    $_SESSION['errorMessage'] = mysqli_error($conn);
                }
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
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1>Summon Information</h1>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row mb-5">
                                        <div class="col">
                                        <form class="needs-validation" action="summon-info.php?bID=<?php echo $blotterIDfromURL; ?>" method="post" id="add-resident-form" novalidate>
                                            <div class="form-row mb-5">
                                                <div class="col">
                                                    <label for="datepicker">Date</label>
                                                    <input type="text" class="form-control" name="summondate" id="datepicker" placeholder="e.g. 2018/02/14" required>
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
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="firstname">Time (Hours) <p class="text-muted" style="display:inline-block;font-size:12px;">*24 Hour-format</p></label>
                                                    <input type="text" class="form-control" name="summonhour" id="firstname" placeholder="e.g. 12" required>
                                                    <div class="invalid-feedback">
                                                        Required field!
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="firstname">Time (Mins) <p class="text-muted" style="display:inline-block;font-size:12px;">*24 Hour-format</p></label>
                                                    <input type="text" class="form-control" name="summonmin" id="firstname" placeholder="e.g. 45" required>
                                                    <div class="invalid-feedback">
                                                        Required field!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="saveBlotter" class="btn btn-success"><i class="far fa-check-circle"></i> File blotter</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
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