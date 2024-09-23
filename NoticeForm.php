<?php

@include 'conf.php';

if (isset($_POST['submit'])) {
  $location = $_POST['location'];
  $description = $_POST['description'];

  $query = "INSERT INTO notices (location, description) VALUES ('$location', '$description')";

  $res = $conn->query($query);
  if ($res == TRUE) {
    header('location:AdminPage.php');
  }
  $conn->close();
};
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Notice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="NoticeForm.css">
</head>

<body>
  <div class="book">
    <div class="container">
      <div class="main-text">
        <h1>Post Emergency Notice</h1>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8 py-3 py-md-0">
          <form action="" method="post">
            <?php
            if (isset($error)) {
              foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
              };
            };
            ?>
            <input type="text" class="form-control" name="location" placeholder="Location" required><br>
            <textarea class="form-control" rows="5" name="description" placeholder="Description of the emergency" required></textarea><br>
            <input type="submit" value="Post Notice" class="submit btn btn-crimson" name="submit" required>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>


</html>
