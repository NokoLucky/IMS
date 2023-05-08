<?php 
require 'core/init.php';
$general->logged_out_protect();

if (isset($_POST['submit'])) {

  if(empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['repassword'])){

    $errors[] = 'You must fill in all of the fields.';

  }else{
                
        if ($users->user_exists($_POST['username']) === true) {
            $errors[] = 'Sorry, That username already exists';
        }

        if ($_POST['password'] != $_POST['repassword'] ) {
            $errors[] = 'The passwords do not match';
        }

        if(!ctype_alnum($_POST['username'])){
            $errors[] = 'Please enter a username with only alphabets and numbers, with no spaces in between'; 
        }
        if (strlen($_POST['password']) <6){
            $errors[] = 'Your password must be atleast 6 characters';
        } else if (strlen($_POST['password']) >18){
            $errors[] = 'Your password cannot be more than 18 characters long';
        }
        else if (!preg_match("#[0-9]+#", $_POST['password'])) {
           $errors[] = "Password must include at least one number!";
         }

          else if (!preg_match("#[a-zA-Z]+#", $_POST['password'])) {
          $errors[] = "Password must include at least one letter!";
          }   
          if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }else if ($users->email_exists($_POST['email']) === true) {
            $errors[] = 'Sorry, That email already exists.';
        }
  }

  if(empty($errors) === true){
    
    $name          = htmlentities($_POST['name']);	
    $username      = htmlentities($_POST['username']);
    $email         = htmlentities($_POST['email']);
	  $password      = $_POST['password'];
    $repassword    = $_POST['repassword'];
    $d_id          = htmlentities($_POST['d_id']);
    $role          = 'technician';
    $hiredate      = date('Y-m-d');
    
    $users->register_tech($name, $username, $email, $password, $repassword, $d_id, $role, $hiredate);
    
	      echo '<script language="javascript">';
        echo 'alert("Technician successfully added")';
        echo '</script>';
      header('Location: admin_home.php');
      exit();
  }
}

$depts = $chartforum->departments();
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
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Admin : Add Technician</h2>
               
                <h5>( Register technicians to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  New User ? Register Yourself </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" name="myForm" action="" method="POST">
<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch" ></i></span>
                                            <input type="text" name="name" class="form-control" placeholder="Technician Name" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="username" class="form-control" placeholder="Technician Username" />
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" name="email" class="form-control" placeholder="Technician Email" />
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-briefcase" ></i></span>
                                                <select class="form-control" name="d_id">
                                              <option value=""> - Select - </option>                      
                                              <?php foreach($depts as $row) { ?> 
                                              <option value="<?php echo $row['d_id'];?>"><?php echo $row['dname'];?></option>
                                               <?php } ?>
                                                </select>
                                        </div>
										
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Technician Password" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="repassword" class="form-control" placeholder="Retype Password" />
                                        </div>
                                     
									                   <button type="submit" name="submit" class="btn btn-success">Register Me</button>
                                    <hr />
                                    <?php 
                                      if(empty($errors) === false){
                                       echo '<p>' . implode('</p><p>', $errors) . '</p>';  
                                      }
                                      ?>
                                    </form>
                                    <a href="admin_home.php" class="btn btn-primary">Back</a>
									
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
