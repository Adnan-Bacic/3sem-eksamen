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
		$cid = filter_input( INPUT_POST, 'cid', FILTER_VALIDATE_INT )or die( 'Missing or illegal id parameter' );

		require_once( 'database-connect/dbcon.php' );

		$sql = 'DELETE FROM ss_category WHERE id=?';
		$stmt = $link->prepare( $sql );
		$stmt->bind_param( 'i', $cid );
		$stmt->execute();
			
		?>
		<div class="text-center mt-3">Kategori med id"
			<?php echo $cid ?>" slettet</div>
		<?php
		
		$link->close();
		?>

		<br>
		<div class="text-center mb-3"><a href="front-page.php">Tilbage til startsiden</a>
		</div>

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