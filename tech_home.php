<?php 
require 'core/init.php';
$general->logged_out_protect();

$user_id  = htmlentities($user['id']);
//$name     = htmlentities($user['name']);

$select = $chartforum->select_user_techs($user_id);
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
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">IMS Technician</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last account activity : <?php echo date('H:i');?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a class="active-menu"  href="tech_home.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a  href="view_assigned.php"><i class="fa fa-phone fa-3x"></i>View Assigned Incident</a>
                    </li>
                     <li >
                        <a   href="calls.php"><i class="fa fa-table fa-3x"></i>Resolve Incidents</a>
                    </li>
				    <li >
                        <a   href="escalate_call.php"><i class="fa fa-plus fa-3x"></i>Escalate Incident</a>
                    </li>					
					 <li>
                        <a   href="logout.php"><i class="fa fa-bolt fa-3x"></i>LogOut</a>
                    </li>	                   
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i>Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="view_assigned.php">View Assigned Incident</a>
                            </li>
                            <li>
                                <a href="calls.php">Resolve Incidents</a>
                            </li>
							<li>
							<a href="escalate_call.php">Escalate Incident</a>
							 </li>
                        </ul>  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Technician Dashboard</h2> 
                     <?php foreach ($select as $key) { ?>
                        <h4>Welcome <?php echo $key['name']; ?>, Its great to see you. </h4>
                         <?php } ?> 
                    </div>
                </div>              
                
                 <!-- /. ROW  -->
                <hr />                
               
     
                 <!-- /. ROW  -->
                 <div class="row" >
                    <div class="col-md-3 col-sm-12 col-xs-12">
  <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-comments-o fa-5x"></i>
                            <h4>Lets Chat About It </h4>
                             <h4>Communication channel  </h4>
                        </div>
                        <div class="panel-footer back-footer-green">
                             <i class="fa fa-rocket fa-5x"></i>
                            This application helps users with checking logged calls and resolving them, they can also log calls themselves!
                            
                        </div>
                    </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">
               
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel back-dash">
                               <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; SPEED</strong>
                             <p class="text-muted">come log an incident with us and get it fixex within 15 minutes of logging it, we have technicians who are specially trainned to be of assisntant to you. </p>
                        </div>
                       
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 ">
                        <div class="panel ">
          <div class="main-temp-back">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i>Polokwane City </div>
                <div class="col-xs-6">
                  <div class="text-temp"> 15° </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
                     <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-desktop"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Display</p>
                    <p class="text-muted">Looking Good</p>
                </div>
             </div>
            
    </div>
                    
                    </div>
                </div>
                 <!-- /. ROW  -->
  
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
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
