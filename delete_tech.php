<?php 
error_reporting(E_ALL);

require '/core/init.php';
$general->logged_out_protect();

$user_id = $_GET['t_id'];

$deltechnician = $chartforum->delete_users($user_id);

header('Location:view_techs.php');

?>