<?php
//set time for execution as longer if the server is slow
ini_set('max_execution_time', 300);

//connections for the database BTEC and MOODLEs
$con=mysqli_connect("localhost","root","","btec");

if (mysqli_connect_errno($con))
 {
  echo "Failed to connect: " . mysqli_connect_error();
 }

$conmoodle=mysqli_connect("localhost","root","","moodle");

if (mysqli_connect_errno($conmoodle))
 {
  echo "Failed to connect: " . mysqli_connect_error();
 }

//list of key users that cannot be changed in database for security reasons
$headofsubject='DCD';
$admin='Admin';

//id list for objects on moodle database
$unit1=[1,2,3,4,5,6,7,8,9,10,11,12,13,14];
$unit2=[15,16,17,18,19,20,28,21,22,23,24,25,26,27];
$unit3=[0];
$unit7=[0];
$unit8=[0];
$unit17=[0];
$unit18=[0];
$unit20=[0];
$unit22=[0];
$unit28=[0];
$unit30=[0];
$unit31=[0];



 ?>

 