
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
	<?php $classname=trim($_GET['class'],'"');
		echo$classname;?>
	</div>
	<div id='window'>
		<?php
include 'functions.php';
include 'constants.php';


//get all names and moodle ids for students in the class.
$query=(mysqli_query($con,"SELECT moodleid,username FROM classstudent INNER JOIN login ON classstudent.userid=login.userid INNER JOIN classlist ON classstudent.classid=classlist.classid  WHERE classname='".$classname."' ORDER BY username ASC"));
//init arrays
$names=array();
$ids=array();

//creates arrays

if ($result = $query) {
    //add each array item to list
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names,$row["username"]);
        array_push($ids,$row["moodleid"]);
    }
}


//call getprogress for the list of students and pass them the correct paramaters 
?>		
Unit 1
</br>
<?= getprogress($ids,$names,$unit1); ?>
</br>
Unit 2
</br>
<?= getprogress($ids,$names,$unit2); ?>
</br>
Unit 3
</br>
<?= getprogress($ids,$names,$unit3); ?>
</br>
Unit 7
</br>
<?= getprogress($ids,$names,$unit7); ?>
</br>
Unit 8
</br>
<?= getprogress($ids,$names,$unit8); ?>
</br>
Unit 17
</br>
<?= getprogress($ids,$names,$unit17); ?>
</br>
Unit 18
</br>
<?= getprogress($ids,$names,$unit18); ?>
</br>
Unit 20
</br>
<?= getprogress($ids,$names,$unit20); ?>
</br>
Unit 22
</br>
<?= getprogress($ids,$names,$unit22); ?>
</br>
Unit 28
</br>
<?= getprogress($ids,$names,$unit28); ?>
</br>
Unit 30
</br>
<?= getprogress($ids,$names,$unit30); ?>
</br>
Unit 31
</br>
<?= getprogress($ids,$names,$unit31); ?>
</br>
</div>
</div>
			

</div>

</body>
</html>

