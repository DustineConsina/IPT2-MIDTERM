<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $Author = $_POST['Author'];
    $Genre = $_POST['Genre'];
    $Date_Published = $_POST['Date_Published'];

    
    $sql = "UPDATE books SET 
            title='$title', 
            Author='$Author', 
            Genre='$Genre', 
            Date_Published='$Date_Published', 
            WHERE id='$id'";


    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "updated";
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>
