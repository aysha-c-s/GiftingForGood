<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboardstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Gifting For Good Dashboard</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="GFG Logo" width="50" height="45">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <div class="container">
                    <div class="d-flex justify-content-end mt-3 position-relative">
                        <input type="checkbox" id="toggleCheckbox" class="d-none">
                        <label for="toggleCheckbox" id="toggleButton" class="btn btn-danger rounded-circle">
                            <i class="fas fa-user"></i>
                        </label>
                        <div id="toggleBox" class="position-absolute">
                            <div class="content">
                                <div class="data">
                                    <p><b>Full Name</b><span><?php echo $name; ?></span></p>
                                    <p><b>Email</b><span><?php echo $email; ?></span></p>
                                    <p><b>Phone</b><span><?php echo $phn; ?></span></p>
                                    <p><b>Optional Phone</b><span><?php echo $ophn ?></span></p>
                                    <p><i class="fas fa-edit"></i><b>Address</b><span><?php echo $address ?></span></p>
                                    <p onclick="location.href='profile.php'"><a href="profile.php" class="link"><i
                                                class="fas fa-edit"></i><b>Edit</b></a></p>
                                    <p onclick="location.href='logout.php'"><a href="logout.php" class="link"><i
                                                class="fas fa-sign-out-alt"></i><b>Logout</b></a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>