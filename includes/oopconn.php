<?php 
	class db{
		public function conn(){
			$conn =new mysqli("localhost","root","","puud");
			return $conn;
			if($conn->connect_error){
				echo "Error-code:100";
			}
		}
		public function test_input($inputField){
			$inputField =htmlspecialchars(stripcslashes(strip_tags(trim($inputField))));
			return $inputField; 
		}
		public function getartistlist(){
			$sql="SELECT artist_name,artist_id FROM artist";
			$result=$this->conn()->query($sql);

			while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row['artist_id']."'>".$row['artist_name']."</option>";
			}
		}	
		public function getgenrelist(){
			$sql="SELECT g_name,g_id FROM genre";
			$result=$this->conn()->query($sql);
			while($row=$result->fetch_assoc())
			{
				echo "<option value='".$row['g_id']."'>".$row['g_name']."</option>";
			}		
		}
		public function getSize($table,$col_name){
			$sql="SELECT SUM($col_name) from $table";
			echo $this->conn()->query($sql);
		}
		public function getCount($table){
			echo $this->conn()->query("SELECT * from $table")->num_rows;
		}
		public function count($table,$col_name,$col_value){
			echo $this->conn()->query("SELECT $col_name from $table where $col_name='$col_value'")->num_rows;
		}

		public function getrecent($table,$count,$search){
		if(empty($count) && empty($search)){
			$sql="SELECT * FROM song NATURAL JOIN artist ORDER BY s_id DESC limit 5"; 
		}
		if(!empty($search)){
		    $sql="SELECT * from song NATURAL JOIN artist where s_name like '%".$_POST['search_song']."%' ORDER By `song`.`s_id` DESC limit 5";
		}
		if(!empty($count)){
			$sql="SELECT * FROM song NATURAL JOIN artist ORDER BY s_id DESC limit $count"; 
		}
		$result=$this->conn()->query($sql);

			if(mysqli_num_rows($result)>0){
				while($row =mysqli_fetch_assoc($result)){ 
					echo "<tr id='".$row['s_id']."'>
							<td data-src='cover'><img id='imageupdate".$row['s_id']."' src='../images/song-image/".$row['s_cover']."'><p class='none'>".$row['s_cover']."</p></td> 
							<td data-target='name' id='nameadd'>".$row['s_name']."</td>
							<td data-target='artist'>".$row['artist_name']."</td> 
							<td data-target='artist_id' class='none'>".$row['artist_id']."</td> 

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
		}
		public function getList($table,$id,$sql='',$name,$view='',$cover,$reg_date,$t_album='',$day,$month,$year){
			if($sql==''){
				$sql="SELECT * from $table order by $id DESC";
			}
			$result=$this->conn()->query($sql);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					$count=$row["$id"];
					$res=$this->conn()->query("SELECT * from song where artist_id='$count'")->num_rows;
					echo "
					<tr id=artist".$row["$id"]."> 
							<td data-src='cover'><img id='artistimageupdate".$row["$id"]."' src='../images/song-image/".$row["$cover"]."'><p class='none'>".$row["$cover"]."</p></td> 
							<td data-target='name' id='nameadd'>".$row["$name"]."</td>
							<td data-target='song'>".$res."</td> 
							<td data-target='reg_date'>".$row["$reg_date"]."</td>
							<td>
								<button data-id='".$row["$id"]."' data-role='artistupdate' name='artist_edit' id='artist_edit' class='btn btn-success' data-toggle='modal' data-target='#editArtistModal'><i class='fas fa-pen' alt='edit'></i></button>
								<button onclick='delete_artist(".$row["$id"].")' name='delete_song' id='delete_song' class='btn btn-danger'><i class='far fa-trash-alt'></i></button>
						</td>
					</tr>";
				}
			}else{
			echo "<tr><td colspan=5 style='text-align:center;font-weight:bold;'>Not Found<td><tr>";
			}
		}
		public function getUserList($table,$id,$sql='',$email,$reg_date,$cover){
			if($sql==''){
				$sql="SELECT * from $table order by $id DESC";
			}
			$result=$this->conn()->query($sql);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr id=editUser".$row["$id"]."> 
							<td data-src='cover'><img id='userimageupdate".$row["$id"]."' src='../images/song-image/".$row["$cover"]."'><p class='none'>".$row["$cover"]."</p></td> 
							<td data-target='email' id='nameadd'>".$row["$email"]."</td>
							<td data-target='uname' id='nameadd' class='none'>".$row["user_name"]."</td>
							<td data-target='reg_date'>".$row["$reg_date"]."</td>
							<td>
								<button data-id='".$row[$id]."' data-role='userupdate' name='user_edit' id='user_edit' class='btn btn-success' data-toggle='modal' data-target='#editUserModal'><i class='fas fa-pen' alt='edit'></i></button>
								<button onclick='delete_user(".$row["$id"].")' name='delete_user' id='delete_user' class='btn btn-danger'><i class='far fa-trash-alt'></i></button>
						    </td>
					</tr>";
				}
			}else{
				echo "<tr><td colspan=5 style='text-align:center;font-weight:bold;'>Not Found<td><tr>";
			}
		}

		public function checkid($email,$password,$type)// to check cookie for admin and user
		{
			$sql="SELECT email,password FROM user where email='$email' AND password='$password'";
			return $this->conn()->query($sql)->fetch_assoc() ? true : false;
		}
	}
