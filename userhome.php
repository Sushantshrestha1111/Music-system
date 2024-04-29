<?php 
include 'includes/session.php';
include 'includes/conn.php';
include 'userdb.php';
$user=new user();
if(!isset($_COOKIE['user'])){
	header('location: index.php');
	die();
}else{
	$name=$_COOKIE['user'];
	$pass=$_COOKIE['pass'];
	if($user->checkid($name,$pass,'')==false){
		setcookie('user',$_COOKIE['user'],time()-3600,'/pood');
		setcookie('pass',$_COOKIE['pass'],time()-3600,'/pood');
		setcookie('user',$_COOKIE['user'],time()-3600,'/pood/admin');
		setcookie('pass',$_COOKIE['pass'],time()-3600,'/pood/admin');
		$_SESSION['error']="Corrupted cookie!!!";
		header('location: index.php');
		die();
	}
}
 ?>
<?php include 'includes/header.php'; ?>

<body class="body">
	<div class='alert p-3 m-0' id="alert">
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong id="message"> </strong>
		<i class="material-icons-two-tone" id="message-icon"> </i>
	</div>
	<div class="container-fluid a m-0 p-0">
		<div class="user-container">
			<div class="a-sidebar">
				<div class="a-sidebar-container">
					<div class="a-logo"><img src="img/logo/pood.png" width="100px"></div>
					  <ul class="nav flex-column" role="tablist">
						    <li class="nav-item">
						      <a class="nav-link active homebtn" data-toggle="tab" href="#home">
						      	<i class="material-icons-two-tone">home</i>
						      	<span>Home</span></a>
						      	<span class="dot"></span>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#artist" id="backtoartist"><i class="material-icons-two-tone">account_circle</i><span>Artists</span></a><span class="dot"></span>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#genre"><i class="material-icons-two-tone">album</i><span>Genre</span></a><span class="dot"></span>
						    </li>
							<li class="nav-item">
							   <a class="nav-link" type="button" data-toggle="modal" data-target="#settingModal"><i class="material-icons-two-tone md-light">settings</i><span>Settings</span></a>
							</li>
					  </ul>
				</div>
			</div>
			<div class="contents tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="dash-tab">
				 	<div class="a-nav-bar">
						<div class="row m-0 p-0">
							<div class="col-8 p-0 nav-item">
								<h3 class="heading m-0"><div class="greeting"></div>, 
								<?php 
									echo $user->getUserInfo($_COOKIE['user'],'user_name');
								?></h3><br>
								<p class="date"></p>
							</div>
							<div class="col-4 nav-item a-profile">
								<div class="a-profile-container">
									<div class="image cp" data-toggle="modal" data-target="#editusermodal">
										<?php 
										$cover=$user->getUserInfo($_COOKIE['user'],'user_cover');
										if($cover==''){
											echo "
										<img src='img/logo/user.png'>
											";
										}else{
											echo "
										<img src='images/song-image/".$cover."'>
											";
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row m-0 mb-3">
						<h4 class="col-4 heading m-0">Home</h4>
						<div class="col-8 p-0 nav-item a-search">
							<div class="search-bar">
								<input type="text" id="search_song_user" name="search_song_user" placeholder="Search for song.">
								<i class="fas fa-search search-icon"></i>
							</div>
						</div>
					</div>
						<div class="song-cards" id="song-cards">
							<?php 
								$user->getsong('song','');
							?>
						</div>
				</div>
				<div class="tab-pane fade" id="artist" role="tabpanel" aria-labelledby="search-tab">
				 	<div class="a-nav-bar">
						<div class="row m-0 p-0">
							<div class="col-8 p-0 nav-item">
								<h3 class="heading m-0"><div class="greeting"></div>, 
								<?php 
									echo $user->getUserInfo($_COOKIE['user'],'user_name');
								?></h3><br>
								<p class="date"></p>
							</div>
							<div class="col-4 nav-item a-profile">
								<div class="a-profile-container">
									<div class="image cp" data-toggle="modal" data-target="#editusermodal">
										<?php 
										$cover=$user->getUserInfo($_COOKIE['user'],'user_cover');
										if($cover==''){
											echo "
										<img src='img/logo/user.png'>
											";
										}else{
											echo "
										<img src='images/song-image/".$cover."'>
											";
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row m-0 mb-3">
						<h4 class="col-4 heading m-0">Artist</h4>
						<div class="col-8 p-0 nav-item a-search">
							<div class="search-bar">
								<input type="text" id="search_artist_user" name="search_artist_user" placeholder="Search for artist.">
								<i class="fas fa-search search-icon"></i>
							</div>
						</div>
					</div>
					<div class="artist-cards" >
						<?php 
							$user->getartist('artist','');
						 ?>
					</div>
				</div>

				<div class="tab-pane fade p-0" id="artistsonglist" role="tabpanel" aria-labelledby="search-tab">
					<div class="" id="artist-cards">
					</div>
				</div>

				<div class="tab-pane fade" id="genre" role="tabpanel" aria-labelledby="users-tab">
				 	<div class="a-nav-bar">
						<div class="row m-0 p-0">
							<div class="col-8 p-0 nav-item">
								<h3 class="heading m-0"><div class="greeting"></div>, 
								<?php 
									echo $user->getUserInfo($_COOKIE['user'],'user_name');
								?></h3><br>
								<p class="date"></p>
							</div>
							<div class="col-4 nav-item a-profile">
								<div class="a-profile-container">
									<div class="image cp" data-toggle="modal" data-target="#editusermodal">
										<?php 
										$cover=$user->getUserInfo($_COOKIE['user'],'user_cover');
										if($cover==''){
											echo "
												<img src='img/logo/user.png'>
											";
										}else{
											echo "
												<img src='images/song-image/".$cover."'>
											";
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane-container user">
						<div class="tab-pane-container-header">
							<div class="row m-0 mb-3">
								<h4 class="col-4 heading m-0">Genre</h4>
								<div class="col-8 p-0 nav-item a-search">
								</div>
							</div>
						</div>
						<div class="genre-cards">
							<?php 
								$query="SELECT * FROM genre ORDER by g_id DESC";
								$class=['gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight'] ;
								$result = mysqli_query($conn,$query); 
								if(mysqli_num_rows($result)>0){
									$n=0;
									while ($row=mysqli_fetch_assoc($result)) {
									for($i=$n;$i<=count($class)-1;$i++){
										echo"
										<a class='genre-card' href='#' id='genre".$row['g_id']."'>
											<div class='card ".$class[$i]."'>
												<input type='hidden' id='putgenreid' value='".$row['g_id']."'>
												<h3 id='genrename".$row['g_id']."'>".$row['g_name']."</h3>
											</div>
										</a>";
										$n++;
										break;
										}
									}
								}else{
									echo "No genre found!!!";
								}
							?>
						</div>			    
				</div>
			</div>
			<div class="footer">
				<div class="footer-player">
					<div class="playingimage">
						<img id="nowplayingimg" src="images/sarthak.jpg">
						<div class="footerimgalt">
							<div class="footersongname"></div>
							<div class="footerartistname"></div>
						</div>
					</div>
					<div class="controller">
						<div id="prev" class="cp fbtn"><span class="material-icons-two-tone">skip_previous</span></div>
						<div id="play" class="cp fbtn"><span class="material-icons-outlined play" id="0">play_arrow</span></div>
						<div id="next" class="cp fbtn"><span class="material-icons-two-tone">skip_next</span></div>
						<div class="probar cp" id="probar">
							<div class="upprobar" id="upprobar"></div>
							<div id="starter">
								<div id="stfirst"></div>:<div id="stlast"></div>
							</div>
							<div id="ender">
								<div id="endfirst">00</div>:<div id="endlast">00</div>
							</div>
						</div>
					</div>
        				<audio src="" id="player"></audio>
					<div class="queue" >
						<div id="queue" class="fbtn"><span class="material-icons-two-tone" type="button" data-toggle="tab" href="#queueModal">queue_music</span></div>
						<div id="artistqueue" style="display:none;" class="fbtn"><span class="material-icons-two-tone" type="button" data-toggle="tab" href="#queueModal">queue_music</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='alert p-3 m-0' id="alert">
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong id="message"></strong>
		<i class="material-icons-two-tone" id="message-icon"></i>
	</div>
	<div class="modal fade" id="queueModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
				<ul class="nav flex-column">
				  <li class="nav-item ms-header">
	      			<h4 class="modal-title">PlayList</h4>
			        <button type="button" class="close close-playlist p-0 m-0" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
				  </li>
					  <ul class="musics-ul" id='artist-ul'>
					  	<?php 
					  		$user->getNum('song','');
					  	 ?>
		              </ul>
				  <hr>
				  <li class="nav-item ms-footer">
	      			<p>Missing songs? you can <a href="#">request</a> one.</p>
				  </li>
				</ul>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="settingModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
				<ul class="nav flex-column">
				  <li class="nav-item ms-header">
	      			<h4 class="modal-title">Settings</h4>
				  </li>
				  <li class="nav-item ms mt-3" onclick="darkmode(this)">
	      			<a class="nav-link" href="#"><i id="darkmode" class="fas fa-moon"></i>Dark Mode</a>
	      			</li>
				  <li class="nav-item ms">
	      			<a class="nav-link" href="includes/logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
				  </li>
				  <li class="nav-item ms">
				        <a type="button" class="nav-link" data-dismiss="modal"><i class="fas fa-arrow-left"></i>Back</a>
				  </li>
				  <hr>
				  <li class="nav-item ms-footer">
	      			<p>Missing songs? you can <a href="#">request</a> one.</p>
				  </li>
				</ul>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="editusermodal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form action="" method="post" id="editusermodaldata" enctype="multipart/form-data">
	      		<div class="form-group">
	      			<h4 class="modal-title">Edit Your Info</h4>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto" >
							<?php 
								$cover=$user->getUserInfo($_COOKIE['user'],'user_cover');
								if($cover==''){
									echo "
								<img src='img/logo/user.png' onClick='triggerClick()' id='profileDisplay' class='cp'>
									";
								}else{
									echo "
								<img src='images/song-image/".$cover."' onClick='triggerClick()' id='profileDisplay' class='cp'>
									";
								}
							 ?>
		                    <input class="input-img" type="file" name="uprofile" onChange="displayImage(this)" id="profileImage">
		            <div class="add-icon cp" onClick='triggerClick()'>
		            	<i class="fas fa-camera"></i>
		            </div>
		            </div>
	        	</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control mt-3 pl-3 hb" placeholder='Your email here'
					<?php 
						echo"
							value='".$_COOKIE['user']."'
						";
					 ?>
					 required>
				</div>
				<?php
				$id=$user->getuserid($_COOKIE['user']);
				echo"
					<input type='text' name='id' hidden value='".$id."'>
				"; ?>
				<div class="form-group">
					<input type="text" name="uname" class="form-control mt-3 pl-3 hb" placeholder="Your Username here" 
					<?php 
						echo"
							value='".$user->getUserInfo($_COOKIE['user'],'user_name')."'
						";
					 ?>
					required>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control mt-3 pl-3 hb" placeholder="Your New Passeord here" required>
				</div>
				<div class="form-group">
					<input type="password" name="oldpassword" class="form-control mt-3 pl-3 hb" placeholder="Your old password to confirm changes" required>
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Close</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button name="edituser" class="btn btn-login p-2 hb">Save Change</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>You can change your information any time.</a></p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript">

		function triggerClick(event) {
		  document.querySelector('#profileImage').click();
		}
		function displayImage(event) {
		  if (event.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function(event){
		      document.querySelector('#profileDisplay').setAttribute('src', event.target.result);
		    }
		    reader.readAsDataURL(event.files[0]);
		  }
		}
		function twodigit(n) {
		   return (n<10) ? '0'+n : n;
		}
	    var music=document.getElementById('player');
	    var upprobar=document.getElementById('upprobar');
	    var probar=document.getElementById('probar');
	    music.ontimeupdate = function(e){
            upprobar.style.width = Math.floor(music.currentTime*100/music.duration)+"%";
	    	$("#stfirst").text(twodigit(Math.trunc(music.currentTime/60)));
	    	$("#stlast").text(twodigit(Math.trunc(music.currentTime%60)));
	    	$("#endfirst").text(twodigit(Math.trunc(music.duration/60)));
	    	$("#endlast").text(twodigit(Math.trunc(music.duration%60)));
	    }
	    probar.onclick = function(ep){
	        music.currentTime =((ep.offsetX/probar.offsetWidth) * music.duration);
	    }
		<?php 
			$user->getplaylist('song','');
		 ?>
	</script>
	<script type="text/javascript" src="js/player.js" id="newjs"></script>

</body>
</html>