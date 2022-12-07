<!--Navbar start-->
<nav class="navbar navbar-expand-lg bg-light navbar-light navbarbg">
	<a class="navbar-brand" href="front-page.php"><img src="images/sunset-favicon.png" width="75"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<a href="front-page.php">
	<button class="btn btn-dark mr-3 mb-xs-3">Hjem</button>
	</a>
		<ul class="navbar-nav ml-auto">
			<a class="nav-link text-dark"><?php
		if(isset($_SESSION['uid'])){
			echo $_SESSION['uname'];
		} else { 
					?>"Ikke logget ind"<?php
				}?> 
				<?php
		if(isset($_SESSION['role'])){
			echo '(Administrator)';
				?><a href="admin-panel.php"><button class="adminbtn btn btn-info mr-3">Admin panel</button></a><?php
		} else {
			echo '(Bruger)';
		}
		?>
				<span class="sr-only"></span></a>
			<form action="logout.php">
				<button class="btn btn-outline-danger" type="submit">Logout</button>
			</form>
	</div>
</nav>
<!--Navbar end-->