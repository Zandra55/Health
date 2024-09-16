<?php
require('connection_db.php');
session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] != "student") {
    header('Location: index.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $notice_id = $_POST['notice_id'];
    $reply_message = $_POST['reply_message'];
    
   
    $student_id = $_SESSION['student_id'];
    
  
    $sql = "INSERT INTO notice_replies (notice_id, student_id, reply_message) 
            VALUES ('$notice_id', '$student_id', '$reply_message')";
    
    if (mysqli_query($connectivity, $sql)) {
       
        header('Location: view_notices.php?success=1');
        exit;
    } else {
       
        header('Location: view_notices.php?error=1');
        exit;
    }
} else {
  
    header('Location: view_notices.php');
    exit;
}
?>
