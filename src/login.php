<?php
session_start();

ob_start(); //fix for "Cannot modify header information error" only shows online
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
			$un = filter_input( INPUT_POST, 'un' )or die( 'Missing or illegal un parameter' );
			$pw = filter_input( INPUT_POST, 'pw' )or die( 'Missing or illegal pw parameter' );


			require_once( 'database-connect/dbcon.php' );

			$sql = 'SELECT id, pwhash, role FROM ss_users WHERE username=?';
			$stmt = $link->prepare( $sql );
			$stmt->bind_param( 's', $un );
			$stmt->execute();
			$stmt->bind_result( $id, $pwhash, $role );

			while ( $stmt->fetch() ) {

			if ( password_verify( $pw, $pwhash ) ) {
				//echo 'Brugernavn og password passer med brugerid: '.$id.

				//echo '<div class="text-center">Brugernavn og password er korrekt. Gå til <a href="index.php">forsiden</a></div>'
				$_SESSION[ 'uid' ] = $id;
				$_SESSION[ 'uname' ] = $un;

				//admin=1, nonadmin=0. Checks session if user is set to 1. Used to show only admin panel.
				if ( $role == '1' ) {
					$_SESSION[ 'role' ] = $role;
				}
				
				header("location:front-page.php");
				
			} else {
				?>
			<div class="align-middle text-center mt-3 ">Ugyldigt kombination af brugernavn/password.<br>
				<div class="text-center mb-3"><a href="index.php">Gå tilbage til login siden</a>
				</div>
				<?php
				}
			}

				$link->close();
				?>
			</div>
	</div>
</body>
</html>