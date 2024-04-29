<?php 
include '../includes/session.php';
include '../includes/conn.php';
include '../includes/oopconn.php';
$obj=new db();
if(!isset($_COOKIE['admin'])){
	header('location: ../index.php');
	die();
}else{
	$name=$_COOKIE['admin'];
	$pass=$_COOKIE['pass'];
	if($obj->checkid($name,$pass,'admin')==false){
		setcookie('admin',$_COOKIE['admin'],time()-3600,'/pood');
		setcookie('pass',$_COOKIE['pass'],time()-3600,'/pood');
		setcookie('admin',$_COOKIE['admin'],time()-3600,'/pood/admin');
		setcookie('pass',$_COOKIE['pass'],time()-3600,'/pood/admin');
		$_SESSION['error']="Corrupted cookie!!!";
		header('location: ../index.php');
		die();
	}
}
$months = array("jan"=>"1", "feb"=>"2", "mar"=>"3","apr"=>"4","may"=>"5","jun"=>"6","jul"=>"7","aug"=>"8","sep"=>"9","oct"=>"10","nov"=>"11","dec"=>"12");
$years = array(2020=>2020,2021=>2021,2022=>2022);
?>
<?php include '../includes/header.php'; ?>
<body class="body">
<div id="loading">
  <img id="loading-image" src="../img/logo/loader.gif" alt="Loading..." />
</div>
	<div class="container-fluid a m-0 p-0">
		<div class="a-container">
			<div class="a-sidebar">
				<div class="a-sidebar-container">
					<div class="a-logo"><img src="../img/logo/pood.png" width="100px"></div>
					  <ul class="nav flex-column" role="tablist">
						    <li class="nav-item">
						      <a class="nav-link active" data-toggle="tab" href="#dashboard">
						      	<i class="material-icons-two-tone">dashboard</i>
						      	<span>Dashboard</span></a>
						      	<span class="dot"></span>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#music"><i class="material-icons-two-tone">headphones</i><span>Music</span></a><span class="dot"></span>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#artist"><i class="material-icons-two-tone">account_circle</i><span>Artists</span></a><span class="dot"></span>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#users"><i class="material-icons-two-tone">groups</i><span>Users</span></a><span class="dot"></span>
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
			 	<div class="a-nav-bar">
					<div class="row m-0 p-0">
						<div class="col-8 p-0 nav-item">
							<h3 class="heading m-0"><div class="greeting"></div>, <?php echo $_COOKIE['admin'] ?></h3><br>
							<p class="date"></p>
						</div>
						<div class="col-4 nav-item a-profile">
							<div class="a-profile-container">
								<div class="image">
									<img src="../images/sarthak.jpg">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dash-tab">
					<div class="row m-0">
						<h4 class="col-4 heading">DashBoard</h4>
					</div>
					<div class="a-card-container">
					  <div class="a-card ac1">
					  	<div class="a-content">
					  		<h5 class="m-0">Total Songs</h5>
					  		<h3 id="total-songs" class="total-songs">
								<?php 
			                        $obj->getCount('song');
			                    ?>
					  		</h3>
					  	</div>
					  	<div class="slant">
					  		<i class="material-icons-two-tone">headphones</i>
					  	</div>
					  </div>
					  <div class="a-card ac2">
					  	<div class="a-content">
					  		<h5 class="m-0">Total Artist</h5>
					  		<h3 id="total-artists" class="total-artists">
								<?php 
									$obj->getCount('artist');
			                    ?>
					  		</h3>
					  	</div>
					  	<div class="slant">
					  		<i class="fas fa-user-astronaut"></i>
					  	</div>
					  </div>
					  <div class="a-card ac3">
					  	<div class="a-content">
					  		<h5 class="m-0">Total Users</h5>
					  		<h3 class="total-users" id="total-users">
								<?php 
			                        $obj->getCount('user');
			                    ?>
					  		</h3>
					  	</div>
					  	<div class="slant">
					  		<i class="material-icons-two-tone">groups</i>
					  	</div>
					  </div>
					  <div class="a-card ac4">
					  	<div class="a-content">
					  		<h5 class="m-0">Total Genre</h5>
					  		<h3 id="total-genres" class="total-genres">
					  			<?php 
					  				$obj->getCount('genre');
					  			 ?>
					  		</h3>
					  	</div>
					  	<div class="slant">
					  		<i class="material-icons-two-tone">album</i>
					  	</div>
					  </div>
					</div>
					<div class="row m-0 mt-2">
						<h4 class="col-4 heading">Charts</h4>
						<!-- <div class="sort">Sort by:
								<select class="form-select" aria-label="Default select example">
									<option selected>Month</option>
									<?php 
										foreach($months as $val=>$val_num){
											echo"<option value='".$val_num."'>".$val."</option>";
										}
									 ?>
								</select>
								<select class="form-select" aria-label="Default select example">
									<option selected>Year</option>
									<?php 
										foreach($years as $val=>$val_num){
											echo"<option value='".$val_num."'>".$val."</option>";
										}
									 ?>
								</select>
							</div> -->
					</div>
		            <div class="dashboard-cards">
		                <div class="card" id="card-1">
		                    <div class="chart-canvas">
		                        <canvas id="myChartUser"></canvas>
		                    </div>
		                </div>
		                <div class="card"  id="card-2">
		                    <div class="chart-canvas">
		                        <canvas id="myChartArtist"></canvas>
		                    </div>
		                </div>
		                <div class="card"  id="card-3">
		                    <div class="chart-canvas">
		                        <canvas id="myChartSong"></canvas>
		                    </div>
		                </div>
		                <div class="card"  id="card-4">
		                    <div class="chart-canvas">
		                        <canvas id="myChartGenre"></canvas>
		                    </div>
		                </div>
		            </div>
				</div>
				<div class="tab-pane fade" id="music" role="tabpanel" aria-labelledby="music-tab">
					<div class="row m-0 mb-3">
						<h4 class="col-4 heading m-0">Music</h4>
						<div class="col-8 p-0 nav-item a-search">
							<div class="search-bar">
								<input type="text" id="search_song" name="search_song" placeholder="Search for song.">
								<i class="fas fa-search search-icon"></i>
							</div>
						</div>
					</div>
					<div class="a-card-container">
						<a type="button" data-toggle="modal" data-target="#addSongModal">
						  <div class="a-card ac1">
						  	<div class="a-content">
						  		<h5 class="m-0">Add Song</h5>
						  		<h3><i class="fas fa-plus-square"></i></h3>
						  	</div>
						  </div>
						</a>
						  <div class="a-card ac2">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Songs</h5>
						  		<h3 class="total-songs">
									<?php 
				                        $obj->getCount('song');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="fas fa-headphones-alt"></i>
						  	</div>
						  </div>
						  <div class="a-card ac3">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Artists</h5>
						  		<h3 class="total-songs">
									<?php 
				                        $obj->getCount('artist');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="fas fa-user-astronaut"></i>
						  	</div>
						  </div>
						  <div class="a-card ac4">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Genre</h5>
						  		<h3 class="total-songs">
									<?php 
				                        $obj->getCount('genre');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="fas fa-compact-disc"></i>
						  	</div>
						  </div>
					</div>
					<caption><h5 class="mt-3">Recently Added Musics</h5></caption>
					<table class="table table-borderless table-striped table-hover">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Name</th>
					      <th scope="col">Artist</th>
					      <th scope="coladd">Added on</th>
					      <th scope="col">Edit</th>
					    </tr>
					  </thead>
					  <tbody id="songs-list" class="list">
					  	<?php 
					  			$obj->getrecent('song','','');
					  	 ?>
					  </tbody>
					</table>
					<div class="load-more">
						<button id="load-songs" name="loadsongs" class="btn btn-success">Load recent songs</button>
					</div>
				</div>
				<div class="tab-pane fade" id="artist" role="tabpanel" aria-labelledby="search-tab">
					<div class="row m-0 mb-3">
						<h4 class="col-4 heading m-0">Artist</h4>
						<div class="col-8 p-0 nav-item a-search">
							<div class="search-bar">
								<input type="text" id="search_artist" name="search_artist" placeholder="Search for artist.">
								<i class="fas fa-search search-icon"></i>
							</div>
						</div>
					</div>
					<div class="a-card-container">
						<a type="button" data-toggle="modal" data-target="#addArtistModal">
						  <div class="a-card ac1">
						  	<div class="a-content">
						  		<h5 class="m-0">Add Artist</h5>
						  		<h3><i class="fas fa-plus-square"></i></h3>
						  	</div>
						  </div>
						</a>
						  <div class="a-card ac2">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Artist</h5>
						  		<h3 id="total-artists" class="total-artists">
									<?php 
				                        $obj->getCount('artist');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="fas fa-user-astronaut"></i>
						  	</div>
						  </div>
						  <div class="a-card ac3">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Songs</h5>
						  		<h3>
									<?php 
				                        $obj->getCount('song');
				                    ?>
						  		</h3>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="material-icons-two-tone">headphones</i>
						  	</div>
						  </div>
						  <div class="a-card ac4">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Genre</h5>
						  		<h3>
									<?php 
				                        $obj->getCount('genre');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="fas fa-compact-disc"></i>
						  	</div>
						  </div>
					</div>
					<caption><h5 class="mt-3">Recently Added Artists.</h5></caption>
					<table class="table table-borderless table-striped table-hover">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Name</th>
					      <th scope="col">Songs</th>
					      <th scope="coladd">Added on</th>
					      <th scope="col">Edit</th>
					    </tr>
					  </thead>
					  <tbody id="artists-list" class="list">
					  	<?php 
					  		$obj->getList('artist','artist_id','','artist_name','artist_view','artist_cover','artist_reg_date','total_album','a_day','a_month','a_year');
					  	 ?>
					  </tbody>
					</table>
<!-- 					<div class="load-more">
						<button id="load-songs" name="loadsongs" class="btn btn-success">Load recent songs</button>
					</div> -->
				</div>
				<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
					<div class="row m-0 mb-3">
						<h4 class="col-4 heading m-0">Users</h4>
						<div class="col-8 p-0 nav-item a-search">
							<div class="search-bar">
								<input type="text" id="search_user" name="search_user" placeholder="Search for user.">
								<i class="fas fa-search search-icon"></i>
							</div>
						</div>
					</div>
					<div class="a-card-container">
						<a type="button" data-toggle="modal" data-target="#addUserModal">
						  <div class="a-card ac1">
						  	<div class="a-content">
						  		<h5 class="m-0">Add Users</h5>
						  		<h3><i class="fas fa-plus-square"></i></h3>
						  	</div>
						  </div>
						</a>
						  <div class="a-card ac2">
						  	<div class="a-content">
						  		<h5 class="m-0">Total Users</h5>
						  		<h3 class="total-users">
									<?php 
				                        $obj->getCount('user');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="material-icons-two-tone">groups</i>
						  	</div>
						  </div>
						  <div class="a-card ac3">
						  	<div class="a-content">
						  		<h5 class="m-0">Visitors/day</h5>
						  		<h3>
									<?php 
				                        $obj->getCount('song');
				                    ?>
						  		</h3>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="material-icons-two-tone">visibility</i>
						  	</div>
						  </div>
						  <div class="a-card ac4">
						  	<div class="a-content">
						  		<h5 class="m-0">Active Users</h5>
						  		<h3>
									<?php 
				                        $obj->getCount('genre');
				                    ?>
						  		</h3>
						  	</div>
						  	<div class="slant">
						  		<i class="material-icons-two-tone">add_reaction</i>
						  	</div>
						  </div>
					</div>
					<caption><h5 class="mt-3">Recently Added Users.</h5></caption>
					<table class="table table-borderless table-striped table-hover">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Name</th>
					      <th scope="coladd">Added on</th>
					      <th scope="col">Edit</th>
					    </tr>
					  </thead>
					  <tbody id="users-list" class="list">
					  	<?php 
					  		$obj->getUserList('user','user_id','','email','reg_date','user_cover');
					  	 ?>
					  </tbody>
					</table>
<!-- 					<div class="load-more">
						<button id="load-songs" name="loadsongs" class="btn btn-success">Load recent songs</button>
					</div> -->
				</div>
				<div class="tab-pane fade" id="genre" role="tabpanel" aria-labelledby="users-tab">
					<div class="tab-pane-container">
						<div class="tab-pane-container-header">
							<div class="row m-0 mb-3">
								<h4 class="col-4 heading m-0">Genre</h4>
								<div class="col-8 p-0 nav-item a-search">
									<div class="search-bar">
										<input type="text" id="search_genre" name="search_genre" placeholder="Search for Genre.">
										<i class="fas fa-search search-icon"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="genre-cards">
							<a class="genre-card cp" data-toggle="modal" data-target="#addGenreModal">
								<div class="card">
									<h3 style="text-align:center;color:var(--font-color);">Add Genre <i class="fas fa-plus-square"></i></h3>
								</div>
							</a>
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
												<button data-id='".$row['g_id']."' data-role='editgenre' data-target='#editGenreModal' data-toggle='modal' class='btn edit'>Edit  <i class='fas fa-pen' alt='edit'></i></button>
												<button data-id='".$row['g_id']."' data-role='deletegenre' class='btn delete'><i class='fas fa-times'></i></button>
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
		</div>
	</div>
	<div class='alert p-3 m-0' id="alert">
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong id="message"></strong>
		<i class="material-icons-two-tone" id="message-icon"></i>
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
	      			<a class="nav-link" href="../includes/logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
				  </li>
				  <li class="nav-item ms">
				        <a type="button" class="nav-link" data-dismiss="modal"><i class="fas fa-arrow-left"></i>Back</a>
				  </li>
				  <hr>
				  <li class="nav-item ms-footer">
	      			<p>Stay tuned for more updates.</p>
				  </li>
				</ul>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="editSongModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="editdata" enctype="multipart/form-data">
	      		<div class="form-group">
	      			<h4 class="modal-title">Update Song!</h4>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto editprofilePhoto" >
		                    <img src='../img/logo/user.png' onclick='triggerClickEdit()' id='edit_profileDisplay'>
		                    <input class="input-img" type="file" name="imgfile" onchange="displayImageEdit(this)" id="edit_imgfile">
		                    <p style="color:red;"> (All the fileds should be updated*)</p>
		                    <input type="hidden" name="edit_song_id" id="edit_song_id">
		            </div>
	        	</div>
				<div class="form-group">
					<input type="text" name="edit_song_name" id="edit_song_name" class="form-control mt-3 pl-3 hb" placeholder="Song name">
				</div>
				<div class="form-group">
					<input list="song_artists" type="text" name="edit_artist_id" id="edit_artist_id" class="form-control mt-3 pl-3 hb" placeholder="Song artist">
					  <datalist id="song_artists">
					  	<?php 
					  		$obj->getartistlist();
					  	 ?>
					  </datalist>
				</div>
				<div class="form-group">
					<input type="file" name="sngfile" id="edit_sngfile" onchange="previewSong(this)" class="form-control mt-3 pl-3 hb">
				</div>
				<div class="form-group">
					<audio controls src="" type="audio/mpeg" id="edit_previewSong">
					</audio>
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button id="edit_song" class="btn btn-login p-2 hb" name="editdata">Update Song</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="editArtistModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="editartist" enctype="multipart/form-data">
	      		<div class="form-group">
	      			<h4 class="modal-title">Edit Artist</h4>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto editprofilePhoto" >
		                    <img src='../img/logo/user.png' onclick='triggerClickEditArtist()' id='editartist_profileDisplay'>
		                    <input class="input-img" type="file" name="edit_artist_imgfile" onchange="displayImageArtistEdit(this)" id="edit_artist_imgfile">
		                    <p> (click on icon to choose an image*)</p>
		                    <input type="hidden" name="edit_artist_id" class="edit_artist_id">
		            </div>
	        	</div>
				<div class="form-group">
					<input type="text" name="edit_artist_name" id="edit_artist_name" class="form-control mt-3 pl-3 hb" placeholder="Edit Artist name">
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button id="edit_artist" class="btn btn-login p-2 hb">Edit Artist</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="editUserModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="edituser" enctype="multipart/form-data">
	      		<div class="form-group">
	      			<h4 class="modal-title">Edit User</h4>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto editprofilePhoto" >
		                    <img src='../img/logo/user.png' onclick='triggerClickEditArtist()' id='edituser_profileDisplay'>
		                    <input class="input-img" type="file" name="edit_user_imgfile" onchange="displayImageArtistEdit(this)" id="edit_user_imgfile">
		                    <p> (click on icon to choose an image*)</p>
		                    <input type="hidden" name="edit_user_id" class="edit_user_id">
		            </div>
	        	</div>
				<div class="form-group">
					<input type="email" name="edit_user_name" id="edit_user_name" class="form-control mt-3 pl-3 hb" placeholder="Edit user Email">
				</div>
				<div class="form-group">
					<input type="text" name="edit_user_uname" id="edit_user_uname" class="form-control mt-3 pl-3 hb" placeholder="Edit User Name">
				</div>
				<div class="form-group">
					<input type="password" name="edit_user_password" id="edit_user_password" class="form-control mt-3 pl-3 hb" placeholder="Edit User Password">
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button id="edit_user" class="btn btn-login p-2 hb">Edit User</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="addSongModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="data" enctype="multipart/form-data">
	      		<div class="form-group">
	      			<h4 class="modal-title">Add a new Song!</h4>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto" >
		                    <img src='../img/logo/user.png' onclick='triggerClick()' id='profileDisplay'>
		                    <input class="input-img" type="file" name="imgfile" onchange="displayImage(this)" id="imgfile">
		                    <p>(click on icon to choose an image*)</p>
		            </div>
	        	</div>
				<div class="form-group">
					<input type="text" name="song_name" id="song_name" class="form-control mt-3 pl-3 hb" placeholder="Song name">
				</div>
				<div class="form-group">
					<input list="song_artists" type="text" name="song_artist_id" id="song_artist_id" class="form-control mt-3 pl-3 hb" placeholder="Song artist">
					  <datalist id="song_artists">
					  	<?php 
					  		$obj->getartistlist();
					  	 ?>
					  </datalist>
				</div>
				<div class="form-group">
					<input list="song_genres" type="text" name="song_genre_id" id="song_genre_id" class="form-control mt-3 pl-3 hb" placeholder="Song Genre">
					  <datalist id="song_genres">
					  	<?php 
					  		$obj->getgenrelist();
					  	 ?>
					  </datalist>
				</div>
				<div class="form-group">
					<input type="file" name="sngfile" id="sngfile" class="form-control mt-3 pl-3 hb" placeholder="Confirm your password here">
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button class="btn btn-login p-2 hb" id="addsong">Add Song</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="addGenreModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="genredata">
	      		<div class="form-group">
			      <div class="modal-header b-0 pb-0">
			        <h3 class="modal-title mx-auto" id="exampleModalLabel">Add a new Song Genre!</h3>
			        <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
	      		</div>
				<div class="form-group mt-4 mb-4-5">
					<input type="text" name="song_genre" id="song_genre" class="form-control pl-3 hb" placeholder="Enter a genre.">
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button class="btn btn-login p-2 hb" id="addgenrebtn">Add Genre</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="editGenreModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="editgenredata">
	      		<div class="form-group">
			      <div class="modal-header b-0 pb-0">
			        <h3 class="modal-title mx-auto" id="exampleModalLabel">Edit Song Genre!</h3>
			        <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
	      		</div>
				<div class="form-group mt-4 mb-5">
					<input type="text" name="edit_song_genre" id="edit_song_genre" class="form-control pl-3 hb" placeholder="Enter a genre.">
					<input type='hidden' id='getgenreid'>
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button class="btn btn-login p-2 hb" id="editgenrebtn">Update Genre</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="addArtistModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="addartistdata">
	      		<div class="form-group">
			      <div class="modal-header b-0 pb-0">
			        <h3 class="modal-title mx-auto" id="exampleModalLabel">Add Artist</h3>
			        <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto" >
		                    <img src='../img/logo/user.png' onclick='triggerClickArtist()' id='artistProfileDisplay'>
		                    <input class="input-img" type="file" name="imgfile" onchange="displayImageArtist(this)" id="artist_imgfile">
		                    <p>(click on icon to choose an image*)</p>
		            </div>
	        	</div>
				<div class="form-group mt-4 mb-5">
					<input type="text" name="artist_name" id="artist_name" class="form-control pl-3 hb" placeholder="Enter Artist Name">
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button class="btn btn-login p-2 hb" id="addartistbtn" name="addartistbtn">Add Artist</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="addUserModal" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content br-1 b-0">
	      <div class="modal-body">
	      	<form method="post" id="adduserdata">
	      		<div class="form-group">
			      <div class="modal-header b-0 pb-0">
			        <h3 class="modal-title mx-auto" id="exampleModalLabel">Add User</h3>
			        <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
	      		</div>
	      		<div class="form-group">
		            <div class="profilePhoto" >
		                    <img src='../img/logo/user.png' onclick='triggerClickArtist()' id='artistProfileDisplay'>
		                    <input class="input-img" type="file" name="imgfile" onchange="displayImageArtist(this)" id="artist_imgfile">
		                    <p>(click on icon to choose an image*)</p>
		            </div>
	        	</div>
				<div class="form-group mt-4">
					<input type="text" name="user_name" id="user_name" class="form-control pl-3 hb" placeholder="Enter User Name">
				</div>
				<div class="form-group mt-4">
					<input type="text" name="user_email" id="user_email" class="form-control pl-3 hb" placeholder="Enter User Email">
				</div>
				<div class="form-group mt-4 mb-5">
					<input type="text" name="user_password" id="user_password" class="form-control pl-3 hb" placeholder="Enter User Password">
				</div>
		        <div class="form-group mt-3">
		        	<div class="row m-0">
		        		<div class="col-6 pl-0">
				        	<button type="button" class="btn btn-close p-2 hb" data-dismiss="modal">Cancel</button>
				        </div>
				        <div class="col-6 pr-0">
				        	<button class="btn btn-login p-2 hb" id="addartistbtn" name="addartistbtn">Add User</button>
				        </div>
		        	</div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<p>All fileds are required and later can be modified!</p>
		        </div>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript">
		var ctx = document.getElementById('myChartUser').getContext('2d');
		var option={
			elements: {
				line: {
					tension: 0.4
				}
			}
		}
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ['jan', 'feb', 'mar', 'apr', 'may', 'jun','jul','aug','sep','oct','nov','dec',],
		        datasets: [{
		            label: 'No. of Users',
		            data: [
			            <?php 
										foreach($months as $val=>$val_num){
			            		$obj->count('user','u_month',$val_num);
			            		echo ",";
										}

			             ?>
		             ],
		            backgroundColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderWidth: 2
		        }]
		    },
		    options: option
		});
		var ctx = document.getElementById('myChartArtist').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ['jan', 'feb', 'mar', 'apr', 'may', 'jun','jul','aug','sep','oct','nov','dec',],
		        datasets: [{
		            label: 'No. of Artist',
		            data: [
			            <?php 
										foreach($months as $val=>$val_num){
			            		$obj->count('artist','a_month',$val_num);
			            		echo ",";
										}

			             ?>
		             ],
		            backgroundColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderWidth: 2
		        }]
		    },
		    options: option
		});
		var ctx = document.getElementById('myChartSong').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ['jan', 'feb', 'mar', 'apr', 'may', 'jun','jul','aug','sep','oct','nov','dec',],
		        datasets: [{
		            label: 'No. of Songs',
		            data: [
			            <?php 
										foreach($months as $val=>$val_num){
			            		$obj->count('song','s_month',$val_num);
			            		echo ",";
										}

			             ?>
		             ],
		            backgroundColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderWidth: 2
		        }]
		    },
		    options: option
		});
		var ctx = document.getElementById('myChartGenre').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ['jan', 'feb', 'mar', 'apr', 'may', 'jun','jul','aug','sep','oct','nov','dec',],
		        datasets: [{
		            label: 'No. of Genre',
		            data: [
			            <?php 
							foreach($months as $val=>$val_num){
			            		$obj->count('genre','g_month',$val_num);
			            		echo ",";
							}

			             ?>
		             ],
		            backgroundColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderColor: [
		                'rgba(39, 42, 104, 1)'
		            ],
		            borderWidth: 2
		        }]
		    },
		    options: option
		});
	</script>
</body>
</html>