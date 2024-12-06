<?php include ('../config.php'); 
      include('../includes/db.php');
?>

<?php
// Fetch the article based on the ID
$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Handle image upload
    $image_url = $article['image_url'];
    if (!empty($_FILES['image_url']['name'])) {
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES['image_url']['name']);
        move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file);
        $image_url = basename($_FILES['image_url']['name']);
    }

    $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, category = ?, image_url = ? WHERE id = ?");
    $stmt->execute([$title, $content, $category, $image_url, $id]);

    // Redirect to dashboard
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/cxshesegawa6fl3y0oqcpuoade5zylv9davgkesq10p0wcrw/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <link rel="stylesheet" href="styleb.css"> -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Update Article</h1>
    <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $article['id'] ?>">

        <div class="mb-3">
            <label for="title" class="form-label"><b>Title</b></label>
            <input type="text" name="title" value="<?= $article['title'] ?>" class="form-control" id="title" placeholder="Enter your title" required>
        </div>
        <div class="mb-3">
            <select name="category" value="<?= $article['category'] ?>" required>
            <option value="">Select Category</option>
            <option value="Technology" <?= ($article['category'] == 'Technology') ? 'selected' : '' ?>>Technology</option>
            <option value="Health" <?= ($article['category'] == 'Health') ? 'selected' : '' ?>>Health</option>
            <option value="Business" <?= ($article['category'] == 'Business') ? 'selected' : '' ?>>Business</option>
            <option value="Government" <?= ($article['category'] == 'Government') ? 'selected' : '' ?>>Government</option>

        </div>
    </select>
        <div class="mb-3">
            <label for="content" class="form-label"><b>Content</b></label>
            <textarea name="content" class="form-control" id="content" rows="5" required><?= htmlspecialchars($article['content']) ?></textarea>
        </div>
        <div class="mb-3">
            
         <?php if ($article['image_url']): ?>
            <div><b>Current Image:</b> <img src="../uploads/<?= $article['image_url'] ?>" alt="Article Image" width="100" class="styled-image">
            </div>
         <?php endif; ?><br/>
         <label for="image" class="form-label"><b>Choose to Change Image</b></label>
            <input type="file" name="image_url" class="form-control" id="image_url" accept="image/*">

            <!-- <input type="file" name="image" class="form-control" id="image" value="<?= $article['image_url'] ?>" accept="image/*"> -->
        </div>
        <button type="submit" class="btn btn-primary w-50">Publish Article</button>

        <? header('Location: dashboard.php');?>
    </form>
</div>

</div>
<style>
    .styled-image {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100px;
    }
</style>
<style>
    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }
</style>

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
    <script>
    tinymce.init({
        selector: 'textarea#content',  // Target the textarea with the 'content' ID
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });
</script>

</body>
</html>