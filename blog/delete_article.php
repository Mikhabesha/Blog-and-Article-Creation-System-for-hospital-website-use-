<?php include ('../config.php'); 
      include('../includes/db.php');
?>
<?php
// Check for delete confirmation
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prepare delete statement
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect back to the list page
    header('Location: dashboard.php');
}
?>
