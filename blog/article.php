<?php include '../config.php'; ?> 

<?php
// Fetch single article safely using prepared statements
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$stmt->close();

// Fetch all articles with author names
$query = "
    SELECT articles.*, users.name AS author 
    FROM articles 
    JOIN users ON articles.author_id = users.id 
    ORDER BY articles.created_at DESC
";
$result = $conn->query($query);
$allArticles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $allArticles[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Article</title>
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

    <div class="container">
        <div class="row">
            <!-- Main Article -->
            <div class="col-lg-8 article-container">
                <h1><?= htmlspecialchars($article['title']); ?></h1>
                <img src="../uploads/<?= htmlspecialchars($article['image_url'] ?? 'default.jpg'); ?>" 
                     alt="<?= htmlspecialchars($article['title']); ?> image">
                     <div class="article-meta">
                    <span><i class="fas fa-user"></i> <?= htmlspecialchars($article['author_name']); ?></span>
                    <span><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars(date('F j, Y', strtotime($article['created_at']))); ?></span>
                </div>
                
                <hr/>
                <div class="article-content">
                    <?= htmlspecialchars_decode($article['content']) ?>
                </div>
   
                <hr>
                <h3>Comments</h3>
                <div class="comment-frm">
                    <form method="post" action="comment.php">
                        <input type="hidden" name="article_id" value="<?= $id; ?>">
                        <textarea name="comment" required></textarea>
                        <button type="submit" class="comment-frm-btn">Post Comment</button>
                    </form>
                </div>
                <div class="comments">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM comments WHERE article_id = ? ORDER BY created_at DESC");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $comments = $stmt->get_result();
                    while ($comment = $comments->fetch_assoc()) {
                        echo "<p>" . htmlspecialchars($comment['content']) . " - <em>" . htmlspecialchars($comment['created_at']) . "</em></p>";
                    }
                    $stmt->close();
                    ?>
                </div>
            </div>

            <!-- Latest Posts -->
            <div class="col-lg-4">
                <div class="latest-posts">
                    <h4>Latest Posts</h4>
                    <?php
                    $latest_posts = $conn->query("SELECT id, title, image_url FROM articles ORDER BY created_at DESC LIMIT 3");
                    while ($post = $latest_posts->fetch_assoc()) {
                        echo "<div class='latest-post'>
                                <img src='../uploads/" . htmlspecialchars($post['image_url']) . "' alt='" . htmlspecialchars($post['title']) . " thumbnail'>
                                <a href='article.php?id=" . htmlspecialchars($post['id']) . "'>" . htmlspecialchars($post['title']) . "</a>
                              </div>";
                    }
                    ?>
                </div>
            </div>
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
.comment-frm {
        margin: 20px 0;
    }
    .comment-frm h3 {
        margin-bottom: 15px;
        font-size: 24px;
        color: #333;
    }
    .comment-frm {
        display: inline-block;
        margin: 5px 10px;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #adf1e1; /* Primary button color */
        color: #fff; /* Button text color */
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s;
        font-size: 16px;
    }
    .comment-frm-btn{
        background-color: #41e9c1; /* Darker shade on hover */
        transform: scale(1.05); /* Slightly enlarge on hover */
    }
    .comment-frm-btn:hover {
        background-color: #0056b3; /* Darker shade on hover */
        transform: scale(1.05); /* Slightly enlarge on hover */
    }
    .article-container {
        text-align: center; /* Centers the text */
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .article-container h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }  
    .article-container img {
        width: 100%; /* Makes image responsive */
        max-width: 600px; /* Sets a max size */
        height: auto;
        margin-bottom: 20px;
    }
    .article-container p {
        font-size: 1.1rem;
        line-height: 1.6;
    }
    .comment-frm textarea {
        width: 100%;
        height: 150px;
        margin-bottom: 10px;
    }
    .comment-frm-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }
    .comments p {
        font-size: 1rem;
        color: #555;
        margin-bottom: 5px;
    }
    .article-container img {
        width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
    .latest-posts {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .latest-posts h4 {
        margin-bottom: 15px;
    }
    .latest-post {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    .latest-post img {
        width: 60px;
        height: 60px;
        border-radius: 4px;
        margin-right: 10px;
    }

    .latest-post a {
        text-decoration: none;
        font-size: 1rem;
        color: #333;
    }

    .latest-post a:hover {
        color: #007bff;
    }
    .comment-frm textarea {
        width: 100%;
        height: 150px;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }       

    .comment-frm-btn {
        background-color: #41e9c1;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .comment-frm-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .latest-post {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .latest-post img {
        width: 60px;
        height: 60px;
        border-radius: 4px;
        margin-right: 10px;
    }

    .latest-post a {
        text-decoration: none;
        font-size: 1rem;
        color: #333;
    }

    .latest-post a:hover {
        color: #007bff;
    }

</style>