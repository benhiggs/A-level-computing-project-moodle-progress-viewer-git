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
			<form method="post" action='loginfunctions.php'>
				Login:</br>
				<input type="text" name="username"></br>
				Password:</br>
				<input type="password" name="password"></br>

				<input type="submit" name="login" value="Login">
				
			</form>

			<?php
			session_start();

			//checks if error var exists, if not, creates a blank one to stop errors occuring below.

			 if (isset($_SESSION["error"])==False){
			 	$_SESSION["error"]=0;
		
			 }

			
			if ($_SESSION["error"]==1){
				echo '<span style="color: red">You entered an incorrect username</span>';
			}
			else if ($_SESSION["error"]==2){
				echo'<span style="color: red">You entered an incorrect password</span>';
			}
			?>
			
			
		</div>
			

</div>

</body>
</html>
