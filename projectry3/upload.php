<?php

@include 'conf.php';

if (isset($_POST['submit'])) {
  $uid = 3;
  $area = $_POST['area'];
  $address = $_POST['full_address'];
  $type = $_POST['type'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $text = $_POST['text'];
  $status = "unclaimed";


  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];
  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));
  if (!in_array($imageExtension, $validImageExtension)) {
    echo
      "<script>alert('Invalid Image Extension');</script>";
  } else if ($fileSize > 500000000) {
    echo
      "<script>alert('Image size is too large');</script>";
  } else {
    $newImageName = uniqid();
    $newImageName .= '.' . $imageExtension;
    move_uploaded_file($tmpName, 'img/' . $newImageName);
    $query = "INSERT INTO posts(uid,Area,Full_address,type,amout,short_description,status,Expire_date,photo)VALUES('$uid','$area','$address','$type','$amount','$text','$status','$date','$newImageName')";

    $res = $conn->query($query);
    if ($res == TRUE) {
      header('location:data.php');
    }
  }
  $conn->close();
};
?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="style3.css">
</head>

<body>
<!-- style="background-color: #5a3f2b;"  -->
  <div class="book" style="background-color: #5a3f2b;">
    <div class="container">
      <div class="main-text">
        <h1 style="color:#dbd0ca">Write about the food you wanna give... </h1>
      </div>
      <div class="row">
        <div class="col-md-6 py-3 py-md-0">
          <form action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($error)) {
              foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
              };
            };
            ?>

            <select class="form-control" name="area" id="area" required>
              <option selected class="selected">Choose Your Area</option>
              <option value="Dhanmondi">Dhanmondi</option>
              <option value="Dhanmondi">Dhanmondi</option>
              <option value="Gulshan">Gulshan</option>
              <option value="Bonani">Bonani</option>
            </select><br>
            <input type="text" class="form-control" name="full_address" placeholder="full address" required><br>
            <select class="form-control" name="type" id="type" required>
              <option selected class="selected">Type of food</option>
              <option value="Cappuccino">Cappuccino</option>
              <option value="Espresso">Espresso</option>
              <option value="Latte">Latte</option>
              <option value="Mocha">Mocha</option>
              <option value="Frappe">Frappe</option>
            </select><br>
            <input type="Text" class="form-control" name="amount" placeholder="amount" required><br>
            <input type="date" class="form-control" name="date" placeholder="expire date" required><br>
            <h6 style="color:#dbd0ca">upload an image</h6>
            <input type="file" value="" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" ><br>
            <textarea class="form-control" rows="5" name="text" placeholder="short description"></textarea>
            <input type="submit" value="Create post" class="submit" name="submit" style="background-color:#dbd0ca; color:#5a3f2b;"required>

          </form>
        </div>
        <div class="col-md-6 py-3 py-md-0">
          <div class="card" id="selectedBanner">
            <img src="./images/books.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    var selDiv = "";
    var storedFiles = [];
    $(document).ready(function () {
      $("#image").on("change", handleFileSelect);
      selDiv = $("#selectedBanner");
    });

    function handleFileSelect(e) {
      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      filesArr.forEach(function (f) {
        if (!f.type.match("image.*")) {
          return;
        }
        storedFiles.push(f);

        var reader = new FileReader();
        reader.onload = function (e) {
          var html =
            '<img src="' +
            e.target.result +
            "\" data-file='" +
            f.name +
            "alt='Category Image'>";
          selDiv.html(html);
        };
        reader.readAsDataURL(f);
      });
    }
  </script>
</body>
</html>