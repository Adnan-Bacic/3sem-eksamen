<?php
session_start();

ob_start(); //fix for "Cannot modify header information error" only shows online
if(isset($_SESSION['uid']))
{
}
else
{
  header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
	<?php
	include 'includes/head.php';
	?>
</head>

<body>
	<div class="container-fluid">
		<?php
		// Initialize the session.
		// If you are using session_name("something"), don't forget it now!
		//session_start();

		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if ( ini_get( "session.use_cookies" ) ) {
			$params = session_get_cookie_params();
			setcookie( session_name(), '', time() - 42000,
				$params[ "path" ], $params[ "domain" ],
				$params[ "secure" ], $params[ "httponly" ]
			);
		}

		// Finally, destroy the session.
		session_destroy();
		?>
		<h2 class="text-center mt-3">Du er nu logget ud</h2>
	
		<div class="text-center">
			<a href="index.php"><button class="btn btn-primary">Gå tilbage til login siden</button></a>
		</div>
	</div>
</body>
</html>