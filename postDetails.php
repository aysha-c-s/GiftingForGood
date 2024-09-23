<?php
@include 'conf.php';
session_start();
if (isset($_GET['pid'])) {
    // Store the pid in the session
    $_SESSION['pid'] = $_GET['pid'];
}
if (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
  $sql = "SELECT * FROM posts INNER JOIN users on posts.uid=users.uid WHERE pid='$pid'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //$_SESSION['username']= $row['username'];
	$uid=$row['uid'];
    $name = $row['username'];
    $Area = $row['Area'];
    $Full_address = $row['Full_address'];
    $short_description = $row['short_description'];
    $type = $row['type'];
	$amount = $row['amount'];
	$Expire_date = $row['Expire_date'];
	$photo = $row['photo'];
	$status=$row['status'];
  }
}

// Update the post status if the form is submitted
if (isset($_POST['claim_post'])) {
    $postId = $_POST['post_id'];
    $updateQuery = "UPDATE posts SET status='claimed' WHERE pid='$postId'";
    mysqli_query($conn, $updateQuery);
	$ruid=$_SESSION['uid'];
	$rQuery = "UPDATE admin SET ruid='$ruid' WHERE pid='$postId'";
    mysqli_query($conn, $rQuery);
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="postDetails.css">
    <title>Post Details</title>
</head>

<body>

	<div class="outer-div">
        <div class="container">
            <p><strong>Donor:</strong><?php echo $name;?></p>
			<p><strong>Area:</strong><?php echo $Area;?></p>
			<p><strong>Detailed address:</strong><?php echo $Full_address;?></p>
			<p><strong>Description:</strong><?php echo $short_description;?></p>
			<p><strong>Type of food:</strong><?php echo $type;?></p>
			<p><strong>Amount:</strong><?php echo $amount;?></p>
			<p><strong>Expiration date:</strong><?php echo $Expire_date;?></p>
            <div class="buttons">
				<?php 
				if($uid == $_SESSION['uid']){ ?>
					<button style="float:left" class="btn btn-secondary">Edit post</button>
				<?php } ?>
				<button style="float:right; margin-left:10px" class="btn btn-primary" onclick="location.href='UserHome.php'">Back</button>
				
				<!-- Button trigger modal -->
				<?php
				if($uid != $_SESSION['uid'] && $status == 'unclaimed'){ ?>
                <button type="button" style="float:right" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Claim
				</button>
				<?php } 
				
				if($uid != $_SESSION['uid'] && $status == 'claimed'){ ?>
				<button type="button" style="float:right" class="btn btn-success" disabled data-bs-toggle="button" 
				autocomplete="off">Claimed</button>
				<?php } 
				
				if($status == 'expired'){ ?>
				<button type="button" style="float:right" class="btn btn-danger" disabled data-bs-toggle="button" 
				autocomplete="off">Expired</button>
				<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		Are you sure you want to claim this donation?
      </div>
      <div class="modal-footer">
        <form method="post" action="">
            <input type="hidden" name="post_id" value="<?php echo $pid; ?>">
                <button type="submit" name="claim_post"
                class="btn btn-danger">Yes</button>
        </form>
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
                
            </div>
			
			
        </div>
    </div>
    
	

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>