<html>
<STYLE type="text/css">
a.links:link {color: #ffffff;text-decoration:none;}
a.links:visited {color: #ffffff;text-decoration:none;}
a.links:hover {color:red;text-decoration:underline;}
</STYLE>
<?php

echo"<a class='links' href='home.php'> Home</a></br>";

if ($_SESSION["admin"]==True){

	include 'constants.php';
		$query= mysqli_query($con,"SELECT classname FROM classlist WHERE classname LIKE '%".$_SESSION['username']."%'");

	//if head of subject or admin, show all classes.

		if ($_SESSION['username']==$headofsubject or $_SESSION['username']==$admin){
			$query= mysqli_query($con,"SELECT classname FROM classlist");
		}
		$row = mysqli_fetch_all($query);
						
		foreach($row as $value){
	// prints classnames into menu options
		echo '<a class="links" href=classview.php?class="'.$value[0].'"">';
		echo $value[0];
		echo '</a>';
		echo '</br>';		
		}
}
//print out links for students homepage
else{
	echo"<a class='links' href=unitview.php?unit=unit1> Unit 1</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit2> Unit 2</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit3> Unit 3</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit7> Unit 7</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit8> Unit 8</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit17> Unit 17</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit18> Unit 18</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit20> Unit 20</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit22> Unit 22</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit28> Unit 28</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit30> Unit 30</a></br>";
	echo"<a class='links' href=unitview.php?unit=unit31> Unit 31</a></br>";		
}

	echo"<a class='links' href=functions.php?options=True> Options</a></br>";
	echo"<a class='links' href=functions.php?logout=True> Logout</a></br>";
?>
</html>