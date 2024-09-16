<?php
include "connection_db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $student_id = $_POST["student_id"];
    $notice_message = $_POST["notice_message"];
    
    
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["file"]["name"];
        $file_temp = $_FILES["file"]["tmp_name"];
        
        $upload_dir = "uploads/"; 
        move_uploaded_file($file_temp, $upload_dir . $file_name);
    } else {
        $file_name = "";
    }

    
    if (empty($student_id) || empty($notice_message)) {
        $_SESSION['message'] = "Please fill in all fields.";
    } else {
        
        $student_id = mysqli_real_escape_string($connectivity, $student_id);
        $notice_message = mysqli_real_escape_string($connectivity, $notice_message);
        $file_name = mysqli_real_escape_string($connectivity, $file_name);

       
        $sql = "INSERT INTO notices (student_id, notice_message, file_name) VALUES ('$student_id', '$notice_message', '$file_name')";

        if (mysqli_query($connectivity, $sql)) {
            $_SESSION['message'] = "Your message has been delivered.";
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($connectivity);
        }
    }

    
    header("Location: admin.php");
    exit(); 
} else {
   
    header("Location: admin.php");
    exit();
}
?>
