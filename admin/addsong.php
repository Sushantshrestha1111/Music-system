<?php
include '../includes/session.php';
include '../includes/conn.php';
    function test_input($inputField){                                       
    $inputField =htmlspecialchars(stripcslashes(strip_tags($inputField)));
    return $inputField; 
    }
if(isset($_FILES['imgfile']))
{
        $song_name=test_input($_POST['song_name']);
        $song_artist=test_input($_POST['song_artist']);
        $sngfile=$_FILES['sngfile'];
        $imgfile =$_FILES['imgfile'];

        $imgfileName=$_FILES['imgfile']['name'];
        $imgsize=$_FILES['imgfile']['size'];
        $imgtemp=$_FILES['imgfile']['tmp_name'];
        $imgtype=$_FILES['imgfile']['type'];
        $imgfileError=$_FILES['imgfile']['error'];
        $imgfileExt=explode('.', $imgfileName);
        $imgfileActExt=strtolower(end($imgfileExt));
        $imgallowed =array('jpg' , 'jpeg');

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
                    $query="SELECT s_name,s_artist from song where s_name=? AND s_artist=? LIMIT 1";
                    $stmt = $conn->prepare($query);
                    $stmt -> bind_param("ss", $song_name,$song_artist);
                    $stmt -> execute();
                    $stmt -> bind_result($song_name,$song_artist);
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
                        $stmt = $conn->prepare("INSERT INTO song(s_cover,s_name,s_artist,s_audioFile) VALUES(?,?,?,?)");
                        $stmt -> bind_param("ssss",$imgfileNewName, $song_name, $song_artist,$sngfileNewName);
                        $stmt -> execute();
                         echo 'song registered successfully';
                    }else{
                        echo "Sorry but the song name is already registered with the same artist.";     
                    }
                    $stmt->close();
                    $conn->close();
            }else{
                echo "file was corrupted please try again with different file.";
            }
        }else{
            echo 'Wrong file type only supports jpg and jpeg as image and mp3,wav,ogg as music.';
        }
}











/*$name=$_POST['song_name'];
$email=$_POST['song_artist'];
$address=$_POST['sngfile'];

    $conn1 = new mysqli('localhost','root','','project');
    if($conn1->connect_errno!=0){
        die("connection failed");
    }
    $sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$address')";
   
    if($conn1->query($sql)){
        $_SESSION['success']='song registered successfully';
    }
    else{
        echo"error";
    }*/
    
    
?>