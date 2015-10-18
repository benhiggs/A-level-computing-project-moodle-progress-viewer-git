<!DOCTYPE html>

<html>
<body>
	<link rel='stylesheet' type='text/css' href='btec.css'>

<div id='formactionwindow'>
		
		<div id='loginwindowimage'>
			
		</div>
		
		<div id='loginwindowformtop'>
		</div>

		<div id='loginwindowform'>
			This is your first login, welcome. Please enter your desired password below and proceed to login
			<form method="post" action='loginfunctions.php'>
				Password:</br>
				<input type="password" name="password1"></br>
				Re-enter password:</br>
				<input type="password" name="password2"></br>

				<input type="submit" name="firstlogin" value="Login">
				
			</form>			
			<?php
			session_start();

			//checks if error var exists, if not, creates a blank one to stop errors occuring below.

			 if (isset($_SESSION["error"])==False){
			 	$_SESSION["error"]=0;
		
			 }

			
			if ($_SESSION["error"]==3){
				echo '<span style="color: red">The passwords do not match up</span>';
			}
			?>
			
		</div>
			

</div>

</body>
</html>
