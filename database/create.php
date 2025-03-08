<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $Author = $_POST['Author'];
    $Genre = $_POST['Genre'];
    $Date_Published = $_POST['Date_Published'];

    
    $sql = "INSERT INTO books (title, Author, Genre, Date_Published) VALUES ('$title', '$Author', '$Genre', '$Date_Published')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "created";
    } else {
        $_SESSION['status'] = "error: "; 
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>