<?php include '../config.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mega Primary Hospital</title>
    <meta name="description" content="Mega Primary Hospital - Quality Healthcare Services for the Community">
    <meta property="og:title" content="Mega Primary Hospital">
    <meta property="og:description" content="Mega Primary Hospital - Quality Healthcare Services for the Community">
    <meta property="og:image" content="img/team3.jpg"> <!-- Optional: image for the preview -->
    <meta property="og:url" content="https://megaprimaryhospital.com">
    <meta property="og:type" content="website">

    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mega Primary Hospital">
    <meta name="twitter:description" content="Mega Primary Hospital - Quality Healthcare Services for the Community">
    <meta name="twitter:image" content="img/team3.jpg"> <!-- Optional: image for the preview -->


    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>092 615 2550/093 450 0248</a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>megahospital82@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm mb-5">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Mega Primary Hospital</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="../index.html" class="nav-item nav-link">Home</a>  
                        <a href="index_for_blog.php" class="nav-item nav-link active">Blog</a>
                        <a href="../about.html" class="nav-item nav-link">About</a>
                        <a href="../service.html" class="nav-item nav-link">Service</a>
                        <div class="nav-item dropdown">
                        <div class="nav-item dropdown">
                            <a href="../#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="team.html" class="dropdown-item">The Team</a>
                                <a href="search.html" class="dropdown-item">Search</a>
                                <a href="appointment.html" class="dropdown-item">Appointment</a>   
                                <a href="testimonial.html" class="dropdown-item">Brief Services</a>  
                            </div>
                        </div>
                        </div>
                        <a href="../contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<body>
    <div class="container">
        <h1>Our Latest Medical Blog Posts</h1>
        <div class="categories">
            <h3>Categories</h3>
            <?php
            $result = $conn->query("SELECT * FROM categories");
            while ($row = $result->fetch_assoc()) {
                echo "<a href='index_for_blog.php?category=" . $row['id'] . "' class='category-btn'>" . $row['name'] . "</a>";
            }
            ?>
        </div>
        <h3 class="articles-h3">Latest Articles</h3><br/>
        <div class="articles">
            <!-- <h3 class="articles-h3">Latest Articles</h3><br/> -->
            <?php
            $category = isset($_GET['category']) ? intval($_GET['category']) : null;
            $query = "SELECT * FROM articles" . ($category ? " WHERE category_id = $category" : "") . " ORDER BY created_at DESC";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='article'>";
                
                // Check if the article has an image
                if (!empty($row['image_url'])) {
                    echo "<img src='" . $row['image_url'] . "' alt='Article Image'>";
                } else {
                    echo "<img src='default_image.jpg' alt='Default Article Image'>"; // Use a placeholder if no image
                }
                
                echo "<h4><a href='article.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h4>
                    <p>" . substr($row['content'], 0, 100) . "...</p>
                    </div>";
            }
            ?>
</div>



    </div>
       <!-- Footer Start -->
       <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                    <p class="mb-4">We’re here to assist you! Contact our team at Mega Primary Hospital by phone, email, or in person for any questions or concerns about your healthcare.</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Mega,Borena, Oromia, Ethiopia</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>megahospital82@gmail.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>092 615 2550/093 450 0248</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="index.html"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="about.html"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="service.html"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="team.html"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                        <a class="text-light mb-2" href="search.html"><i class="fa fa-angle-right me-2"></i>Search a Doctor</a>
                        <a class="text-light" href="contact.html"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="index.html"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="about.html"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="service.html"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="team.html"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                        <a class="text-light mb-2" href="search.html"><i class="fa fa-angle-right me-2"></i>Search a Doctor</a>
                        <a class="text-light" href="contact.html"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">megaprimaryhospital.com</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-primary" href="#">Design Your Goals</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>
</html>
<style>
    .categories {
        margin: 20px 0;
    }
    .categories h3 {
        margin-bottom: 15px;
        font-size: 24px;
        color: #333;
    }
    .category-btn {
        display: inline-block;
        margin: 3px 8px;
        padding: 8px 15px;
        text-decoration: none;
        background-color: #007BFF; /* Primary button color */
        color: #fff; /* Button text color */
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s;
        font-size: 12px;
    }
    .category-btn:hover {
        background-color: #0056b3; /* Darker shade on hover */
        transform: scale(1.05); /* Slightly enlarge on hover */
    }

    .articles {
    display: flex;
    flex-wrap: wrap; /* Wrap articles to the next line */
    gap: 20px; /* Space between articles */
    justify-content: center; /* Center the articles */
}

.article {
    width: 300px; /* Set a fixed width for articles */
    border: 2px solid #ddd; /* Light border around the article */
    border-radius: 10px;
    overflow: hidden;
    /*box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    background-color: #f1f8f7;
    transition: transform 0.3s, box-shadow 0.3s;
}

.article:hover {
    transform: translateY(-10px); /* Slight lift on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.article img {
    width: 100%; /* Full width image */
    height: 180px; /* Fixed height */
    object-fit: cover; /* Crop image if needed */
}

.article h4 {
    font-size: 20px;
    margin: 10px;
    color: #007BFF;
}

.article h4 a {
    text-decoration: none;
    color: inherit; /* Inherit color for the link */
}

.article h4 a:hover {
    text-decoration: underline; /* Underline on hover */
}

.article p {
    margin: 10px;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

.article h3 {
    font-size: 20px;
    margin: 10px;
    color: #007BFF;
}

.article h3 a {
    text-decoration: none;
    color: inherit; /* Inherit color for the link */
}

.article h3 a:hover {
    text-decoration: underline; /* Underline on hover */
}
</style>