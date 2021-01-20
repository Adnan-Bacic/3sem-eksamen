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
 
    if(isset($_POST['btnaddvideo'])){
       $maxsize = 80000000; // 80MB
    

       $name = $_FILES['video_title']['name'];
       $target_dir = "ss_videos/";
       $target_file = $target_dir . $_FILES["video_title"]["name"];

       // Select file type
       $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Valid file extensions
                    $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

                    // Check extension
                    if( in_array($videoFileType,$extensions_arr) ){
                
                        // Check file size
                        if(($_FILES['video_title']['size'] >= $maxsize) || ($_FILES["video_title"]["size"] == 0)) {
                            echo "File too large (".($_FILES['video_title']['size'])."). File must be less than 80MB.";
                        }
                        else  {
                                // Upload
                                if(move_uploaded_file($_FILES['video_title']['tmp_name'],$target_file)){
                            
                                    $vt = filter_input( INPUT_POST, 'video_title' )or die( 'Missing or illegal category title parameter' );
                                    $vd = filter_input( INPUT_POST, 'video_description' )or die( 'Missing or illegal category description parameter' );
                                    $video = $target_file;

                                    require_once( 'database-connect/dbcon.php' );



                            $sql = 'INSERT INTO ss_videos(title, description, location) VALUES (?,?,?)';
                            $stmt = $link->prepare( $sql );
                            $stmt->bind_param( 'sss', $vt, $vd, $video );
                            $stmt->execute();

                            if ( $stmt->affected_rows > 0 ) {
                                ?><div class="text-center mt-3 mb-3">Video "<?php echo $vt ?>" oprettet.<br> Gå tilbage til <a href="view-videos.php">video siden</a></div>
                <?php
                            } else {
                                ?><div class="text-center mt-3 mb-3">Fejl upstået under tilføjelse af ny video. En titel skal være unik og titlen "<?php echo $vt ?>" er allerede taget. Prøv en anden titel.<br>Gå tilbage til <a href="view-videos.php">video siden</a></div><?php
                            }

                            $link->close();
        
                 }  
            }
       }
  } 
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