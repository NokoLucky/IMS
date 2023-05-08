<?php 
require 'core/init.php';
$general->logged_out_protect();

$c_id       = $_GET['c_id'];
$dd         = date('Y-m-d');



if(isset($_POST['submit']))
{
   $name         = htmlentities($_POST['name']);
   $d_id         = htmlentities($_POST['d_id']);
   $priority     = htmlentities($_POST['priority']);
   $similar      = htmlentities($_POST['similar']);
   $description  = htmlentities($_POST['description']);


$insert = $chartforum->update_call($user_id, $callNum, $name, $d_id, $priority, $similar, $description, $dd, $c_id);
  echo '<script>"alert(call Successfully logged, please wait for a response soon!)"</script>';
  header('Location: index.php');
}

$depts  = $chartforum->departments();
$call = $chartforum->view_callto_edit($c_id);
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
font-size: 16px;"> Last account activity : <?php echo date('H:i');?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a></div>
        </nav>   
          
        <!-- /. NAV SIDE  -->
        
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Log A Call Below</h2>   
                        <h5> </h5>
                    </div>
                </div>
               
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Your Call Information Below
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<form role="form" name="myForm" action="" method="POST">
              <?php foreach($call as $rw) { ?>
                                <div class="col-md-6">
                                    <h3>General Data</h3>
                                     
                                      
                                        <fieldset disabled="disabled">
                                            <div class="form-group">
                                                <label for="disabledSelect">ID</label>
                                                <input class="form-control" id="disabledInput" type="text" name="callNum" Value="<?php echo $rw['callNum'];?>" disabled />
                                            </div>                                   
                                        </fieldset>
										
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" Value="<?php echo $rw['name'];?>" required="required" />
                                        </div>
                                        
										<div class="form-group">
                                            <label>Call Type</label>
                                            <select class="form-control" name="d_id">
											     <option value="<?php echo $rw['d_id'];?>">  <?php echo $rw['d_id'];?></option>                    
												 
                                            </select>
                                        </div>
                                        
                                  
                                </div>
                                
                                <div class="col-md-6">
                                    <h3>Category</h3>
                                   <div class="form-group">
                                            <label>Priority</label>
                                            <select class="form-control" name="priority">
                                            <option><?php echo $rw['priority'];?></option>
                                                <option>1: High</option>
                                                <option>2: Medium</option>
                                                <option>3: Low</option>
                                            </select>
                                        </div>
                                    
									             <h3>Relationship</h3>
                                    <hr/>
                                    <div class="form-group">
                                            <label>Related Problem</label>
                                            <input class="form-control" type="text" name="similar" Value="<?php echo $rw['similar'];?>" required="required" />
                                        </div>
                                   
                                </div>
								
								<div class="col-md-12">
								      <div class="form-group">
                                            <label>Problem Description</label>
                                            <textarea class="form-control" name="description" Value="<?php echo $rw['description'];?>" rows="5" required="required"></textarea>
                                        </div>
										<button type="submit" name="submit" class="btn btn-primary">Submit Data</button>
										
								</div>
            <?php } ?>
							 </form>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
            <a href="index.php" class="btn btn-primary ">Back</a>
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
