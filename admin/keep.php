<?php
ob_start();
require_once "functions/db.php";

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("location: login.php");
    exit;
}

$email = $_SESSION['email'];

// Check if form is submitted
if(TRUE) {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    echo $email;

    // Check if $connection is initialized and not null
    if(isset($connection)) {
        try {
            // Add task to DB
            $sql = "INSERT INTO posts (author, title, content) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$author, $title, $content]);
            echo $email;

            header('Location: ../blog.php');
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: Database connection not established.";
    }
}
?>

echo "Something wants worng";
