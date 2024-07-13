<?php 
@include 'conf.php'; 
session_start();
if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phn = $_POST['phn'];
    $ophn = $_POST['ophn'];
    $address = $_POST['address'];
    $id = $_SESSION['uid'];

    if (empty($fname)) {
    	$em = "Full name is required";
    	header("Location: profile.php?error=$em");
	    exit;
    }else if(empty($uname)){
    	$em = "User name is required";
    	header("Location: profile.php?error=$em");
	    exit;
    }else {
        // $sql = "UPDATE users SET username='$name', email='$email', phone='$phn',optional_num='$ophn',address='$address' WHERE uid='$id'";
        // $result = $conn->query($sql);
        // if ($result == TRUE) {
        //     header("Location: profile.php?success=Your account has been updated successfully");
        // }else{
        //     echo "Error:" . $sql . "<br>" . $conn->error;
        // }
       	$sql = "UPDATE users SET username=?, address=?, phone=?,optional_phn=?,email=? WHERE uid=?";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$name, $address, $phn,$ophn,$email,$id]);

       	header("Location: profile.php?success=Your account has been updated successfully");
   	    exit;
      }
}

?>

   
 





