<?php 
include 'includes/oopconn.php';
class user extends db{
	public function getNum($table,$queuesearch)
	{	
		if($queuesearch==''){
			$sql="SELECT * FROM $table NATURAL JOIN artist ORDER BY s_id DESC";
		}else{
			$sql="SELECT * from $table NATURAL JOIN artist where s_name like '%".$queuesearch."%' order by s_id DESC ";
		}
		$result=$this->conn()->query($sql);
			$i=0;
		while($row=$result->fetch_assoc()){
	    	echo "<li class='nav-item ql cp' data-id=".$i." id=".$i." >".$row['s_name']. " - " .$row['artist_name']."</li>";
	    	$i++;
		}
	}
	public function artistplaysong($table,$artist_id)
	{
		if($artist_id==''){
			$sql="SELECT * FROM $table NATURAL JOIN artist ORDER BY s_id DESC";
		}else{
			$sql="SELECT * FROM $table NATURAL JOIN artist where artist_id='$artist_id' ORDER BY s_id DESC";
		}
			$result=$this->conn()->query($sql);
			$i=0;
			while($row=$result->fetch_assoc()){
		    	echo "<li class='nav-item ql cp' data-id=".$i." id=".$i." >".$row['s_name']. " - " .$row['artist_name']."</li>";
		    	$i++;
			}
	}
	public function listen($id){
		$sql="UPDATE song SET count = count + 1 WHERE s_id = '$id'";
		$result=$this->conn()->query($sql);
		echo $result;
	}
	public function getplaylistartist($table,$artist_id)
	{
		if($artist_id==''){
			$sql="SELECT * FROM $table NATURAL JOIN artist ORDER BY s_id DESC";
		}else{
			$sql="SELECT * FROM $table NATURAL JOIN artist where artist_id='$artist_id' ORDER BY s_id DESC";
		}

			$result=$this->conn()->query($sql);
			if($result->num_rows>0){
				echo "songs = [";
				while($row=$result->fetch_assoc()){
					echo "
					    {
					        name: '".$row['s_audioFile']."',
					        title: '".$row['s_name']."',
					        artist: '".$row['artist_name']."',
					        clipArt: '".$row['s_cover']."',
					    },
					";
				}
				echo "];";
			}else{
				echo "<tr><td class='trmsg'>Not Song named ".$search." found.<td><tr>";
			}
	}
    public function getplaylist($table,$search)
	{
		if($search==''){
			$sql="SELECT * FROM $table NATURAL JOIN artist ORDER BY s_id DESC";
		}else{
			$sql="SELECT * from $table NATURAL JOIN artist where s_name like '%".$search."%' order by s_id DESC ";
		}
			$result=$this->conn()->query($sql);
			if($result->num_rows>0){
				echo "songs = [";
				while($row=$result->fetch_assoc()){
					echo "
					    {
					        name: '".$row['s_audioFile']."',
					        title: '".$row['s_name']."',
					        artist: '".$row['artist_name']."',
					        clipArt: '".$row['s_cover']."',
					    },
					";
				}
				echo "];";
			}else{
				echo "<tr><td class='trmsg'>Not Song named ".$search." found.<td><tr>";
			}

	}
	public function getsong($table,$search){
		if($search==''){

			$sql="SELECT * FROM $table NATURAL JOIN artist ORDER BY s_id DESC";
		}else{
			$sql="SELECT * from $table NATURAL JOIN artist where s_name like '%".$search."%' order by s_id DESC ";
		}
		$result=$this->conn()->query($sql);
		if($result->num_rows>0){
			$i=0;
			while($row=$result->fetch_assoc()){
				echo "
						<a class='song-card cp'>
							<div class='card'>
									<img src=images/song-image/".$row['s_cover'].">
									<div class='card-content'>
										<p class='m-0'>".$row['s_name']."</p>
										<p>".$row['artist_name']."</p>
										<span class='material-icons-outlined playbtn' data-id='".$i."' id='".$i."' data-count='".$row['s_id']."'>play_arrow</span>
									</div>
							</div>
						</a>
				";
				$i++;
			}

		}else{
			echo "<tr><td class='trmsg'>Not Song named ".$search." found.<td><tr>";
		}	
	}
	public function getartist($table,$search){
		if($search==''){
		    $sql="SELECT * from $table ORDER BY artist_id DESC";
		}else{
			$sql="SELECT * from $table where artist_name like '%".$search."%' order by artist_id DESC limit 5 ";
		}
		$result=$this->conn()->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo "
						<div class='artcard'>
							<img src='images/song-image/".$row['artist_cover']."'>
							<h4 class='artistname'>".$row['artist_name']."</h4>
							<small>Artist</small>
							<button class='btn btn-login' data-id='".$row['artist_id']."' data-toggle='tab' href='#artistsonglist' id='artistsonglistbtn'>Songs</button>
						</div>
				";
			}
		}else{
			echo "<tr><td class='trmsg'>Not Artist named ".$search." found.<td><tr>";
		}	
	}
	public function getUserInfo($email,$field){
		$sql="SELECT $field from user where email='$email' ";
		$result=$this->conn()->query($sql);
		$row=$result->fetch_assoc();
		return $row[$field];
	}
	public function insert_imgfile($imgfileName){
	        $imgfileName=$_FILES['uprofile']['name'];
	        $imgsize=$_FILES['uprofile']['size'];
	        $imgtemp=$_FILES['uprofile']['tmp_name'];
	        $imgtype=$_FILES['uprofile']['type'];
	        $imgfileError=$_FILES['uprofile']['error'];
	        $imgfileExt=explode('.', $imgfileName);
	        $imgfileActExt=strtolower(end($imgfileExt));
	        $imgallowed =array('jpg' , 'jpeg','png');
	        if ( in_array($imgfileActExt, $imgallowed) ) {
	            if ($imgfileError === 0) {
	                        $str=rand(); 
	                        $result_id = md5($str);  
	                        $imgfileNewName="profile".$result_id.".".$imgfileActExt;
	                        $imgtarget='images/song-image/'.$imgfileNewName;
	                        move_uploaded_file($imgtemp, $imgtarget);
	                        return $imgfileNewName;
	                        echo 'image uploaded successfully';
	            }else{
	                echo "file was corrupted please try again with different file.";
	            }
	        }else{
	            echo 'Wrong file type only supports jpg, jpeg, png as image';
	        }
	}
	public function getuserid($id)
	{
		$sql="SELECT user_id from user where email='$id'";
		$result=$this->conn()->query($sql);
		$row=$result->fetch_assoc();
		return $row['user_id'];
	}
	public function check_password($hasholdpass,$id)
	{
		$sql="SELECT password from user WHERE user_id='$id' AND password='$hasholdpass' LIMIT 1";
		$result=$this->conn()->query($sql)->num_rows;
		if($result>0){
			return true;
		}else{
			return false;
		}
	}
}
$user= new user();
	if(isset($_POST['search_song_user'])){
		$search=$user->test_input($_POST['search_song_user']);
		$user->getsong('song',$search);
		echo("split");
		$user->getplaylist('song',$search);
		echo("split");
		$user->getNum('song',$search);
	}
	if(isset($_POST['search_artist_user'])){
		$search=$user->test_input($_POST['search_artist_user']);
		$user->getartist('artist',$search);
	}
	if(isset($_FILES['uprofile'])){
		$id=$user->test_input($_POST['id']);
		$email=$user->test_input($_POST['email']);
		$uname=$user->test_input($_POST['uname']);
		$password=$user->test_input($_POST['password']);
		$oldpassword=$user->test_input($_POST['oldpassword']);

		$hashnewpass=hash('sha256',$password);
		$hasholdpass=hash('sha256',$oldpassword);

		if($user->check_password($hasholdpass,$id)){
			$img=$user->insert_imgfile($_FILES['uprofile']);
			if($img==''){
				$sql="Update user set email='$email',password='$hashnewpass',user_name='$uname' where user_id='$id' ";
			}else{
				$sql="Update user set email='$email',password='$hashnewpass',user_name='$uname',user_cover='$img' where user_id='$id' ";
			}
			$result=$user->conn()->query($sql);
			setcookie('pass',$_COOKIE['pass'],time()-3600,'/pood');
			setcookie('user',$_COOKIE['user'],time()-3600,'/pood');

			setcookie('pass',$hashnewpass,time()+300000,'/pood');
			setcookie('user',$email,time()+300000,'/pood');
			echo "User updated successfully";
			return true;
		}else{
			echo "Sorry the password doesn't match!";
		}
	}
	if(isset($_POST['queuesearch'])){
		$queuesearch=$user->test_input($_POST['queuesearch']);
		$user->getNum('song',$queuesearch);
	}
	if(isset($_POST['artist_id'])){
		$artist_id=$user->test_input($_POST['artist_id']);
		$user->artistplaysong('song',$artist_id);
		echo("split");
		$user->getplaylistartist('song',$artist_id);
	}
	if(isset($_POST['artist_id_back'])){
		$artist_id=$user->test_input($_POST['artist_id_back']);
		$user->artistplaysong('song','');
		echo("split");
		$user->getplaylistartist('song','');
	}
	if(isset($_POST['count_id'])){
		$count_id=$user->test_input($_POST['count_id']);
		$user->listen($count_id);
	}



	if(isset($_POST['artistsonglistid'])){
		$id=$user->test_input($_POST['artistsonglistid']);
		/*$sql="SELECT * FROM song NATURAL JOIN artist where artist_id='$id'";*/
		$sql="SELECT artist_cover,artist_name FROM artist WHERE artist_id='$id'";
		$result=$user->conn()->query($sql);
		$row=$result->fetch_assoc();
			echo"
			<div class='artist-banner'>
				<img  src='images/song-image/".$row['artist_cover']."'>
				<div class='overlay'></div>
				<div class='banner-text'>".$row['artist_name']."</div>
				<div class='btn back' data-toggle='tab' href='#artist'><span class='material-icons-outlined'>arrow_back_ios</span></div>
			</div>
			<div class='artistplayfooter'>
				<button class='btn' id='playartistlistbtn'><span class='material-icons-outlined playartistlistbtn'>play_arrow</span></button>
				<h5 class='m-0 p-0'>Recent Song</h5>
			</div>
			<div class='artistsongslist'>
				<ul class='list-group'>
			";
			$user->conn()->close();
			$query="SELECT * from song where artist_id='$id' order by s_id DESC";
			$qresult=$user->conn()->query($query);
				if($qresult->num_rows>0){
					$i=0;
					while($row=$qresult->fetch_assoc()){
						echo "
							<li class='user-list' id='ul".$i."'>
								<div class='playingimage'>
									<img id='nowplayingimg' src='images/song-image/".$row['s_cover']."'>
									<div class='footerimgalt'>
										<div class='footersongname'>".$row['s_name']."</div>
									</div>
								</div>
								<div class='controller'>
									<div id='play' class='cp fbtn'><span class='material-icons-outlined artistplay' id='".$i."' data-id='".$i."' data-artist='".$id."'>play_arrow</span></div>
								</div>
							</li>
						";
						$i++;
					}
				}else{
					echo "<div class='trmsg'>Artist Has not registered any song yet.</div>";
				}	
			    echo"
				<ul>
			</div>
		";


	}
?>