

<!DOCTYPE html>

<html>
<body>
	<link rel='stylesheet' type='text/css' href='btec.css'>

<div id='actionwindow'>
	<div id='imagebar'>
		<?php
		session_start();
		include 'menuoptions.php';
		?>
	</div>
	<div id='titlebar'>
		<?php echo ($_SESSION["username"])."'s ".($_GET['unit'])."  progress";;?>
	</div>
	<div id='window'>
<?php

include'constants.php';
include'functions.php';


//convert contents of variable to the corresponding list.
$unit=$$_GET['unit'];

//checks if user actually enrolled on course, if not, say that they havent enrolled on course

$query=mysqli_query($conmoodle,"SELECT * FROM mdl_grade_grades WHERE itemid='".$unit[0]."' AND userid='".$_SESSION["moodleid"]."'");
$checkuser= mysqli_num_rows($query);

if($checkuser !=1) {
  echo('</br>'.'</br>'.'You have not yet enrolled on this course, if you wish to view progress here, enroll first on the moodle');
}
else{

showtable($unit);



}
?>
	</div>
			

			

</div>

</body>
</html>
