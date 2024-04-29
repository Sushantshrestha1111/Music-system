<!DOCTYPE html>
<html>
<head>
	<title>pood-login or signup</title>
	<link rel="stylesheet" type="text/css" href="css/pood.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="cont-container left">
				<img src="img/logo/pood.png">
				<h4>Enjoy music anywhere at any time.</h4>
			</div>
		</div>
		<div class="col-md-6">
			<div class="cont-container right">
				<form class="form-container m-auto p-3 br-1" method="post" action="login.php">
					<h4 class="text-center mb-3">Log into <b style="color: #ffa618;">pood</b></h4>
				  <div class="form-group">
				    <input type="email" name="email" class="form-control mb-3 pl-2 hb" placeholder="Your Email here">
				  </div>
				  <div class="form-group">
				    <input type="password" name="password" class="form-control mt-3 pl-2 hb" id="exampleInputPassword1" placeholder="Your password here">
				  </div>
				  <div class="form-group">
				    <input type="password" name="password" class="form-control mt-3 pl-2 hb" id="exampleInputPassword1" placeholder="Your password here">
				  </div>
				  <div class="form-group">
				  	<button type="submit" class="btn btn-login p-2 mt-3 hb">Log in</button>
				  </div>
				  <hr class=" mt-3">
				  <div class="form-group mt-1">
				  	<p class="notauser">Not a user? <a href="#">Sign Up</a> for free!</p>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>