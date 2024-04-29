<?php 
include 'includes/session.php';
if(isset($_COOKIE['admin'])){
	header('location: admin/index.php');
	die();
}
if(isset($_COOKIE['user'])){
	header('location: userhome.php');
}
 ?>
<!DOCTYPE html>
<html>   
<?php include 'includes/header.php'; ?>
<body class="body">

<?php 
	if(isset($_SESSION['pass_missmatch'])){
		echo"
		<div class='error error-top mt-3 p-3'>
			".$_SESSION['pass_missmatch']."
		</div>
		";
		unset($_SESSION['pass_missmatch']);
	} 
	if(isset($_SESSION['email_exists'])){
		echo"
		<div class='error error-top mt-3 p-3'>
			".$_SESSION['email_exists']."
		</div>
		";
		unset($_SESSION['email_exists']);
	}
	 
	if(isset($_SESSION['empty_credit'])){
		echo"
		<div class='error error-top mt-3 p-3'>
			".$_SESSION['empty_credit']."
		</div>
		";
		unset($_SESSION['empty_credit']);
	}
?>
<div class="modal fade" id="signupmodal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content br-1 b-0">
      <div class="modal-body">
      	<form action="login.php" method="post" enctype="multipart/form-data">
      		<div class="form-group">
      			<h4 class="modal-title">Sign Up</h4>
      		</div>
      		<div class="form-group">
	            <div class="profilePhoto" >
	                    <img src='img/logo/user.png' onClick='triggerClick()' id='profileDisplay' class="cp">
	                    <input class="input-img" type="file" name="uprofile" onChange="displayImage(this)" id="profileImage">
	            <div class="add-icon cp" onClick='triggerClick()'>
	            	<i class="fas fa-camera"></i>
	            </div>
	            </div>
        	</div>
			<div class="form-group">
				<input type="email" name="nemail" class="form-control mt-3 pl-3 hb" placeholder="Your email here" required>
			</div>
			<div class="form-group">
				<input type="text" name="uname" class="form-control mt-3 pl-3 hb" placeholder="Your Username here" required>
			</div>
			<div class="form-group">
				<input type="password" name="npassword" class="form-control mt-3 pl-3 hb" placeholder="Your password here" required>
			</div>
			<div class="form-group">
				<input type="password" name="repassword" class="form-control mt-3 pl-3 hb" placeholder="Confirm your password here" required>
			</div>
	        <div class="form-group mt-3">
	        	<div class="row m-0">
	        		<div class="col-6 pl-0">
			        	<button type="submit" name="signup" class="btn btn-login p-2 hb">Sign Up</button>
			        </div>
			        <div class="col-6 pr-0">
			        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Close</button>
			        </div>
	        	</div>
	        </div>
	        <hr>
	        <div class="form-group">
	        	<p>By siging up you accpect our <a href="#">Terms & Conditions.</a></p>
	        </div>
      	</form>
      </div>
    </div>
  </div>
</div>
	<div class="container-fluid u">
		<div class="row m-0">
			<div class="col-md-6">
				<div class="cont-container left">
					<img src="img/logo/pood.png">
					<h4 class="moto">Nobody Listens it better.🎧</h4>
				</div>
			</div>
			<div class="col-md-6">
				<div class="cont-container right">
					<form class="form-container m-auto p-3 br-1" method="post" action="login.php">
						<h4 class="text-center mb-3">Login <c class="to">to</c> <b class="font-pood">dhun</b></h4>
						  	<?php
						      if(isset($_SESSION['error'])){
						        echo "
						          <div class='error text-center'>
						            <p>".$_SESSION['error']."</p> 
						          </div>
						        ";
						        unset($_SESSION['error']);
						      }
						      ?>
					  <div class="form-group">
					    <input type="email" name="email" class="form-control mb-3 pl-3 hb" placeholder="Your Email here" value="
					    <?php 
					    	if(isset($_SESSION['wrong_email'])){
					    		echo $_SESSION['wrong_email'];
					    	}
					    	unset($_SESSION['wrong_email']);
					     ?>
					    " required>
					  </div>
					  <div class="form-group">
					    <input type="password" name="password" class="form-control mt-3 pl-3 hb" id="exampleInputPassword1" placeholder="Your password here" required>
					  </div>
					  <div class="form-group">
					  	<button type="submit" name="login" class="btn btn-login p-2 hb">Log in</button>
					  </div>
					  <hr class=" mt-3">
					  <div class="form-group mt-1">
					  	<p class="notauser">Not a user? <a style="color: blue;" type="button" data-toggle="modal" data-target="#signupmodal">Sign Up</a> for free!</p>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script>