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
			if ( isset( $_SESSION[ 'role' ] ) ) {
				?>

			<?php
			$userid = filter_input(INPUT_POST, 'userid', FILTER_VALIDATE_INT) or die('Missing or illegal id parameter');
			
			require_once( 'database-connect/dbcon.php' );

			$sql = 'UPDATE ss_users SET role = 0 WHERE id=?';
			$stmt = $link->prepare( $sql );
			$stmt->bind_param( 'i', $userid );
			$stmt->execute();
				
			if ( $stmt->affected_rows > 0 ) {
					?><div class="text-center mt-3 mb-3">Bruger med id "<?php echo $userid ?>" er ikke længere admin.<br><a href="admin-panel.php">Gå til admin panel</a></div>
	<?php
				} else {
					?><div class="text-center mt-3 mb-3">Fejl upstået under forsøg på at fjerne admin rettigheder fra bruger med id "<?php echo $userid ?>" da denne bruger ikke er admin.<br><a href="admin-panel.php">Gå til admin panel</a></div><?php
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