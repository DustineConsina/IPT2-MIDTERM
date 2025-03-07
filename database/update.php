<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['Author'];
    $genre = $_POST['Genre'];
    $date_published = $_POST['Date_Published'];

    
    $sql = "UPDATE books SET 
            title='$title', 
            Author='$author', 
            Genre='$genre', 
            Date_Published='$date_published' 
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "updated";
    } else {
        $_SESSION['status'] = "error: " . mysqli_error($conn); 
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>
