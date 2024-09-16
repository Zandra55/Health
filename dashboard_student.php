<?php

session_start();
require('connection_db.php');


if (!isset($_SESSION['login']) || $_SESSION['login'] != "student") {
    header('Location: index.php');
    exit;
}


$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM student WHERE student_id='$student_id'";
$result = mysqli_query($connectivity, $sql);


if (mysqli_num_rows($result) <= 0) {
    header('Location: index.php');
    exit;
}


$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$address = $row['address'];
$course = $row['department'];


if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            font-size: 14px;
            color: #008080;
        }

        #logout-btn {
            background-color: #008080;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 6px;
            width: 120px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #logout-btn:hover {
            background-color: #005454;
        }

        #sidebar {
            background-color: #e0f2f1;
            color: #008080;
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            font-size: 14px;
        }

        #sidebar a {
            padding: 10px;
            display: block;
            color: #008080;
            text-decoration: none;
            font-size: 16px;
        }

        #sidebar a:hover {
            background-color: #4dcccc;
            color: #ffffff;
        }

        #header {
            background-color: #008080;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            width: 100%;
            font-size: 18px;
        }

        .box-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .notice-box {
            background-color: #ffffff;
            color: #008080;
            padding: 3px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 16px;
            flex: 0 0 calc(50% - 20px);
            margin-right: 20px;
            border: 2px solid #008080; 
        }

        .notice-box:last-child {
            margin-right: 0;
        }

        .notice-box i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #008080;
        }

        .notice-box h3 {
            margin-top: 0;
            font-size: 20px;
        }

        #content-container {
            margin-left: 220px;
            padding: 20px;
            font-size: 16px;
        }

        footer {
            background-color: #008080;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }

        a {
            color: #008080;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #student-icon {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }

        .student-line {
            width: 160px;
            height: 2px;
            background-color: #008080;
            margin: 10px auto 20px auto;
        }

        .student-line h1 {
            font-size: 16px;
            margin: 0;
        }

        #sidebar a.active {
            background-color: #008080;
            color: #ffffff;
        }

        #header {
            padding: 33px;
        }
    </style>
</head>
<body>

<div id="header">
    <span style="font-size: 30px; font-family: Arial, sans-serif; font-style: Halvatica; color: #ffffff; margin-left: 220px;">Welcome,</span> 
    <span style="font-size: 30px; font-family: Arial, sans-serif; font-style: Halvatica; color: #ffffff;"><?= $name ?></span>
</div>



<div id="sidebar">
<div id="student-icon">
        
        <h1>Student</h1>
        <div class="student-line"></div>
    </div>
    <a href="dashboard_student.php" class="active"><i class="fas fa-home"></i> Home</a>
    <a href="student.php"><i class="fas fa-user"></i> Profile</a>
    <a href="view_notices.php"><i class="fas fa-bell"></i> Notices</a>
    <a href="student_prescription.php"><i class="fas fa-bell"></i> Prescription</a>
    <a href="send_message_student.php"><i class="fas fa-comment"></i> Send Message</a>
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>

<div id="content-container">
    <div class="box-container">
        <div class="notice-box">
            <a href="student_prescription.php"><i class="fas fa-prescription"></i></a>
            <h3>View Prescription</h3>
        </div>
        <div class="notice-box">
            <a href="view_notices.php"><i class="fas fa-envelope"></i></a>
            <h3>View Notices</h3>
        </div>
    </div>

    <h2>Profile Information</h2>
    <p><strong>Email:</strong> <?= $email ?></p>
    <p><strong>Address:</strong> <?= $address ?></p>
    <p><strong>Course:</strong> <?= $course ?></p>
</div>


</body>
</html>
