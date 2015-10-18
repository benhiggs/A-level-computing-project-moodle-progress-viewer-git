<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'constants.php';




if(isset($_POST['changepassword'])){

//take username and password from database and seperate them into seperate fields from array
$query= mysqli_query($con,"SELECT password FROM login WHERE username='".$_SESSION["username"]."'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
$dbpassword= $row["password"];

//checks if passwords are the same or match old ones
if ($_POST["currentpassword"] != $dbpassword or $_POST["currentpassword"] =='' or $_POST["newpassword"]=='' ){
	$_SESSION["error"]=5;
	$_SESSION["updated"]=False;
	header("Location:options.php");
}
elseif($_POST["currentpassword"] == $_POST["newpassword"]){
	$_SESSION["error"]=14;
	$_SESSION["updated"]=False;
	header("Location:options.php");
}
//adds password
else{
	mysqli_query($con,"UPDATE login SET password='".$_POST["newpassword"]."' WHERE username='".$_SESSION["username"]."'");
	$_SESSION["error"]=0;
	$_SESSION["updated"]=True;
	header("Location:options.php");
}
}











if(isset($_POST['addusertoclass'])){

$username=$_POST["username"];
$classname=$_POST["classlist"];

//check if username exists, if it does, continue
$query= mysqli_query($con,"SELECT username FROM login WHERE username='".$username."'");
$checkusername= mysqli_num_rows($query);
if($checkusername !=1) {
  $_SESSION["error"]=7;
  $_SESSION["addedtoclass"]=False;
  header("Location:options.php");
}

//check for user in class, check if fields are blank
else{
  $query=mysqli_query($con,"SELECT * FROM classstudent INNER JOIN login on login.userid=classstudent.userid WHERE username='".$username."'");
  $checkuser= mysqli_num_rows($query);
  if($checkuser !=0) {
  	$_SESSION["error"]=6;
  	$_SESSION["addedtoclass"]=False;
  	header('Location:options.php');
  }
  else{
    //get userid and classid and add student to class

  	$query=mysqli_query($con,"SELECT userid FROM login WHERE username='".$username."'");
  	$result=mysqli_fetch_assoc($query);
  	$userid=$result['userid'];

  	$query=mysqli_query($con,"SELECT classid FROM classlist WHERE classname='".$classname."'");
  	$result=mysqli_fetch_assoc($query);
  	$classid=$result['classid'];


  	$query= "INSERT INTO classstudent (userid,classid) VALUES ('$userid','$classid')";

  	if (mysqli_query($con,$query)) {
  		$_SESSION["error"]=0;
  		$_SESSION["addedtoclass"]=True;
  	header("Location:options.php");
  	}
  	}
  }
}









if(isset($_POST['promoteuser'])){

$username=$_POST["username"];

//check username esists, if not error given
$query= mysqli_query($con,"SELECT * FROM login WHERE username='".$username."'");
$checkusername= mysqli_num_rows($query);
if($checkusername !=1) {
	$_SESSION["error"]=10;
	$_SESSION["inserted"]=False;
	header("Location:options.php");
	
}
else{
	//checks if user has a teacherid, if this is true, the user is already a teacher
	$query=mysqli_query($con,"SELECT teacherid FROM login INNER JOIN teachers ON login.userid=teachers.userid WHERE username='".$username."'");
	$result=mysqli_fetch_assoc($query);
	$teacherid=$result['teacherid'];

	if ($teacherid){
		$_SESSION["error"]=9;
		$_SESSION["inserted"]=False;
		header("Location:options.php");
	}


  //otherwise add user to teachers table in DB
	else{
		$query=mysqli_query($con,"SELECT userid FROM login WHERE username='".$username."'");
		$result=mysqli_fetch_assoc($query);
		$userid=$result['userid'];


		$query=mysqli_query($con,"INSERT INTO teachers (userid) VALUES ($userid)");

		if ($query) {
			$_SESSION["error"]=0;
			$_SESSION["promoted"]=True;
			header("Location:options.php");

		}
	}
	}
}








if(isset($_POST['addnewuser'])){

$username=$_POST["username"];
$password=$_POST["password"];

//check for username in database, check if fields are blank, if they are fine, insert into DB
$query= mysqli_query($con,"SELECT * FROM login WHERE username='".$username."'");
$checkuser= mysqli_num_rows($query);
if($checkuser !=0) {
	$_SESSION["error"]=3;
	$_SESSION["inserted"]=False;
	header("Location:options.php");

}
else if($username=='' or $password==''){
	$_SESSION["error"]=4;
	$_SESSION["inserted"]=False;
	header("Location:options.php");
}
else{
	$query= "INSERT INTO login (username,password) VALUES ('$username','$password')";

	if (mysqli_query($con,$query)) {
		$_SESSION["error"]=0;
		$_SESSION["inserted"]=True;
	header("Location:options.php");
	}
}
}










if(isset($_POST['addnewclass'])){

$block=$_POST["block"];
$teacher=$_POST["teacher"];

$classname=($block.'-'.$teacher);

//checks if class exists by querying name, name is specific to class, teacher can have a single class in a specific block
$query= mysqli_query($con,"SELECT * FROM classlist WHERE classname='".$classname."'");
$checkclass= mysqli_num_rows($query);
if($checkclass !=0) {
	$_SESSION["error"]=8;
	$_SESSION["addednewclass"]=False;
	header("Location:options.php");
}

else{
  //if class doesnt exist, add class to database
	$query=mysqli_query($con,"SELECT teacherid FROM login INNER JOIN teachers on login.userid=teachers.userid WHERE username='".$teacher."'");
	$result=mysqli_fetch_assoc($query);
	$teacherid=$result['teacherid'];

	$query="INSERT INTO classlist (teacherid,classname) VALUES ('$teacherid','$classname')";

	if (mysqli_query($con,$query)) {
		$_SESSION["error"]=0;
		$_SESSION["addednewclass"]=True;
		header("Location:options.php");
	}
}
}













if(isset($_POST['removeclass'])){
$classname=$_POST["classnames"];
$classid=mysqli_fetch_Assoc(mysqli_query($con,"SELECT classid FROM classlist WHERE classname='".$classname."'"))['classid'];

//no validation required due to drop down list, so just delete

mysqli_query($con,"DELETE FROM classlist WHERE classname='".$classname."'");
mysqli_query($con,"DELETE FROM classstudent WHERE classid='".$classid."'");

$_SESSION["error"]=0;
    $_SESSION["deleted"]=True;
    header("Location:options.php");



}






















if(isset($_POST['removeuser'])){

$username=$_POST["username"];
$classname=$_POST["classlist"];

//check username exists
$query=mysqli_query($con,"SELECT * FROM login WHERE username='".$username."'");
$checkusername = mysqli_num_rows($query);
if($checkusername !=1) {
	$_SESSION["error"]=11;
	$_SESSION["removed"]=False;
	header("Location:options.php");
}
else{
	//select userid from query array
	$result=mysqli_fetch_assoc($query);
	$userid=$result['userid'];

  //check if user is a teacher
  $query=mysqli_query($con,"SELECT teacherid FROM teachers WHERE userid='".$userid."'");
    $teachercheck = mysqli_num_rows($query);
    if($teachercheck ==1) {
      $_SESSION["error"]=13;
      $_SESSION["removed"]=False;
      header("Location:options.php");
    }
    else{
  	//if noclass is set, check if they are in a class, if not delete, if so check for incorrect class
  	if ($classname == 'noclass'){
  		$query=mysqli_query($con,"SELECT * FROM classstudent WHERE userid='".$userid."'");
  		$checkuserinclass = mysqli_num_rows($query);
  		if($checkuserinclass ==0) {
  			mysqli_query($con,"DELETE FROM login WHERE username='".$username."'");
  			$_SESSION["error"]=0;
  			$_SESSION["removed"]=True;
  			header("Location:options.php");
        }
      else{
          $_SESSION["error"]=12;
          $_SESSION["removed"]=False;
          header("Location:options.php");
        }
  		}
      
    //if class is given skip checks when no class is given and just check if teacher/for incorrect class/delete
    else{
  			$query= mysqli_query($con,"SELECT classname FROM classstudent INNER JOIN login on classstudent.userid=login.userid INNER JOIN classlist on classstudent.classid=classlist.classid WHERE username='".$username."'");
  			$result=mysqli_fetch_assoc($query);
  			$dbclassname=($result['classname']);

  			if ($dbclassname!=$classname){
  				$_SESSION["error"]=12;
  				$_SESSION["removed"]=False;
  				header("Location:options.php");
  			}
  			else{
  				mysqli_query($con,"DELETE FROM login WHERE username='".$username."'");
  				mysqli_query($con,"DELETE FROM classstudent WHERE userid='".$userid."'");
  				$_SESSION["error"]=0;
  				$_SESSION["removed"]=True;
  				header("Location:options.php");
  			}
  		}
	 }
  }
}
















function convert($res){

  //function converts score on grade taken from moodle and makes it a common, readable grade

  if ($res==7.00000){
    $res='<span style="color: green">Pass</span>';
  }
  elseif ($res==6.00000){
    $res='<span style="color: red">Not pass - Resubmit</span>';
  }
  elseif($res==5.00000){
    $res='<span style="color: green">Merit</span>';
  }
  elseif($res==4.00000){
    $res='<span style="color: red">Not merit - Resubmit</span>';
  }
  elseif($res==3.00000){
    $res='<span style="color: green">Distinction</span>';
  }
  elseif($res==2.00000){
    $res='<span style="color: red">Not distinction - Resubmit</span>';
  }
  elseif($res==1.00000){
    $res='<span style="color: red">No work submitted</span>';
  }
  elseif($res==0){
    $res='<span style="color: red">No work submitted</span>';
  }
  return$res;
}









function getprogress($ids,$names,$u){
//function gets the progress for each user in a given array and for a given unit

include'constants.php';

//structure table
?>
<table class='generaltables'>
  <tr>
    <td>User</td>
    <td>p1</td>
    <td>p2</td>
    <td>p3</td>
    <td>p4</td>
    <td>p5</td>
    <td>p6</td>
    <td>p7</td>
    <td>p8</td>
    <td>m1</td>
    <td>m2</td>
    <td>m3</td>
    <td>d1</td>
    <td>d2</td>
  </tr>
<?php

$listpos=0;

//each row for each student
foreach ($names as $c =>  $name) {
  //checks for enrollment key of student on moodle database
  if(mysqli_num_rows(mysqli_query($conmoodle,"SELECT * FROM mdl_grade_grades WHERE userid='".$ids[$c]."' AND itemid='".$u[0]."'"))==1){
    echo  "<tr>"."<td>".$name."</td>";

    foreach($u as $k => $item){
        //starts at first position instead of zero because zero is enrolment key.
        if ($k<1) continue;
        echo("<td>".convert(mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade FROM mdl_grade_grades WHERE userid='".$ids[$listpos]."' AND itemid='".$item."'"))["finalgrade"])."</td>");
    
    }
    echo  "<tr>";
  }
    $listpos++;
}
?>
</table>

<?php 
}








function showtable($u)
//function gets the progress for a given student across each assignment on a unit of work
{
include'constants.php';
//list of queries and stored data
//p1
$p1query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[1]."' AND userid='".$_SESSION["moodleid"]."'"));
$p1=convert($p1query["finalgrade"]);
$fp1=$p1query["feedback"];
//p2
$p2query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[2]."' AND userid='".$_SESSION["moodleid"]."'"));
$p2=convert($p2query["finalgrade"]);
$fp2=$p2query["feedback"];
//p3
$p3query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[3]."' AND userid='".$_SESSION["moodleid"]."'"));
$p3=convert($p3query["finalgrade"]);
$fp3=$p3query["feedback"];
//p4
$p4query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[4]."' AND userid='".$_SESSION["moodleid"]."'"));
$p4=convert($p4query["finalgrade"]);
$fp4=$p4query["feedback"];
//p5
$p5query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[5]."' AND userid='".$_SESSION["moodleid"]."'"));
$p5=convert($p5query["finalgrade"]);
$fp5=$p5query["feedback"];
//p6
$p6query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[6]."' AND userid='".$_SESSION["moodleid"]."'"));
$p6=convert($p6query["finalgrade"]);
$fp6=$p6query["feedback"];
//p7
$p7query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[7]."' AND userid='".$_SESSION["moodleid"]."'"));
$p7=convert($p7query["finalgrade"]);
$fp7=$p7query["feedback"];
//p8
$p8query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[8]."' AND userid='".$_SESSION["moodleid"]."'"));
$p8=convert($p8query["finalgrade"]);
$fp8=$p8query["feedback"];
//m1
$m1query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[9]."' AND userid='".$_SESSION["moodleid"]."'"));
$m1=convert($m1query["finalgrade"]);
$fm1=$m1query["feedback"];
//m2
$m2query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[10]."' AND userid='".$_SESSION["moodleid"]."'"));
$m2=convert($m2query["finalgrade"]);
$fm2=$m2query["feedback"];
//m3
$m3query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[11]."' AND userid='".$_SESSION["moodleid"]."'"));
$m3=convert($m3query["finalgrade"]);
$fm3=$m3query["feedback"];
//m1
$d1query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[12]."' AND userid='".$_SESSION["moodleid"]."'"));
$d1=convert($d1query["finalgrade"]);
$fd1=$d1query["feedback"];
//m1
$d2query=mysqli_fetch_assoc(mysqli_query($conmoodle,"SELECT finalgrade,feedback FROM mdl_grade_grades WHERE itemid='".$u[13]."' AND userid='".$_SESSION["moodleid"]."'"));
$d2=convert($d2query["finalgrade"]);
$fd2=$d2query["feedback"];

//now create table and add data to cells
?>
  </br>
  </br>
  </br>

  	<table class='generaltables' >
  	<tr>
        <td width="10%"><b>Assigment</b></td>
        <td width="20%"><b>Progress</b></td>
        <td width="40%"><b>Feedback</b></td>
      </tr>
      <tr>
        <td>p1</td>
        <td><?=$p1?></td>
        <td><em><?=$fp1?></em></td>
      </tr>
      <tr>
        <td>p2</td>
        <td><?=$p2?></td>
        <td><em><?=$fp2?></em></td>
      </tr>
      <tr>
        <td>p3</td>
        <td><?=$p3?></td>
        <td><em><?=$fp3?></em></td>
      </tr>
      <tr>
        <td>p4</td>
        <td><?=$p4?></td>
        <td><em><?=$fp4?></em></td>
      </tr>
      <tr>
        <td>p5</td>
        <td><?=$p5?></td>
        <td><em><?=$fp5?></em></td>
      </tr>
      <tr>
        <td>p6</td>
        <td><?=$p6?></td>
        <td><em><?=$fp6?></em></td>
      </tr>
      <tr>
        <td>p7</td>
        <td><?=$p7?></td>
        <td><em><?=$fp7?></em></td>
      </tr>
      <tr>
        <td>p8</td>
        <td><?=$p8?></td>
        <td><em><?=$fp8?></em></td>
      </tr>
      <tr>
        <td>m1</td>
        <td><?=$m1?></td>
        <td><em><?=$fm1?></em></td>
      </tr>
      <tr>
        <td>m2</td>
        <td><?=$m2?></td>
        <td><em><?=$fm2?></em></td>
      </tr>
      <tr>
        <td>m3</td>
        <td><?=$m3?></td>
        <td><em><?=$fm3?></em></td>
      </tr>
      <tr>
        <td>d1</td>
        <td><?=$d1?></td>
        <td><em><?=$fd1?></em></td>
      </tr>
      <tr>
        <td>d2</td>
        <td><?=$d2?></td>
        <td><em><?=$fd2?></em></td>
      </tr>
      
    </table>

<?php
//small progress table overview, determines each piece of work and if it has been completed

$passes=[$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8];
$p=0;
foreach ($passes as $current){
  if ($current=='<span style="color: green">Pass</span>'){
    ++$p;
  }
}

$merits=[$m1,$m2,$m3];
$m=0;
foreach ($merits as $current){
  if ($current=='<span style="color: green">Merit</span>'){
    ++$m;
  }
}

$distinctions=[$d1,$d2];
$d=0;
foreach ($distinctions as $current){
  if ($current=='<span style="color: green">Distinction</span>'){
    ++$d;
  }



if ($p==8){
  $total='a Pass';
  if ($m==3){
    $total='a Merit';
    if ($d==2){
      $total='a Distinction';
    }
  }
}
else{
$total='no grade';
}
}

//print out table
?>
</br></br></br></br>
Your progress across this unit stands at:
</br>(assignment criteria met)
</br></br>
<table border="0" width='150px'>
  <tr>
    <td>Pass</td>
    <td width='5%'><?=$p?></td>
    <td width='5%'>/8</td>
  </tr>
  <tr>
    <td>Merit</td>
    <td><?=$m?></td>
    <td>/3</td>
  </tr>
  <tr>
    <td>Distinction</td>
    <td><?=$d?></td>
    <td>/2</td>
  </tr>
</table>
</br>
You have achieved <?=$total?> across this unit!


<?php
}






if(isset($_GET['logout'])==True){
  //deletes all session data when logout is selected
unset($_SESSION); 
header('Location:login.php');
}
  //deletes all errors when options is selected
if(isset($_GET['options'])==True){
$_SESSION["error"]=0; 
header('Location:options.php');
}


?>

