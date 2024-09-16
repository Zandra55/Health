<?php
    session_start();
    require('connection_db.php');

    $name = mysqli_real_escape_string($connectivity, $_POST['name']);
    $email = mysqli_real_escape_string($connectivity, $_POST['email']);
    $password = mysqli_real_escape_string($connectivity, $_POST['password']);
    $date_of_birth = mysqli_real_escape_string($connectivity, $_POST['date_of_birth']);
    $gender = mysqli_real_escape_string($connectivity, $_POST['gender']);
    $address = mysqli_real_escape_string($connectivity, $_POST['address']);

   
    $sql = "INSERT INTO students (name, email, password, date_of_birth, gender, address) VALUES ('$name', '$email', '$password', '$date_of_birth', '$gender', '$address')";

    if(mysqli_query($connectivity, $sql)) {
        $_SESSION['message'] = "Student added successfully.";
        header("Location: student.php");
    } else {
        $_SESSION['error'] = "Error: Unable to add student.";
        header("Location: add_student.php");
    }
?>
