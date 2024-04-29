<?php 
include 'includes/session.php';
include 'includes/conn.php';
class imglog{
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
}
$obj=new imglog();

function test_input($inputField){										
$inputField =htmlspecialchars(stripcslashes(strip_tags($inputField)));
return $inputField;
}
if (isset($_POST['login'])){
		$email=test_input($_POST['email']);
		$password=hash('sha256',test_input($_POST['password']));
		$query="SELECT email,password,type from user WHERE email='$email' AND password='$password' LIMIT 1";
		$stmt=mysqli_query($conn,$query);
		if(mysqli_num_rows($stmt) > 0){
		    $result =mysqli_fetch_assoc($stmt);
			    if($result['type']=="admin"){
					setcookie('admin',$email,time() + 300000);
					setcookie('pass',$password,time() + 300000);
					header('location: admin/index.php');	
					die();	    	
			    }
			    else{
					setcookie('user',$email,time() + 300000);
					setcookie('pass',$password,time() + 300000);
					header('location: userhome.php');
				    die();
				}
		}else{	
			$_SESSION['wrong_email']= $email;
			$_SESSION['error']= 'Sorry your email and password does not match please try again.';
			header('location: index.php');
			die();
		}
		$conn->close();
}elseif(isset($_POST['signup'])){
	$nemail=test_input($_POST['nemail']);
	$uname=test_input($_POST['uname']);
	$npassword=test_input($_POST['npassword']);
	$repassword=test_input($_POST['repassword']);
	$imgfile= $obj->insert_imgfile($_FILES['uprofile']);
	if((!empty($nemail)) && (!empty($npassword))  && (!empty($repassword)) && (!empty($uname))){
		if ($npassword != $repassword) {
			$_SESSION['pass_missmatch']='Your passwords are not similar';
			header('location: index.php');
			die();
		}else{
			$emailcheck="SELECT email from user WHERE email='$nemail' LIMIT 1";
			$stmt=mysqli_query($conn,$emailcheck);
			if(mysqli_num_rows($stmt) > 0){
				$_SESSION['email_exists']='Sorry the email has already been used';
				header('location: index.php');
				die();
			}else{
				$npassword=hash('sha256',$npassword);
				$insert = "INSERT INTO user (email,user_name,user_cover, password, u_month, u_day, u_year) VALUES ('$nemail','$uname','$imgfile', '$npassword', '". date("m") ."','". date("d") ."','". date("Y") ."')";
				$stmt=mysqli_query($conn,$insert);
				setcookie('user',$nemail,time() + 300000);
				setcookie('pass',$npassword,time() + 300000);
				header('location: userhome.php');
				die();
			}
		}
	}else{
		$_SESSION['empty_credit']='Please fill all the credintials.';
		header('location: index.php');
		die();
	}
}else{
		header('location: index.php');
		die();
}

 ?>