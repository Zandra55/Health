<?php

include "connection_db.php";


if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $messageId = $_GET['id'];
    
   
    $conn = new mysqli($hostname, $username, $password, $dbName);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("DELETE FROM student_messages WHERE message_id = ?");
    $stmt->bind_param("i", $messageId);
    $stmt->execute();

    
    $stmt->close();
    $conn->close();

    
    header("Location: view_message_student.php"); 
    exit();
} else {
    
    header("Location: view_message_student.php"); 
    exit();
}
?>
