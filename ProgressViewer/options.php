<!DOCTYPE html>

<html>
<body>
	<link rel='stylesheet' type='text/css' href='btec.css'>

<div id='actionwindow'>
	<div id='titlebar'>
		Options for  <?php session_start(); echo($_SESSION["username"]);?>
	</div>
	<div id='imagebar'>
		<?php
		include 'menuoptions.php';
		?>
	</div>
	<div id='window'>

		<table class='options' >


<tr>
				<td>
				</br>Change password:</br>
				<form method="post" action='functions.php'>
				</br>Current password:</br>
				<input type="password" name="currentpassword"></br>
				New password:</br>
				<input type="password" name="newpassword"></br>

				<input type="submit" name="changepassword" value="Change password">
				
			</form>
			<?php
				
				if ($_SESSION["error"]==5){
					echo '<span style="color: red">Password is incorrect</span>';
				}

				if ($_SESSION["error"]==14){
					echo '<span style="color: red">This is the current password</span>';

				}
				if (isset($_SESSION["updated"])){
					if ($_SESSION["updated"]==True){
						echo '<span style="color: green">Password changed</span>';
						$_SESSION['updated']=False;
						}
				}	

			?>
			</td>

<?php
include 'constants.php';
if ($_SESSION['username']==$headofsubject or $_SESSION['username']==$admin){
?>


<td>			</br>Promote to teacher:</br>
				<form method="post" action='functions.php'>
				</br>Username (college login):</br>
				<input type="text" name="username"></br>
				

				<input type="submit" name="promoteuser" value="Promote to teacher"></br>
			</form>

			<?php
				
				if ($_SESSION["error"]==9){
					echo '<span style="color: red">This user is already a teacher</span>';

				}
				if ($_SESSION["error"]==10){
					echo '<span style="color: red">Incorrect username</span>';

				}
				if (isset($_SESSION["promoted"])){
					if ($_SESSION["promoted"]==True){
						echo '<span style="color: green">User promoted</span>';
						$_SESSION['promoted']=False;
					}

				}			
			?>
			</td>

			<td>
				</br>Create a class:</br>
				<form method="post" action="functions.php">
					</br>Block:  Teacher:</br>
					<select name="block">
						<option value='A'>A</option>
						<option value='B'>B</option>
						<option value='C'>C</option>
						<option value='D'>D</option>
						<option value='E'>E</option>
						<option value='F'>F</option>
						<option value='G'>G</option>
					</select>

					<select name="teacher">
						<?php 
						include 'connection.php';
						$query= mysqli_query($con,"SELECT username FROM teachers JOIN login ON teachers.userid=login.userid");
						$row = mysqli_fetch_all($query);
						
						foreach($row as $value){
						 // prints classnames into the dropdown box
							print '<option value=';
							print $value[0];
							print '>';
							print $value[0];
							print'</option>';					
						}
						?>
					</select>
					

					</br>

					<input type="submit" name="addnewclass" value="Add new class">
				
				</form>

			<?php
				
				if ($_SESSION["error"]==8){
					echo '<span style="color: red">This class already exists</span>';

				}
				
				if (isset($_SESSION["addednewclass"])){
					if ($_SESSION["addednewclass"]==True){
						echo '<span style="color: green">Class added</span>';
						$_SESSION['addednewclass']=False;
					}

				}			
			?>
			</td>




<td>	

			</br>Remove class</br>
				<form method="post" action='functions.php'>
				</br>Class to remove:</br>
				<select name="classnames">
					<?php
						$query= mysqli_query($con,"SELECT classname FROM classlist");
						$row = mysqli_fetch_all($query);
						
							foreach($row as $value){
							 // prints classnames into the dropdown box
								print '<option value=';
								print $value[0];
								print '>';
								print $value[0];					
							}
					?>
					</select></br>

				<input type="submit" name="removeclass" value="Remove class">
				
			</form>
			<?php
				if (isset($_SESSION["deleted"])){
					if ($_SESSION["deleted"]==True){
						echo '<span style="color: green">Class removed</span>';
						$_SESSION['deleted']=False;
						}
				}	

			?>


</td>
</tr>
<tr>




				<td>
				</br>Add new user:</br>
				<form method="post" action='functions.php'>
				</br>New username (college login):</br>
				<input type="text" name="username"></br>
				New password:</br>
				<input type="password" name="password"></br>

				<input type="submit" name="addnewuser" value="Add new user"</br>
			</form>

			<?php
				
				if ($_SESSION["error"]==3){
					echo '<span style="color: red">This user already exists</span>';

				}
				if ($_SESSION["error"]==4){
					echo '<span style="color: red">Cannot have a blank field</span>';

				}
				if (isset($_SESSION["inserted"])){
					if ($_SESSION["inserted"]==True){
						echo '<span style="color: green">User added</span>';
						$_SESSION['inserted']=False;
					}

				}			
			?>

			</td>




				
<td>				

				</br>Remove user</br>
				<form method="post" action='functions.php'>
				</br>Username (college login):</br>
				<input type="text" name="username"></br>
				Class:</br>
				<select name="classlist">
					<option value='noclass'>Class not yet assigned</option>
						<?php 
						include 'connection.php';
						$query= mysqli_query($con,"SELECT classname FROM classlist");
						$row = mysqli_fetch_all($query);
						
						foreach($row as $value){
						 // prints classnames into the dropdown box
							print '<option value=';
							print $value[0];
							print '>';
							print $value[0];					
						}
						?>
					</select></br>

				<input type="submit" name="removeuser" value="Remove user">
				
			</form>
			<?php
				
				if ($_SESSION["error"]==11){
					echo '<span style="color: red">Incorrect username</span>';

				}
				if ($_SESSION["error"]==13){
					echo '<span style="color: red">Cannot remove a teacher, contact IT support</span>';

				}
				if ($_SESSION["error"]==12){
					echo '<span style="color: red">Incorrect class</span>';

				}
				if (isset($_SESSION["removed"])){
					if ($_SESSION["removed"]==True){
						echo '<span style="color: green">User removed</span>';
						$_SESSION['removed']=False;
						}
				}	

			?>
			
			</td>

			<td>
				</br>Add user to class:</br>
				<form method="post" action='functions.php'>
				</br>Username (college login):</br>
				<input type="text" name="username"></br>
				Class:</br>
				<select name="classlist">
						<?php 
						include 'connection.php';
						$query= mysqli_query($con,"SELECT classname FROM classlist");
						$row = mysqli_fetch_all($query);
						
						foreach($row as $value){
						 // prints classnames into the dropdown box
							print '<option value=';
							print $value[0];
							print '>';
							print $value[0];					
						}
						?>
					</select>
					

				</br>

				<input type="submit" name="addusertoclass" value="Add user to class">
				
				</form>
			<?php
				
				if ($_SESSION["error"]==6){
					echo '<span style="color: red">User already in a class</span>';

				}
				if ($_SESSION["error"]==7){
					echo '<span style="color: red">Incorrect username</span>';

				}
				if (isset($_SESSION["addedtoclass"])){
					if ($_SESSION["addedtoclass"]==True){
						echo '<span style="color: green">Added to class</span>';
						$_SESSION['addedtoclass']=False;
					}

				}	

				?>
			</td>
</tr>


<?php
}
?>

</table>

				


		</div>
		

			
</div>
			

</body>
</html>
