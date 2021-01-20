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
		
			<h2 class="text-center mt-3">Videoer:</h2>
			
			<!-- Start video container -->
			<div class="row d-flex justify-content-around mt-3">
				<!--Showing all videos -->
				<?php
				require_once( 'database-connect/dbcon.php' );

				$sql = 'SELECT id as vid, title, description, location FROM ss_videos ORDER BY id DESC';
				$stmt = $link->prepare( $sql );
				$stmt->bind_result( $vid, $title, $description, $location );
				$stmt->execute();
				while ( $stmt->fetch() ) {
					?>
				<div class="category-item col-xl-12 col-sm-12 mb-3">
					<h2 class="col-xl-12 text-center">
						<?php echo $title ?>
					</h2>
					<?php
					if ( isset( $_SESSION[ 'role' ] ) ) {
						?>
					<div class="delete d-inline float-right indmedden">
						<form action="delete-video.php" method="post">
							<input type="hidden" name="vid" value="<?php echo $vid ?>">
							<div class="delete-img">
								<input type="image" src="images/delete-img.png" title="Slet video" width="20" height="20" alt="Delete">
							</div>
						</form>
					</div>
					<?php } else {
							}
							?>
					<p class="text-center">
						<?php echo $description ?>
					</p>
					<div class="video mx-auto">
						<?php
						?> <video value="<?php echo $vid ?>" src="<?php echo $location ?>" width='768px' height='432px' controls>
						</video>
						</div>
						
					</div>
				
					<?php

					}
					$link->close();
					?>
				</div>

				<?php
				if ( isset( $_SESSION[ 'role' ] ) ) {
					?>
				<!--add new video-->
				<div class="row justify-content-center">
					<h2 class="">Tilføj ny video</h2>
				</div>
				<br>

				<!-- new video-->
				<div class="row border tilfojvideo">

					<div class="mx-auto">
						<form class="inputtitel" method="post" action="create-video.php" autocomplete="off" enctype="multipart/form-data">
							<div class="form-input">
								<div class="font-weight-bold input-txt text-warning mt-3">Titel: </div>
								<input class="input-field" type="text" name="video_title" required>
							</div>
							<br>
							<div class="form-input">
								<div class="font-weight-bold input-txt text-warning">Beskrivelse: </div>
								<input class="input-field" type="text" name="video_description" required>
							</div>
							<br>
							<div class="custom-file mb-3">
								<input type="file" name="video_title" accept="video/mp4" class="custom-file-input" id="customFile" required>
								<label class="custom-file-label" for="customFile">Vælg video (.mp4)</label>
							</div>
							<br>
							<input class="font-weight-bold btn btn-warning btn-block mb-3 texttilfoj" name="btnaddvideo" type="submit" value="Tilføj">
						</form>
					</div>
				</div>

				<?php
				} else {

				}
				?>
				<?php
				include 'includes/footer.php';
				?>
	</body>
</html>