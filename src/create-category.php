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
	<?php
		include 'includes/navbar.php';
		?>
	<?php
		if(isset($_SESSION['role'])){
			?>
	<?php
if(isset($_POST['btnaddcategory'])){
	$maxsize = 80000000; // 80MB
	
	//print_r($_POST);

	$name = $_FILES['category_thumbnail']['name'];
	$target_dir = "ss_category/";
	$target_file = $target_dir . $_FILES["category_thumbnail"]["name"];

	// Select file type
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png");

	// Check extension
	if( in_array($imageFileType,$extensions_arr) ){

		// Check file size
		if(($_FILES['category_thumbnail']['size'] >= $maxsize) || ($_FILES["category_thumbnail"]["size"] == 0)) {
			echo "File too large (".($_FILES['category_thumbnail']['size'])."). File must be less than 80MB.";
		} else {
			// Upload
			if(move_uploaded_file($_FILES['category_thumbnail']['tmp_name'],$target_file)){
				
				$ct = filter_input( INPUT_POST, 'category_title' )or die( 'Missing or illegal category title parameter' );
				$cd = filter_input( INPUT_POST, 'category_description' )or die( 'Missing or illegal category description parameter' );
				$ctn = $target_file;

				require_once( 'database-connect/dbcon.php' );

				$sql = 'INSERT INTO ss_category (title, description, thumbnail) VALUES (?, ?, ?)';
				$stmt = $link->prepare( $sql );
				$stmt->bind_param( 'sss', $ct, $cd, $ctn );
				$stmt->execute();
				

				if ( $stmt->affected_rows > 0 ) {
					?><div class="text-center mt-3 mb-3">Kategori "<?php echo $ct ?>" oprettet.<br> Gå tilbage til <a href="front-page.php">startsiden</a></div>
	<?php
				} else {
					?><div class="text-center mt-3 mb-3">Fejl upstået under tilføjelse af ny kategori. En titel skal være unik og titlen "<?php echo $ct ?>" er allerede taget. Prøv en anden titel.<br>Gå tilbage til <a href="front-page.php">startsiden</a></div><?php
				}

				$link->close();
			}
		}
	}
}
		} else {
			include 'includes/admin-only-msg.php';
		}
		?>
	<?php
		include 'includes/footer.php';
		?>
</body>
</html>