<?php
session_start();
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
			include 'includes/navbar.php';
			?>
		
		<?php
		if(isset($_SESSION['role'])){
			?>
		
	<?php
	
	//Create user
	$un = filter_input( INPUT_POST, 'un' )or die( '' );
	$pw = filter_input( INPUT_POST, 'pw' )or die( '' );

	$pwhash = password_hash( $pw, PASSWORD_DEFAULT );

	require_once( 'database-connect/dbcon.php' );

	$sql = 'INSERT INTO ss_users (username, pwhash) VALUES (?, ?)';
	$stmt = $link->prepare( $sql );
	$stmt->bind_param( 'ss', $un, $pwhash );
	$stmt->execute();

	if ( $stmt->affected_rows > 0 ) {
		?> <div class="text-center mb-3 mt-3">Brugeren "<?php echo $un ?>" oprettet <br> <a href="admin-panel.php">Tilbage til admin panel</a></div><?php
	} else {
		?> <div class="text-center mb-3 mt-3">Kunne ikke oprette bruger med brugernavnet "<?php echo $un ?>", fordi at dette brugernavn allerede er taget. <br> <a href="admin-panel.php">Tilbage til admin panelet</a></div><?php
	}
	
	$link->close();
	?>
		<?php
		} else {
			include 'includes/admin-only-msg.php';
		}
		?>
	<?php
			include 'includes/footer.php';
			?>
	</div>
</body>
</html>