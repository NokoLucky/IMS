<?php
require 'core/init.php';
$general->logged_in_protect();

        
if (empty($_POST) === false) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = trim($_POST['role']);

    if (empty($username) === true || empty($password) === true) {
        $errors[] = 'Sorry, but we need your username and password.';
        
   
    } else {
        
        if($role == "user")
        {
            $login = $users->login($username, $password);

             if ($login === false) {
                $errors[] = 'Sorry, that username or password is invalid for that role';
            }else {
                $_SESSION['id'] =  $login;
                echo "<script>alert('Yes I got it!');</script>";
                header('Location: index.php');
                exit();
            }
        }
        else if($role == "admin")
        {
           $login = $users->admin_login($username, $password);

             if ($login === false) {
                $errors[] = 'Sorry, that admin username or password is invalid';
            }else {
                $_SESSION['id'] =  $login;
                header('Location: admin_home.php');
                exit();
            }
        }
        else if($role == "technician")
        {
              $login = $users->technician_login($username, $password);

             if ($login === false) {
                $errors[] = 'Sorry, that technician username or password is invalid';
             }else {
                $_SESSION['id'] =  $login;
                header('Location: tech_home.php');
                exit();
             }
        }
    }
} 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Incident Management System</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Sign In</h2>
               
                <h5>( Login yourself to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Enter Details To Login </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" name="login" action="" method="POST">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="username" class="form-control" placeholder="Your Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control"  placeholder="Your Password" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="radio" name="role" value="user" checked="checked"/> User
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" name="role" value="admin"/> Admin
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" name="role" value="technician"/> Technician
                                            </label>
                                            
                                        </div>

									 <button type="submit" name="submit" class="btn btn-primary">Login Now</button>
                                    <hr />
                                    Not registered ? <a href="registeration.php" >click here </a> 
                                    </form>
									
									<?php 
									 if(empty($errors) === false)
                                     {
										echo '<p>' . implode('</p><p>', $errors) . '</p>';  
									 }
									?>
                            </div>
                           
                        </div>
                    </div>         
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
