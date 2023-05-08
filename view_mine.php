<?php
require 'core/init.php';
$general->logged_out_protect();

$user_id  = htmlentities($user['id']);

$selec = $chartforum->view_resolved($user_id);
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
                     <h2>View Your Calls Status</h2>   
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             View All Calls Below 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Call ID</th>
                                            <th>Root Cause</th>
                                            <th>Closed By</th>
                                            <th>Closed Date</th>
                                            <th>Status</th>
                                            <th>Solution Desription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($selec as $row) {?>
                                          <tr>
                                          <td><?php echo $row['callNum'];?></td> 
                                          <td><?php echo $row['similar'];?></td> 
                                          <td><?php echo $row['name'];?></td> 
                                          <td><?php echo $row['closedDate'];?></td>
                                          <td><?php echo $row['status'];?></td>
                                          <td><?php echo $row['description'];?></td>
                                          </tr> 
                                      <?php }?>
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
             <a href="index.php" class="btn btn-primary ">Back</a>
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
