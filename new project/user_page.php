
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
            <img src="images/logo.png" alt="GFG Logo" class="logo">
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
                    <a class="nav-link" href="#">MyPosts</a>
                </li>
                <form class="d-flex search-form">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success custom-search-button" type="submit">Search</button>
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
                    <li class="list-group-item"><a href="#aboutModal" class="modal-trigger" data-target="#aboutModal">About Us</a></li>
                    <li class="list-group-item"><a href="#contactModal" class="modal-trigger" data-target="#contactModal">Contact Us</a></li>
                    <li class="list-group-item"><a href="#faqModal" class="modal-trigger" data-target="#faqModal">FAQs</a></li>
                    <li class="list-group-item"><a href="#creditsModal" class="modal-trigger" data-target="#creditsModal">Credits</a></li>
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
                </div>
            </div>

           <!-- Right Section -->
            <div class="col-md-3 right-section">
                <h4>Emergency Notice Board</h4>
                <?php
                    @include 'conf.php';

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $query = "SELECT location, description FROM notice ORDER BY created_at DESC";
                    $result = mysqli_query($conn, $query);

                    if ($result === FALSE) {
                        echo "Error: " . $conn->error;
                    } else {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="emergency-notice">';
                                echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                                echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No emergency notices at the moment.</p>';
                        }
                    }

                    $conn->close();
                    ?>

            </div>

    <!-- About Modal -->
    <div class="modal about-modal" id="aboutModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>About Gifting For Good</h2>
            <p> Gifting For Good is an innovative platform dedicated to reducing food waste and supporting those in need. 
                By connecting event organizers, restaurants, and other food providers with charities and community organizations, 
                we facilitate the donation of surplus food. Our goal is to tackle food waste and hunger, improve food equity and nutrition, 
                and provide environmental benefits through efficient food distribution and community empowerment.</p>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal contact-modal" id="contactModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="social-icons">
                <i class="fab fa-facebook-square"></i>
                <i class="fab fa-twitter-square"></i>
                <i class="fab fa-instagram-square"></i>
            </div>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i> <span>+1234567890</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i> <span>+0987654321</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i> <span>123 Street, City, Country</span>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Modal -->
<div class="modal faq-modal" id="faqModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>FAQs</h2>
        <p>Q1: What is Gifting For Good?</p>
        <p>A1: Gifting For Good is an online platform that connects surplus food donors with organizations and individuals in need to reduce food waste and support communities.</p>
        
        <p>Q2: Who can donate food on Gifting For Good?</p>
        <p>A2: Any individual, restaurant, or organization with surplus food can donate through our platform.</p>
        
        <p>Q3: How does the donation process work?</p>
        <p>A3: Donors create a post describing the available food, including pickup details. Interested recipients can claim the donation, and the donor coordinates the pickup.</p>
        
        <p>Q4: Are there any fees for using Gifting For Good?</p>
        <p>A4: No, Gifting For Good is free to use for both donors and recipients.</p>
        
        <p>Q5: What types of food can be donated?</p>
        <p>A5: Most perishable and non-perishable food items can be donated, provided they are safe and legal to distribute.</p>
        
        <p>Q6: How can I track the impact of my donations?</p>
        <p>A6: Gifting For Good provides donors with metrics on the number of meals provided, food waste reduced, and community impact.</p>
        
        <p>Q7: Is my personal information secure?</p>
        <p>A7: Yes, we prioritize data security and use encryption to protect user information. Donors and recipients control what information they share.</p>
        
        <p>Q8: Can I donate non-food items?</p>
        <p>A8: Gifting For Good focuses on food donations. However, some organizations may accept essential non-food items. Contact them directly for specifics.</p>
        
        <p>Q9: How can I get involved beyond donating?</p>
        <p>A9: You can volunteer, spread awareness, or support our partner organizations to further our mission.</p>
        
        <p>Q10: How do I report an issue with a donation or user?</p>
        <p>A10: Contact our support team through our website's help center or email for assistance.</p>
        
        <!-- Add more FAQs as needed -->
    </div>
</div>

    <!-- Credit Modal -->
    <div class="modal credits-modal" id="creditsModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Developers of Gifting For Good</h2> <!-- Added heading -->
            <div class="credits-section">
                <div class="profile-icon">
                    <img src="images/profile1.jpg" alt="Profile 1">
                    <span class="profile-name">Nasrin Akther Jerin</span>
                </div>
                <!-- Repeat for other profiles -->
                <div class="profile-icon">
                    <img src="images/profile2.jpg" alt="Profile 2">
                    <span class="profile-name">Sadia Akhter Prity</span>
                </div>
                <div class="profile-icon">
                    <img src="images/profile3.jpg" alt="Profile 3">
                    <span class="profile-name">Ayesh Chowdhury Shuchi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modalOverlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalTriggers = document.querySelectorAll('.modal-trigger');
            const modals = document.querySelectorAll('.modal');
            const overlay = document.getElementById('modalOverlay');

            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetModal = document.querySelector(this.getAttribute('data-target'));
                    targetModal.style.display = 'block';
                    overlay.style.display = 'block';
                });
            });

            document.querySelectorAll('.close').forEach(btn => {
                btn.addEventListener('click', function () {
                    modals.forEach(modal => modal.style.display = 'none');
                    overlay.style.display = 'none';
                });
            });

            overlay.addEventListener('click', function () {
                modals.forEach(modal => modal.style.display = 'none');
                overlay.style.display = 'none';
            });
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

