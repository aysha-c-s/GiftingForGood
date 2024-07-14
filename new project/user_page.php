
<!-- <!DOCTYPE html>
<html lang="en">
<head>
   <title>user page</title>
   <link rel="stylesheet" href="style2.css">
</head>
<body>  
<div class="container">
   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome </h1>
      <p>this is an user page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboardstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Gifting For Good Dashboard</title>
</head>
<body>
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="GFG Logo" width="50" height="45">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Posts</a>
                </li>
                <form class="form-inline mx-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid main-content mt-5 pt-5">
        <div class="row">
            <!-- Left Section -->
            <div class="col-md-2 left-section">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">About Us</a></li>
                    <li class="list-group-item"><a href="#">Contact Us</a></li>
                    <li class="list-group-item"><a href="#">FAQs</a></li>
                    <li class="list-group-item"><a href="#">Credits</a></li>
                    <li class="list-group-item"><a href="#">More Options</a></li>
                </ul>
            </div>

            <!-- Center Section -->
            <div class="col-md-7 center-section">
                <!-- Posts -->
                <div class="posts">
                    <div class="post">
                        <img src="food1.jpg" alt="Food Image" class="post-img">
                        <p class="post-description">Description of the food available for donation.</p>
                        <button class="btn btn-primary claim-btn" onclick="claimFood(this)">Claim</button>
                    </div>
                    <div class="post">
                        <img src="food2.jpg" alt="Food Image" class="post-img">
                        <p class="post-description">Another description of the food available for donation.</p>
                        <button class="btn btn-primary claim-btn" onclick="claimFood(this)">Claim</button>
                    </div>
                    <!-- Add more posts as needed -->
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-3 right-section">
                <h4>Emergency Notice Board</h4>
                <div class="emergency-notice">
                    <p>Urgent: Food donations needed in area X due to recent calamity.</p>
                </div>
                <!-- Add more notices as needed -->
            </div>
        </div>
    </div>

    <script>
        function claimFood(button) {
            button.classList.add('claimed');
            button.innerText = 'Claimed';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
