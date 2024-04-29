<?php 
include '../includes/session.php';
include '../includes/conn.php';
	function test_input($inputField){										
	$inputField =htmlspecialchars(stripcslashes(strip_tags(trim($inputField))));
	return $inputField; 
	}
if (isset($_COOKIE['admin'])){
  /*	if (isset($_POST['songNewCount'])) {
		$songNewCount = $_POST['songNewCount'];
		$query="SELECT * FROM song ORDER BY `song`.`s_id` DESC limit $songNewCount"; 
		$result = mysqli_query($conn,$query); 
			if(mysqli_num_rows($result)>0){
				while($row =mysqli_fetch_assoc($result)){ 
					echo "<tr id='".$row['s_id']."'>
							<td data-src='cover'><img id='imageupdate".$row['s_id']."' src='../images/song-image/".$row['s_cover']."'><p class='none'>".$row['s_cover']."</p></td> 
							<td data-target='name' id='nameadd'>".$row['s_name']."</td>
							<td data-target='artist'>".$row['s_artist']."</td> 
							<td data-target='reg_date'>".$row['s_reg_date']."</td>
							<td data-src='audio' class='none'>".$row['s_audioFile']."</td>
							<td>
								<button data-id='".$row['s_id']."' data-role='update' name='song_edit' id='song_edit' class='btn btn-success' data-toggle='modal' data-target='#editSongModal'><i class='fas fa-pen' alt='edit'></i></button>
								<button onclick='delete_song(".$row['s_id'].")' name='delete_song' id='delete_song' class='btn btn-danger'><i class='far fa-trash-alt'></i></button>
							</td>
						</tr>"; 
				}
			}else{
				echo "There are no songs!!!";
			}
	}*/
	if(isset($_FILES['imgfile'])){
        $song_name=test_input($_POST['song_name']);
        $song_artist_id=test_input($_POST['song_artist_id']);
        $song_genre_id=test_input($_POST['song_genre_id']);
        $sngfile=$_FILES['sngfile'];
        $imgfile =$_FILES['imgfile'];

		if( (!empty($song_name)) && (!empty($song_artist_id)) && (!empty($song_genre_id)) && (!empty($sngfile)) && (!empty($imgfile)) )
		{
	        $imgfileName=$_FILES['imgfile']['name'];
	        $imgsize=$_FILES['imgfile']['size'];
	        $imgtemp=$_FILES['imgfile']['tmp_name'];
	        $imgtype=$_FILES['imgfile']['type'];
	        $imgfileError=$_FILES['imgfile']['error'];
	        $imgfileExt=explode('.', $imgfileName);
	        $imgfileActExt=strtolower(end($imgfileExt));
	        $imgallowed =array('jpg' , 'jpeg', 'png');

	        $sngfileName=$_FILES['sngfile']['name'];
	        $sngsize=$_FILES['sngfile']['size'];
	        $sngtemp=$_FILES['sngfile']['tmp_name'];
	        $sngtype=$_FILES['sngfile']['type'];
	        $sngfileError=$_FILES['sngfile']['error'];  
	        $sngfileExt=explode('.', $sngfileName);
	        $sngfileActExt=strtolower(end($sngfileExt));
	        $sngallowed =array('mp3' , 'wav' , 'ogg');

	        if ( in_array($imgfileActExt, $imgallowed) && in_array($sngfileActExt, $sngallowed) ) {
	            if ($imgfileError === 0 && $sngfileError === 0) {
	                    $query="SELECT s_name,artist_id from song NATURAL JOIN artist where s_name=? AND artist_id=? LIMIT 1";
	                    $stmt = $conn->prepare($query);
	                    $stmt -> bind_param("si", $song_name,$song_artist_id);
	                    $stmt -> execute();
	                    $stmt -> bind_result($song_name,$song_artist_id);
	                    $stmt ->store_result();
	                    if(!$stmt->fetch()){
	                        $str=rand(); 
	                        $result_id = md5($str);  
	                        $imgfileNewName="profile".$result_id.".".$imgfileActExt;
	                        $imgtarget='../images/song-image/'.$imgfileNewName;
	                        move_uploaded_file($imgtemp, $imgtarget);
	                        $sngfileNewName="profile".$result_id.".".$sngfileActExt;
	                        $sngtarget='../music/'.$sngfileNewName;
	                        move_uploaded_file($sngtemp, $sngtarget);
	                        $stmt->close();
	                        $stmt = $conn->prepare("INSERT INTO song(s_cover,s_name,artist_id,s_audioFile,s_size,g_id) VALUES(?,?,?,?,?,?)");
	                        $stmt -> bind_param("ssisii",$imgfileNewName, $song_name, $song_artist_id,$sngfileNewName,$sngsize,$song_genre_id);
	                        $stmt -> execute();
	                         echo 'song registered successfully';
	                    }else{
	                        echo "Sorry but the song name is already registered with the same artist."; 
	                        echo $sngsize/(1024*1024);    
	                    }
	                    $stmt->close();
	                    $conn->close();
	            }else{
	                echo "file was corrupted please try again with different file.";
	            }
	        }else{
	            echo 'Wrong file type only supports jpg, jpeg, png as image and mp3,wav,ogg as music.';
	        }
	    }
	    else{
	    	echo "PLease fill all fileds";
	    }
	}
	if(isset($_POST['delete_song'])){

		$id = $_POST['delete_song'];
		$sql = "DELETE FROM song WHERE s_id=$id";
		if (mysqli_query($conn, $sql)) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
/*	if(isset($_FILES['edit_imgfile'])){
		$id = $_POST['edit_song_id'];
		$song_name = $_POST['edit_song_name'];
		$song_artist = $_POST['edit_song_artist'];
		$sngfile = $_FILES['edit_sngfile'];
		$imgfile = $_FILES['edit_imgfile'];

	        $imgfileName=$_FILES['edit_imgfile']['name'];
	        $imgsize=$_FILES['edit_imgfile']['size'];
	        $imgtemp=$_FILES['edit_imgfile']['tmp_name'];
	        $imgtype=$_FILES['edit_imgfile']['type'];
	        $imgfileError=$_FILES['edit_imgfile']['error'];
	        $imgfileExt=explode('.', $imgfileName);
	        $imgfileActExt=strtolower(end($imgfileExt));
	        $imgallowed =array('jpg' , 'jpeg', 'png');

	        $sngfileName=$_FILES['edit_sngfile']['name'];
	        $sngsize=$_FILES['edit_sngfile']['size'];
	        $sngtemp=$_FILES['edit_sngfile']['tmp_name'];
	        $sngtype=$_FILES['edit_sngfile']['type'];
	        $sngfileError=$_FILES['edit_sngfile']['error'];  
	        $sngfileExt=explode('.', $sngfileName);
	        $sngfileActExt=strtolower(end($sngfileExt));
	        $sngallowed =array('mp3' , 'wav' , 'ogg');

                $query="SELECT s_name,s_artist from song where s_name=? AND s_artist=? LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt -> bind_param("ss", $song_name,$song_artist);
                $stmt -> execute();
                $stmt -> bind_result($song_name,$song_artist);
                $stmt ->store_result();               	
                    $str=rand(); 
                    $result_id = md5($str);  
                    $imgfileNewName="profile".$result_id.".".$imgfileActExt;
                    $imgtarget='../images/song-image/'.$imgfileNewName;
                    move_uploaded_file($imgtemp, $imgtarget);
                    $sngfileNewName="profile".$result_id.".".$sngfileActExt;
                    $sngtarget='../music/'.$sngfileNewName;
                    move_uploaded_file($sngtemp, $sngtarget);
                    if (in_array($imgfileActExt, $imgallowed)) {
				        if ($imgfileError === 0) {
				        	$stmt->close();
		                    $stmt = $conn->prepare("update song set s_cover=? where s_id=$id");
		                    $stmt -> bind_param("s",$imgfileNewName);
		                    $stmt -> execute();
				        	echo "image uploaded.";
				        }
                    }else{
                    	echo "image not updated.";
                    }
                    if (in_array($sngfileActExt, $sngallowed)) {
				        if ($sngfileError === 0) {
				        	$stmt->close();
		                    $stmt = $conn->prepare("update song set s_audioFile=? where s_id=$id");
		                    $stmt -> bind_param("s",$sngfileNewName);
		                    $stmt -> execute();
				        	echo "song uploaded.";
				        }
				    }else{
				    	echo "audio not updated.";
				    }
		        	$stmt->close();
                    $stmt = $conn->prepare("update song set s_name=?,s_artist=? where s_id=$id");
                    $stmt -> bind_param("ss",$song_name,$song_artist);
                    $stmt -> execute();
                    echo 'song name and artist updated successfully';
                $stmt->close();
                $conn->close();
	}*/
	if (isset($_POST['search_song'])) {
		$search=test_input($_POST['search_song']);
		$search="SELECT * from song where s_name like '%".$_POST['search_song']."%' ORDER By `song`.`s_id` DESC limit 5";
		$result=mysqli_query($conn,$search);
		if(mysqli_num_rows($result)>0){
			while ($row=mysqli_fetch_assoc($result)) {
				echo "<tr id='".$row['s_id']."'>
						<td data-src='cover'><img id='imageupdate".$row['s_id']."' src='../images/song-image/".$row['s_cover']."'><p class='none'>".$row['s_cover']."</p></td> 
						<td data-target='name'>".$row['s_name']."</td>
						<td data-target='artist'>".$row['s_artist']."</td> 
						<td data-target='reg_date'>".$row['s_reg_date']."</td>
						<td data-src='audio' class='none'>".$row['s_audioFile']."</td>
						<td>
							<button data-id='".$row['s_id']."' data-role='update' name='song_edit' id='song_edit' class='btn btn-success' data-toggle='modal' data-target='#editSongModal'><i class='fas fa-pen' alt='edit'></i></button>
							<button onclick='delete_song(".$row['s_id'].")' name='delete_song' id='delete_song' class='btn btn-danger'><i class='far fa-trash-alt'></i></button>
						</td>
					</tr>";
			}
		}else{
			echo "<tr><td colspan=5 style='text-align:center;font-weight:bold;'>no song named ".$_POST['search_song']." found<td><tr>";
		}
	}
	if (isset($_POST['search_genre'])) {
		$query="SELECT * from genre where g_name like '%".$_POST['search_genre']."%' ORDER By `genre`.`g_id` DESC";
		$class=['gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight','gradientone','gradienttwo','gradientthree','gradientfour','gradientfive','gradientsix','gradientseven','gradienteight'] ;
		$result = mysqli_query($conn,$query);
		echo"
			<a class='genre-card cp' data-toggle='modal' data-target='#addGenreModal'>
				<div class='card'>
					<h3 style='text-align:center;color:var(--font-color);'>Add Genre <i class='fas fa-plus-square'></i></h3>
				</div>
			</a>";
		if(mysqli_num_rows($result)>0){
			$n=0;
			while ($row=mysqli_fetch_assoc($result)) {
			for($i=$n;$i<=count($class)-1;$i++){
				echo"
				<a class='genre-card' href='#' id='genre".$row['g_id']."'>
					<div class='card ".$class[$i]."'>
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
			echo "No genre found named ".$_POST['search_genre']."";
		}
	}
	if(isset($_POST['genre'])){
		$genre =test_input($_POST['genre']);
		if (!empty($genre)) {
	        $query="SELECT g_name from genre where g_name=? LIMIT 1";
	        $stmt = $conn->prepare($query);
	        $stmt -> bind_param("s", $genre);
	        $stmt -> execute();
	        $stmt -> bind_result($genre);
	        $stmt ->store_result();
	        if(!$stmt->fetch()){
	            $stmt = $conn->prepare("INSERT INTO genre(g_name) VALUES(?)");
	            $stmt -> bind_param("s",$genre);
	            $stmt -> execute();
	             echo 'genre registered successfully';      	
	        }	else{
	        	echo "Genre Already exist";
	        }
		}else{
			echo "Please fill in the filed!";
		}
	}
	if (isset($_POST['genre_id'])) {
		$id=test_input($_POST['genre_id']);
		if(!empty($id)){
			$sql="DELETE from genre where g_id=$id";
			if (mysqli_query($conn, $sql)) {
			    echo "Genre deleted successfully";
			} else {
			    echo "Error deleting genre: " . mysqli_error($conn);
			}
			mysqli_close($conn);
		}else{
			echo "please chose a genre to delete!!";
		}
	}
	if (isset($_POST['editgenreid'])) {
		$id=test_input($_POST['editgenreid']);
		$editgenre=test_input($_POST['editgenre']);
		if(!empty($id)){
			$sql="UPDATE genre set g_name='$editgenre' where g_id=$id";
			if (mysqli_query($conn, $sql)) {
			    echo "Genre Updated successfully";
			} else {
			    echo "Error Updating genre: " . mysqli_error($conn);
			}
			mysqli_close($conn);			
		}else{
			echo"please choose a genre to update!!!";
		}
	}
}else{
	header('location: ../');
	die();
}
?>
