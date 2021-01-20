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
	$vid = filter_input(INPUT_POST, 'vid', FILTER_VALIDATE_INT) or die('Missing or illegal id parameter');
	
	require_once( 'database-connect/dbcon.php' );
	
	$sql = 'DELETE FROM ss_videos WHERE id=?';
	$stmt = $link->prepare( $sql );
	$stmt->bind_param( 'i', $vid );
	$stmt->execute();
	
	?><div class="text-center mt-3">Video med id "<?php echo $vid ?>" slettet</div><?php
	$link->close();
	?>
	
	<br>
		<div class="text-center mb-3"><a href="view-videos.php">Tilbage til startsiden</a></div>
	
	<?php
		} else {
			?><h2 class="text-center mt-3">Denne side er kun for administratorer</h2><br>
			<div class="text-center mb-3"><a href="front-page.php">Gå tilbage til startsiden</a></div><?php
		}
		?>
	
	<?php
	include 'includes/footer.php';
	?>
	</div>
</body>
</html>