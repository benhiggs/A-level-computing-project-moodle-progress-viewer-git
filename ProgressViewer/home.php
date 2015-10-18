<!DOCTYPE html>

<html>
<body>
	<link rel='stylesheet' type='text/css' href='btec.css'>

<div id='actionwindow'>
	<div id='titlebar'>
		Welcome <?php session_start(); echo ($_SESSION["username"]); ?>
	</div>
	<div id='imagebar'>
		<?php
		include 'menuoptions.php';
		?>
	</div>
	<div id='window'>
<?php 
if ($_SESSION['admin']==True){
	if ($_SESSION['username']==$headofsubject or $_SESSION['username']==$admin){

		//prints out Admin/HOS homepage layout
		
	?>
Welcome to the Collyers IT BTEC progress viewer. From here you can view progress of each student across the year group.
</br>
</br>
To use the system make sure all of the students have enrolled on the courses on the <a href="http://moodle.collyers.ac.uk" target="_blank">Collyers VLE</a> that they will take part in during the course of this year.
</br>
</br>
All criteria for each unit can be found on the <a href="http://collyerstudent.biz/" target="_blank">CollyersStudent.biz</a> site.
</br>
</br>
When assisiting students on their first login, remind them that for first login, they must leave the password field blank and as long as they are using their correct college login, will be taken to a first login page.
</br>
</br>
As the head of subject or administrator you have many privileges that teachers and students do not. 
<table border="0" cellspacing="10px">
<tr>
	<td width=50%>
		<ul>
		<li>Adding new users is simple. simply enter the new username and the temporary password then submit.
		</br>However on first login, reffer students to the first login procedre. Teachers will need to be entered manually.
		</br>When removing users simply enter the username and the class they are in.
		</br><img src="newuser.png" height="150" width="150"><img src="removeuser.png" height="150" width="150"></li>
		</ul>
	</td>

	<td width=50%>
		<ul>
		<li>Class management is also a privilege of Admin/Headofsubject. To create a class select the teacher and the block.
		</br>To remove a class simply select the class to delete.
		</br>To add users to a class, enter the username of the student and the class they will be in. This will add them to class views.
		</br><img src="newclass.png" height="150" width="125"><img src="removeclass.png" height="150" width="125"><img src="usertoclass.png"  height="150" width="150"></li>
		</ul>
	</td>
</tr>

</table>


<?php
	}
	else{

		//otherwise print out teacher homepage, because $admin determines if the user has more privileges than a student

	?>
Welcome to the Collyers IT BTEC progress viewer. From here you can view progress of each student that you teach across all units arranged via class.
</br>
</br>
To use the system make sure all of the students have enrolled on the courses on the <a href="http://moodle.collyers.ac.uk" target="_blank">Collyers VLE</a> that they will take part in during the course of this year.
</br>
</br>
All criteria for each unit can be found on the <a href="http://collyerstudent.biz/" target="_blank">CollyersStudent.biz</a> site.
</br>
</br>
As a teacher you may only view your classes progress, the head of year has the required permissions to manage users and classes. 
</br>
</br>
Contact the head of subject or administrator for the system about setting up classes.
</br>
</br>
When assisiting students on their first login, remind them that for first login, they must leave the password field blank and as long as they are using their correct college login, will be taken to a first login page.



<?php } ?>
<table border="0" cellspacing="10px">
<tr>
	<td width=50%>
		<ul>
		<li>To change your password for the system, choose the options tab and simply enter your old and new passwords.
		</br><img src="password.png"  height="150" width="150"></li>
		</ul>
	</td>
	<td width=50%>
		<ul>
		<li>Viewing class progress is structured like below. 
		</br><img src="classprogress.png"  height="100" width="500"></li>
		</ul>
	</td>
</tr>

</table>
<?php }

 else

//print out student homepage

 	{ ?>
Welcome to the Collyers College IT BTEC progress viewer. From here you can view your progress across all units of work on the course.
</br>
</br>
To be able to use this system efficently, make sure to enrol on the courses on the <a href="http://moodle.collyers.ac.uk" target="_blank">Collyers VLE</a> that you will take part in during the course of this year.
</br>
</br>
This system is linked directly with the moodle, so as your work is updated and graded on there, you will be able to see a collective of all your progress across each specific unit and also see your feedback and current grade.
</br>
</br>
All criteria for each unit can be found on the <a href="http://collyerstudent.biz/" target="_blank">CollyersStudent.biz</a> site.
</br>
</br>
How to use this site:
</br>
<table border="0" cellspacing="10px">
<tr>
	<td width=50%>
		<ul>
		<li>Using this site is very simple. Each unit is displayed down the side panel to your left.
		</br><img src="sidepanelstudent.png" alt="sidepanel" height="250" width="100"></li>
		</ul>
	</td>

	<td width=50%>
		<ul>
		<li>Select the unit you wish to view your progess for. This should then present you with a view such as this one below. </br> It clearly shows progress, feedback and your overall grade.
		</br><img src="unitview.png" alt="sidepanel" height="250" width="250"></li>
		</ul>
	</td>
</tr>
<tr>
	<td width=50%>
		<ul>
		<li>To change your password for the system, choose the options tab and simply enter your old and new passwords.
		</br><img src="password.png" alt="sidepanel" height="175" width="175"></li>
		</ul>
	</td>
<!--
	<td width=50%>
		I hope this system makes it easy for you to view your progress in one simple place.</br> Thanks for using. </br> Ben Higgs (developer).
		
	</td>
--> 
</tr>

</table>

<?php } ?>




	</div>
			
</div>
			

</div>

</body>
</html>
