<?php
require 'core/init.php';
$general->logged_out_protect();

$callNum  = $_GET['callNum'];
$d_id     = $_GET['d_id'];
$user_id  = htmlentities($user['id']);


  if(isset($_POST['submit']))
  {
   $t_id     = htmlentities($_POST['t_id']);

    $chartforum->escalate_call($t_id, $callNum);
    header("Location: tech_home.php");

  }

  $techs = $chartforum->select_different_technician($user_id,$d_id);
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
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last account activity : <?php echo date('H:i');?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a></div>
        </nav>  
           <!-- /. NAV TOP  -->
             
        <!-- /. NAV SIDE  -->
      
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Assign this Incident to the technician</h2>   
                       <h4>Call ID: <?php echo $callNum;?></h4>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <form role="form" name="myForm" action="" method="POST" >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Choose technician 
                        </div>
                        
                        <div class="col-md-6">
                                    <h3>Technicians</h3>
                                   <div class="form-group">
                                            <label>choose below</label>
                                            <select class="form-control" name="t_id">
                                              <option value=""> - Select - </option>                      
                                              <?php foreach($techs as $row) { ?> 
                                              <option value="<?php echo $row['t_id'];?>"><?php echo $row['name'];?></option>
                                               <?php } ?>
                                            </select>
                                        <br />
                                        <button type="submit" name="submit" class="btn btn-success">Assign</button>
                                        </div>
                                    <hr/>
                                   
                                </div>
                        
                    </div>
                </form>
                    <!-- End Advanced Tables -->
                </div>
            </div>
               <a href="tech_home.php" class="btn btn-primary ">Back</a>
                <!-- /. ROW  -->
            
              
                <!-- /. ROW  -->
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
           
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
