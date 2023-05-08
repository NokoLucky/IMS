<?php
require 'core/init.php';
$general->logged_out_protect();

$user_id  = $_GET['user_id'];

$callNum = $_GET['callNum'];

$selected = $chartforum->select_call($callNum);

if(isset($_POST['submit']))
{
  $name         = htmlentities($_POST['name']);
  $closedDate   = htmlentities($_POST['closedDate']);
  $similar      = htmlentities($_POST['similar']);
  $status       = htmlentities($_POST['status']);
  $description  = htmlentities($_POST['description']);

 $enter        = $chartforum->insert_solution($callNum, $user_id, $name, $status, $closedDate, $similar, $description);
 $updatestatus = $chartforum->update_status($status, $callNum);
 Header('Location: tech_home.php');
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
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last account activity : <?php echo date('H:i');?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
          
        <!-- /. NAV SIDE  -->
        
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Close This Call Below</h2>   
                        <?php foreach ($selected as $rw) { ?>
                   <h4>Call Description: <?php echo $rw['description']; ?></h4>
                 <?php } ?>
                    </div>
                </div>
               
                 <!-- /. ROW  -->
                 <hr />
                 
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Details Below
                        </div>
                        <div class="panel-body">
                            <div class="row">
							       <form role="form" name="thisForm" action="" method="POST">
                                <div class="col-md-6">
                                    <h3>General Data</h3>
                                    
                                     <?php foreach ($selected as $row) { ?>
                                        <fieldset disabled="disabled">
                                            <div class="form-group">
                                                <label for="disabledSelect">ID:</label>
                                                <input class="form-control" id="disabledInput" type="text" name="callNum" value="<?php echo $row['callNum'];?>"; disabled />
                                            </div>                                   
                                        </fieldset>
                                        <?php }?>
										
                                        <div class="form-group">
                                            <label>Closed By:</label>
                                            <input class="form-control" type="text" name="name" placeholder="Please Enter Your Name" required="required" />
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option>-Select status-</option>
                                                <option>Acknowledge</option>
                                                <option>Resolved</option>
                                                <option>On Hold(Internal)</option>
                                            </select>
                                        </div>
  
                                </div>
                                
                                <div class="col-md-6">
                                    <h3>Dates</h3>
                                   <div class="form-group">
                                            <label>Closed Date:</label>
                                            <input class="form-control" type="date" name="closedDate"  required="required"/>
                                        </div>
                                    
									<h3>Solution</h3>
                                    <hr/>
                                    <div class="form-group">
                                            <label>Root Cause:</label>
                                            <input class="form-control" type="text" name="similar" placeholder="Enter Cause of problem" required="required"/>
                                        </div>
                                   
                                </div>
								
								     <div class="col-md-12">
								      <div class="form-group">
                                            <label>Solution Description:</label>
                                            <textarea class="form-control" name="description" rows="3" required="required"></textarea>
                                        </div>
										<button type="submit" name="submit" class="btn btn-primary">Submit Data</button>
								</div>
							 </form>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
            <a href="calls.php" class="btn btn-primary ">Back</a>
                <!-- /. ROW  -->
                
                <!-- /. ROW  -->
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
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
