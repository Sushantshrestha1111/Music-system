<?php 
include '../includes/session.php';
include '../includes/oopconn.php';
	class operation extends db{
		public function insert($table,$field_arr){
			if($field_arr!=''){
				foreach ($field_arr as $key => $val) {
					$fieldarr[]=$key;
					$valuearr[]=$val;
				}
				$field=implode(",",$fieldarr);
				$value=implode("','",$valuearr);
				$value="'".$value."'";
				$sql="insert into $table($field) values($value) ";
				$result=$this->conn()->query($sql);
				echo $sql;
			}else{
				echo "Please fill all the field";
			}
		}
		public function insert_imgfile($imgfileName){
		        $imgfileName=$_FILES['imgfile']['name'];
		        $imgsize=$_FILES['imgfile']['size'];
		        $imgtemp=$_FILES['imgfile']['tmp_name'];
		        $imgtype=$_FILES['imgfile']['type'];
		        $imgfileError=$_FILES['imgfile']['error'];
		        $imgfileExt=explode('.', $imgfileName);
		        $imgfileActExt=strtolower(end($imgfileExt));
		        $imgallowed =array('jpg' , 'jpeg','png');
		        if ( in_array($imgfileActExt, $imgallowed) ) {
		            if ($imgfileError === 0) {
		                        $str=rand(); 
		                        $result_id = md5($str);  
		                        $imgfileNewName="profile".$result_id.".".$imgfileActExt;
		                        $imgtarget='../images/song-image/'.$imgfileNewName;
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
		public function insert_sngfile($sngfileName){
	        $sngfileName=$_FILES['sngfile']['name'];
	        $sngsize=$_FILES['sngfile']['size'];
	        $sngtemp=$_FILES['sngfile']['tmp_name'];
	        $sngtype=$_FILES['sngfile']['type'];
	        $sngfileError=$_FILES['sngfile']['error'];  
	        $sngfileExt=explode('.', $sngfileName);
	        $sngfileActExt=strtolower(end($sngfileExt));
	        $sngallowed =array('mp3' , 'wav' , 'ogg');
		        if (in_array($sngfileActExt, $sngallowed) ) {
		            if ($sngfileError === 0) {
	                        $str=rand(); 
	                        $result_id = md5($str);  
	                        $sngfileNewName="profile".$result_id.".".$sngfileActExt;
	                        $sngtarget='../music/'.$sngfileNewName;
	                        move_uploaded_file($sngtemp, $sngtarget);
	                        return $sngfileNewName;
	                        echo 'image uploaded successfully';
		            }else{
		                echo "file was corrupted please try again with different file.";
		            }
		        }else{
		            echo 'Wrong file type only supports .mp3,.wav and .ogg as music.';
		        }
		}
		public function addnewsong($song_name,$song_artist_id,$song_genre_id,$sngfile,$imgfile){
			if( (!empty($song_name)) && (!empty($song_artist_id)) && (!empty($song_genre_id)) && (!empty($sngfile)) && (!empty($imgfile)) )
			{
			    if($this->checksong($song_name,$song_artist_id)==false){
	                $imgfileNewName=$this->insert_imgfile($imgfile);
	                $sngfileNewName=$this->insert_sngfile($sngfile);
	                $sql="INSERT INTO song(s_cover,s_name,artist_id,s_audioFile,g_id) VALUES('$imgfileNewName','$song_name','$song_artist_id','$sngfileNewName','$song_genre_id')";
					$this->conn()->query($sql);

	                 echo 'song registered successfully';
	            }else{
	                echo "Sorry but the song name is already registered with the same artist.";   
	            }
		    }
		    else{
		    	echo "PLease fill all fileds";
		    }
		}
	    public function editsong($id,$song_name,$edit_artist_id,$sngfile,$imgfile){
	    	
            if(!empty($sngfile)){
            	$sngfileNewName=$this->insert_sngfile($sngfile);
                $sql="update song set s_audioFile='$sngfileNewName' where s_id='$id'";
            	$this->conn()->query($sql);
        	}else{
            	echo "song file is empty.";
        	}
        	if(!empty($imgfile)){
            	$imgfileNewName=$this->insert_imgfile($imgfile);
                $sql="update song set s_cover='$imgfileNewName' where s_id='$id'";
                $this->conn()->query($sql);
        	}else{
            	echo "image file is empty.";
        	}
	    	if( (!empty($song_name)) && (!empty($edit_artist_id)) && (!empty($id)) )
	    	{
                $sql="update song set s_name='$song_name',artist_id='$edit_artist_id' where s_id='$id'";
                echo 'song updated successfully';
                $this->conn()->query($sql);

	    	}else{
	    		echo "Please fill all the fields";
	    	}
		}
		public function adduser($name,$email,$password){
	    	if( (!empty($name)) && (!empty($email)) && (!empty($password)) )
			{
				$hashpass=hash('sha256',$password);
				$sql="INSERT INTO user(user_name,email,password) VALUES('$name','$email','$hashpass')";
				$this->conn()->query($sql);
				echo "User Insertion success";
			}else{
				echo "PLease Fill in all the fileds!";
			}
		}
		public function checksong($song_name,$song_artist_id){
            $sql="SELECT s_name,artist_id from song NATURAL JOIN artist where s_name='$song_name' AND artist_id='$song_artist_id' LIMIT 1";
			echo $sql;
			$result=$this->conn()->query($sql);
			return $result->fetch_assoc() ? true : false;

		}
		public function check($table,$attribute_name,$attribute_data){
			$sql="SELECT $attribute_name from $table where $attribute_name='$attribute_data'";
			echo $sql;
			$result=$this->conn()->query($sql);
			return $result->fetch_assoc() ? true : false;
		}
		public function delete($table,$attribute_name,$id)
		{
			$sql="delete from $table where $attribute_name='$id' ";
			$this->conn()->query($sql);
			echo "deleted artist with id".$id." lol";
		}
		public function search($table,$search_artist,$name,$id){
			$sql="SELECT * from ".$table." where $name like '%".$search_artist."%' order by $id DESC limit 5 ";
			$obj1=new db();
			$obj1->getList('artist','artist_id',$sql,'artist_name','artist_view','artist_cover','artist_reg_date','total_album','a_day','a_month','a_year');
		}
		public function searchUser($table,$search_user,$name,$id){
			$sql="SELECT * from ".$table." where $name like '%".$search_user."%' order by $id DESC limit 5 ";
			$obj1=new db();
			$obj1->getUserList('user','user_id',$sql,'email','reg_date','user_cover');
		}
		public function update($table,$id,$name){
			$sql="UPDATE ".$table." SET artist_name='".$name."' where artist_id='".$id."' ";
			$this->conn()->query($sql);
			echo "Song Updation success!!";
		}
		public function updateuser($table,$id,$name,$uname,$pass){
			$hashpass=hash('sha256',$pass);
			$sql="UPDATE ".$table." SET email='".$name."',user_name='".$uname."',password='".$hashpass."' where user_id='".$id."' ";
			$this->conn()->query($sql);
			echo "User Updation success!!";
		}
	}
	$obj= new operation();
	if(isset($_POST['artist_name'])){
		$name=$obj->test_input($_POST['artist_name']);
		if($obj->check('artist','artist_name',$name)==false){
			$imgfile= $obj->insert_imgfile($_POST['imgfile']);
			$field_arr=array('artist_name'=>$name, 'artist_cover'=>$imgfile);
			$obj->insert('artist',$field_arr);
		}else{
			echo "sorry the name is already taken";
		}
	}
	if(isset($_POST['delete_artist'])){
		$id = $obj->test_input($_POST['delete_artist']);
		$obj->delete('artist','artist_id',$id);
	}
	if(isset($_POST['delete_user'])){
		$id = $obj->test_input($_POST['delete_user']);
		$obj->delete('user','user_id',$id);
	}
	if(isset($_POST['search_artist'])){
		$search_artist= $obj->test_input($_POST['search_artist']);
		$obj->search('artist',$search_artist,'artist_name','artist_id');
	}
	if(isset($_POST['search_user'])){
		$search_user= $obj->test_input($_POST['search_user']);
		$obj->searchUser('user',$search_user,'email','user_id');
	}
	if(isset($_POST['edit_artist_name'])){
		$name=$obj->test_input($_POST['edit_artist_name']);
		$id=$obj->test_input($_POST['edit_artist_id']);
		$cover=$_FILES['edit_artist_imgfile'];
		$obj->update('artist',$id,$name);
	}

	if(isset($_POST['edit_user_name'])){
		$name=$obj->test_input($_POST['edit_user_name']);
		$id=$obj->test_input($_POST['edit_user_id']);
		$cover=$_FILES['edit_user_imgfile'];
		$pass=$_POST['edit_user_password'];
		$uname=$_POST['edit_user_uname'];

		$obj->updateuser('user',$id,$name,$uname,$pass);
	}
	if(isset($_POST['artistNewCount'])){
		$obj->getList('artist','artist_id','','artist_name','artist_view','artist_cover','artist_reg_date','total_album','a_day','a_month','a_year');
	}
	if(isset($_POST['songNewCount'])){
		$songNewCount=$obj->test_input($_POST['songNewCount']);
		$obj->getrecent('song',$songNewCount,'');
	}
	if(isset($_POST['search_song'])){
		$search=$obj->test_input($_POST['search_song']);
		$obj->getrecent('song','',$search);
	}
	if(isset($_POST['song_name'])){
        $song_name=$obj->test_input($_POST['song_name']);
        $song_artist_id=$obj->test_input($_POST['song_artist_id']);
        $song_genre_id=$obj->test_input($_POST['song_genre_id']);
        $sngfile=$_FILES['sngfile'];
        $imgfile =$_FILES['imgfile'];

        $obj->addnewsong($song_name,$song_artist_id,$song_genre_id,$sngfile,$imgfile);
	}
	if(isset($_POST['edit_song_name']))
	{
		$id = $obj->test_input($_POST['edit_song_id']);
		$song_name = $obj->test_input($_POST['edit_song_name']);
		$edit_artist_id = $obj->test_input($_POST['edit_artist_id']);
		$sngfile = $_FILES['sngfile'];
		$imgfile = $_FILES['imgfile'];

		$obj->editsong($id,$song_name,$edit_artist_id,$sngfile,$imgfile);
	}
	if(isset($_POST['user_name']))
	{
		$uname=$obj->test_input($_POST['user_name']);
		$uemail=$obj->test_input($_POST['user_email']);
		$upassword=$obj->test_input($_POST['user_password']);

		$obj->adduser($uname,$uemail,$upassword);
	}
 ?>