<?php 
    require_once('../functions/connection.php');
    require_once('../functions/sessions.php');
    // require('../fpdf181/fpdf.php'); 
?>

<?php
    require('../fpdf181/fpdf.php');
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

    if(ISSET($_POST['generateReport'])){
        $filterBy = mysqli_real_escape_string($conn, $_POST['filterBy']);
        $retriveResidentQuery = "";

        if($filterBy == "Gender (Male)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE gender = 'M' AND archivestatus = 0";
        }
        else if($filterBy == "Gender (Female)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE gender = 'F' AND archivestatus = 0";
        }
        else if($filterBy == "Age (0-10)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE age < 0 OR age BETWEEN 0 AND 10 AND archivestatus = 0";
        }
        else if($filterBy == "Age (11-17)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE age BETWEEN 11 AND 17 AND archivestatus = 0";
        }
        else if($filterBy == "Age (18-25)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE age BETWEEN 18 AND 25 AND archivestatus = 0";
        }
        else if($filterBy == "Age (26-59)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE age BETWEEN 26 AND 59 AND archivestatus = 0";
        }
        else if($filterBy == "Age (60 and above)"){
            $retriveResidentQuery = "SELECT * FROM tbl_resident WHERE age >= 60 AND archivestatus = 0";
        }
        else{
            $retriveResidentQuery = "SELECT * FROM tbl_resident AND archivestatus = 0";
        }

        class PDF extends FPDF {
            function Header(){
                $this->SetFont('Arial','B',10);
                $this->Cell(12);
                
                //put logo
                $this->Image('../img/sipac-logo.png',10,10,20);
                $this-> SetXY(35,10); 
                $this->Cell(100,10,'BARANGAY SIPAC-ALMACEN, NAVOTAS CITY',0,1);
                $this->SetFont('Arial','B',15);
                $this-> SetXY(10,40);
                $this->Cell(100,10,'RESIDENT (BARANGAY SIPAC-ALMACEN)',0,1);
                
                $this->Ln(5);
                
                $this->SetFont('Arial','B',11);
                
                $this->SetDrawColor(0,0,0);
                $this->Cell(40,5,'LASTNAME',1,0,'',false);
                $this->Cell(40,5,'FIRSTNAME',1,0,'',false);
                $this->Cell(40,5,'MIDDLENAME',1,0,'',false);
                $this->Cell(15,5,'GNDR',1,0,'',false);
                $this->Cell(30,5,'BIRTHDATE',1,0,'',false);
                $this->Cell(10,5,'AGE',1,0,'',false);
                $this->Cell(47,5,'OCCUPATION',1,0,'',false);
                $this->Cell(25,5,'C STATUS',1,0,'',false);
                $this->Cell(25,5,'HOUSE NO',1,0,'',false);
                $this->Cell(40,5,'STREET',1,1,'',false);
                
            }
            function Footer(){
                //add table's bottom line
                $this->Cell(190,0,'','T',1,'',true);
                
                //Go to 1.5 cm from bottom
                $this->SetY(-15);
                        
                $this->SetFont('Arial','',8);
                
                //width = 0 means the cell is extended up to the right margin
                $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
            }
        }

        $pdf = new PDF('L', 'mm', 'Legal');
        $pdf->SetMargins(25.4, 25.4);
        $pdf->SetRightMargin(100);
        $pdf->AliasNbPages('{pages}');
        $pdf->SetAutoPageBreak(true,15);
        $pdf->AddPage();
        $dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow', EXTRACT(HOUR FROM NOW()) AS 'hourNow', EXTRACT(MINUTE FROM NOW()) AS 'minNow'";

                $resultDateNow = mysqli_query($conn, $dateNow);

                while($DataRows = mysqli_fetch_array($resultDateNow)){
                    $pdf->SetFont('Arial','B', 8);
                    $pdf-> SetXY(290,10);
                    $pdf->Cell(50,10, $DataRows['monthNow']." ".$DataRows['dayNow'].", ".$DataRows['yearNow'], 0, 1, 'R');
                }
        $pdf->SetFont('Arial','B', 14);
        $pdf-> SetY(60);
            
        $query=mysqli_query($conn,$retriveResidentQuery);
        while($data=mysqli_fetch_array($query)){
            $pdf->Cell(40,8,$data['lastname'],1,0);
            $pdf->Cell(40,8,$data['firstname'],1,0);
            $pdf->Cell(40,8,$data['middlename'],1,0);
            $pdf->Cell(15,8,$data['gender'],1,0);
            $pdf->Cell(30,8,$data['birthdate'],1,0);
            $pdf->Cell(10,8,$data['age'],1,0);
            $pdf->Cell(47,8,$data['occupation'],1,0);
            $pdf->Cell(25,8,$data['civilstatus'],1,0);
            $pdf->Cell(25,8,$data['housenum'],1,0);
            $pdf->Cell(40,8,$data['streetname'],1,1);
        }

        $dateNow = "SELECT EXTRACT(YEAR FROM NOW()) AS 'yearNow', MONTHNAME(NOW()) AS 'monthNow', EXTRACT(DAY FROM NOW()) AS 'dayNow', EXTRACT(HOUR FROM NOW()) AS 'hourNow', EXTRACT(MINUTE FROM NOW()) AS 'minNow'";

                $resultDateNow = mysqli_query($conn, $dateNow);

                while($DataRows = mysqli_fetch_array($resultDateNow)){
                    $pdf->Output('I', $DataRows['yearNow']."_".$DataRows['monthNow']."_".$DataRows['dayNow']."_".$DataRows['hourNow']."_".$DataRows['minNow']."_resident_list.pdf");
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
                            <a href="admin.php" class="nav-link link"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
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
                            <a class="nav-link dropdown-toggle link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file"></i>&nbsp;Report
                            </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="court-referral.php" class="nav-link link"><i class="fas fa-gavel"></i>&nbsp;&nbsp;Court Referral</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="summon-resolution.php" class="nav-link link"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Resolution</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="resident-list.php" class="nav-link link active"><i class="fas fa-users"></i>&nbsp;&nbsp;Resident List</a>
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

        <section id="file-blotter">
            <div class="container" style="margin-bottom: 212px;">
            <?php echo errorMessage(); echo successMessage(); ?>
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="card card-table" style="padding-left:0px;padding-right:0px;">
                            <div class="card-header card-table-header">
                                <h1>Residents' List</h1>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row mb-5">
                                        <div class="col">
                                        <form class="needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="add-resident-form" novalidate>
                                            <div class="form-row mb-5">
                                                <div class="col">
                                                    <label for="datepicker" class="input-label">Filter by:</label>
                                                    <select name="filterBy" id="" class="form-control">
                                                        <option value="None">None</option>
                                                        <option value="Gender (Male)">Gender (Male)</option>
                                                        <option value="Gender (Female)">Gender (Female)</option>
                                                        <option value="Age (0-10)">Age (0-10)</option>
                                                        <option value="Age (11-17)">Age (11-17)</option>
                                                        <option value="Age (18-25)">Age (18-25)</option>
                                                        <option value="Age (26-59)">Age (26-59)</option>
                                                        <option value="Age (60 and above)">Age (60 and above)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="generateReport" class="btn btn-success"><i class="far fa-check-circle"></i> Generate report</button>
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