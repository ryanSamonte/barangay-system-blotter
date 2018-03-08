<?php 
    require_once('functions/connection.php');
    require_once('functions/sessions.php'); 
?>

<?php

    global $conn;

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $checkUsernameQuery = "SELECT * FROM tbl_user WHERE username = '$username'";

        $result = mysqli_query($conn, $checkUsernameQuery);

        $usernameCount = mysqli_num_rows($result);

        if($usernameCount > 0){
            while($DataRows = mysqli_fetch_assoc($result)){
                $userid = $DataRows['userid'];
                $dbPassword = $DataRows['password'];
                $privilege = $DataRows['privilege'];
                $profileimg = $DataRows['profileimg'];
            }

            if($dbPassword == $password){

                $_SESSION['id'] = $userid;
                $_SESSION['privilege'] = $privilege;
                $_SESSION['profileimg'] = $profileimg;

                if($privilege == "1"){
                    echo "<script>window.location.href='admin/admin.php';</script>";
                }
                else{
                    echo "<script>window.location.href='user/index.php';</script>";
                }
            }
            else{
                $_SESSION['errorMessage'] = "Incorrect password!";
            }
        }
        else{
            $_SESSION['errorMessage'] = "Account doesn't exists!";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BrgySipac</title>

        <link rel="icon" href="img/sipac-logo.png">

        <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="fonts/webfonts/fontawesome-all.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">

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
    <body id="login-body">
        <section id="login-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 d-none d-lg-block d-xl-block">
                        <div class="card title-panel text-center">
                            <div class="card-body">
                                <img src="img/login-logo.png" class="img-responsive login-logo" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card login-panel text-center">
                            <div class="card-header"><i class="far fa-id-card"></i> USER LOGIN</div>
                            <div class="card-body px-2 pb-5">
                            <?php echo errorMessage(); echo successMessage(); ?>
                                <form class="needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="login-form" method="post">
                                    
                                    <div class="input-group input-group-lg" style="width: 90%; margin: 0 auto; margin-top: 20px; margin-bottom: 20px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type ="text" name="username"
                                        class = "form-control form-control-lg" placeholder="Username" required>
                                        <div class="invalid-feedback">
                                            Required field!
                                        </div>
                                    </div>

                                    <div class="input-group input-group-lg" style="width: 90%; margin: 0 auto; margin-bottom: 30px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type ="password" name="password"
                                        class = "form-control form-control-lg" placeholder="Password" required>
                                        <div class="invalid-feedback">
                                            Required field!
                                        </div>
                                    </div>

                                    <input type ="submit" name="submit" value ="Log in" class="btn btn-outline-secondary btn-block btn-submit btn-lg" style="width: 85%;">
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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