<?php
session_start();

include'constants.php';



if(isset($_POST['login'])){
//convert post data to session data
$_SESSION["username"]=$_POST["username"];

//checks for teacherid to determine where to send user
$query=mysqli_query($con,"SELECT teacherid FROM login INNER JOIN teachers ON login.userid=teachers.userid WHERE username='".$_SESSION["username"]."'");
$checkres=mysqli_num_rows($query);

//teachers are assigned 'admin' var as being true

if($checkres ==1) {
	$_SESSION["admin"]=True;
	
}
else{
	$_SESSION["admin"]=False;
}


//if username is blank, error message on homepage if it isnt, check username and passwords against db
if ($_SESSION["username"] ==''){
	$_SESSION["error"]=1;
   	header('Location:login.php');
}
else{

$query= mysqli_query($con,"SELECT * FROM login WHERE username='".$_SESSION['username']."'");

//check for username in database
$checkuser= mysqli_num_rows($query);

if($checkuser != 1) {
//check in moodle database for user
   $moodleusernamelookup=mysqli_query($conmoodle,"SELECT id,username FROM mdl_user WHERE username='".$_SESSION['username']."'");
   $checkusermoodle= mysqli_num_rows($moodleusernamelookup);

   if($checkusermoodle !=1){
   	$_SESSION["error"]=1;
   header('Location:login.php');
   }
   else{
//take moodleid and moodleusername from moodle db
	$moodleusernamelookup=mysqli_query($conmoodle,"SELECT id,username FROM mdl_user WHERE username='".$_SESSION['username']."'");
	$result=mysqli_fetch_assoc($moodleusernamelookup);
	$moodleid=$result['id'];
	$_SESSION['moodleid']=$moodleid;
	$moodlename=$result['username'];


	mysqli_query($con,"INSERT INTO login (username,moodleid) VALUES ('".$_SESSION["username"]."','$moodleid')");
	header('Location:firstlogin.php');
	}   
 }

//take username and password from database and seperate them into seperate fields from array
$row = mysqli_fetch_assoc($query);
$dbusername= $row["username"];
$dbpassword= $row["password"];
$_SESSION["moodleid"]= $row["moodleid"];


//check username and password against database ones
if ($_SESSION['username'] == $dbusername and $_POST["password"] == $dbpassword){
	$_SESSION["error"]=0;


	header('Location:home.php');

}
//if pw is incorrect ser error
else if ($_POST["password"]!=$dbpassword){
	$_SESSION["error"]=2;
	header('Location:login.php');
}
}
}







if(isset($_POST['firstlogin'])){

//for first login students asked to set a password, fields below must match, if they do the password is added ot the database.

session_start();
include'constants.php';

$pass1=$_POST["password1"];
$pass2=$_POST["password2"];
$user=$_SESSION["username"];

if ($pass1==$pass2){
	mysqli_query($con,"UPDATE login SET password='$pass1' WHERE username='".$user."'");
	$_SESSION["error"]=0;
	header('Location:home.php');
}
else{
	$_SESSION["error"]=3;
	header('Location:firstlogin.php');
}
}
?>