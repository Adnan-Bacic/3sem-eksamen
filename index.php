<?php
session_start();
//No if(isset($_SESSION['uid'])) in index. It causes an error.
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
	<div class="row">
		<div class="mx-auto">
			<h1 class="form-signin-heading mt-3">Lean Up</h1>
			<img class="pic" class="center" src="images/book.png">
		</div>
	</div>


  <div class="wrapper">
    <form class="form-signin needs-validation" action="login.php" method="post" autocomplete="off" novalidate>
		<label for="validationServerUsername">Brugernavn</label>
      <input type="text" class="form-control is-valid" id="validationServer01" name="un" placeholder="Brugernavn" required autofocus>
		<div class="invalid-feedback">
        <p>Indtast venligst et brugernavn</p>
      </div>
	  <label for="validationServer02" class="mt-3">Password</label>
      <input type="password" class="form-control is-valid" id="validationServer02" name="pw" placeholder="Password" required>
		<div class="invalid-feedback">
        <p>Indtast venligst et password</p>
      </div>
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" value="Log ind">Login</button>

    </form>
  </div>

	<!--Bootstrap form validator-->
	<script src="javascript/form-validator.js"></script>

	<?php
	include 'includes/footer.php';
	?>
	</div>
</body>
</html>
