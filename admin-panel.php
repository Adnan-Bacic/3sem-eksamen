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
			
			<div class="row">
			<div class="col-xl-6">
			<div class="form-container mx-auto border-0 pb-3">
			<div class="row justify-content-center">
			<form class="create-user mr-3 mt-3" action="create-user.php" method="post">
				<h2 class="text-light">Opret bruger</h2>
				<p class="text-light">Brugernavn</p>
				<input class="border-0 p-2 rounded mb-3" type="text" autocomplete="off" name="un" placeholder="Brugernavn" required>
				<p class="text-light">Password</p>
				<input class="border-0 p-2 rounded mb-3" type="password" autocomplete="off" name="pw" placeholder="Password" required>
				<br>
				<input class="btn btn-outline-primary" type="submit" value="Opret bruger">
			</form>
				</div>
			</div>
				</div>

			<div class="col-xl-6">
			<h2 class="text-center">Liste over admin brugere</h2>


			<?php
			require_once( 'database-connect/dbcon.php' );

			//Showing admins
			$sql = "SELECT username, id AS userid FROM ss_users WHERE role=1 ORDER BY username ASC";
			$result = $link->prepare( $sql );
			$result->execute();
			$result->bind_result( $username, $userid );

				// output data of each row
				while ( $result->fetch() ) {
					?>
			<div class="row text-center mb-3 col-xl-4 mx-auto">Brugernavn:
			<?php echo $username ?>
				
				<div class="d-inline float-right mb-3">
					<form action="remove-admin.php" method="post">
						<input type="hidden" name="userid" value="<?php echo $userid ?>">
						<div class="delete-img">
							<button class="btn btn-primary mr-3">Fjern administrator rettigheder</button>
						</div>
					</form>
				</div>
				
				<div class="d-inline float-right mb-3">
					<form action="delete-user.php" method="post">
						<input type="hidden" name="userid" value="<?php echo $userid ?>">
						<div class="delete-img">
							<button class="btn btn-danger mr-3">Slet bruger</button>
						</div>
					</form>
				</div>
				</div>
				<?php
				}
				?>
				
				<h2 class="text-center">Liste over ikke-admin brugere</h2>
				
				<?php
				//Showing non-admins
				$sql = "SELECT username, id AS userid FROM ss_users WHERE role=0 ORDER BY username ASC";
			$result = $link->prepare( $sql );
			$result->execute();
			$result->bind_result( $username, $userid );

				// output data of each row
				while ( $result->fetch() ) {
					?>
			<div class="row text-center mb-3 col-xl-4 mx-auto">Brugernavn:
			<?php echo $username ?>
				<div class="d-inline float-right mb-3">
					<form action="make-admin.php" method="post">
						<input type="hidden" name="userid" value="<?php echo $userid ?>">
						<div class="delete-img">
							<button class="btn btn-primary mr-3">Lav bruger til admin</button>
						</div>
					</form>
				</div>
				
				<div class="d-inline float-right mb-3">
					<form action="delete-user.php" method="post">
						<input type="hidden" name="userid" value="<?php echo $userid ?>">
						<div class="delete-img">
							<button class="btn btn-danger mr-3">Slet bruger</button>
						</div>
					</form>
				</div>
				
				</div>
			<?php
				}

			$link->close();
			?>		
		
		<?php
		} else {
			include 'includes/admin-only-msg.php';
		}?>
			
	
			</div>
				</div>
			</div>
		<?php
			include 'includes/footer.php';
			?>
	</body>
</html>