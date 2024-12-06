<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];
$stmt = $pdo->prepare("SELECT * FROM articles WHERE author_id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styleb.css">
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Admin Dashboard</h2>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#articles">Articles</a></li>

        <?php if ($user_role === 'admin'): ?>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#categories">Categories</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="users.php">Users</a></li>
        <?php endif; ?>

    </ul>

    <div class="tab-content">
        <!-- Manage Articles -->
        <div class="tab-pane fade show active" id="articles">
            <h3>Articles</h3>
            <a href="create_article.php" class="btn btn-success mb-3">Add New Article</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Article Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                foreach ($articles as $article):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($article['title']) ?></td>
                        <td><?= htmlspecialchars($article['content']) ?></td>
                        <td>
                            <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_article.php?id=<?= $article['id'] ?>" onclick="return confirmDeletion()" class="btn btn-danger">Delete</a>
                            <!-- <a href="delete_article.php?id=<?= $article['id'] ?>" class="btn btn-danger btn-sm">Delete</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>

            </table>
        </div>

        <?php if ($user_role === 'admin'): ?>
        <!-- Manage Categories -->
        <div class="tab-pane fade" id="categories">
            <h3>Categories</h3>
            <form action="admin_dashboard.php" method="POST">
                <div class="form-group">
                    <input type="text" name="category_name" class="form-control" placeholder="New Category Name">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Add Category</button>
            </form>
        </div>

        <!-- Manage Users -->
        <div class="tab-pane fade" id="users">
            <h3>Users</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
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
        <script>
            function confirmDeletion() {
            return confirm("Are you sure you want to delete this article? This action cannot be undone.");
                }
        </script>

<style> 
.card {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    margin-bottom: 20px;
}

.card-title {
    font-size: 1.25rem;
    color: #333;
}

.pagination .page-link {
    color: #007bff;
}

.nav-tabs .nav-link.active {
    font-weight: bold;
    background-color: #007bff;
    color: white;
}
</style>