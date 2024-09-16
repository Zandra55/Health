<?php
require('connection_db.php');
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:index.php');
} elseif ($_SESSION['login'] == "student") {
    $user = $_SESSION['name'];
} else {
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Portal Student Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding-bottom: 50px; 
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
            margin-left:50px;
    background-color: #008080;
    color: #ffffff;
    padding: 30px;
    text-align: center;
    width: 100%;
    font-size: 18px;
}


      
        #content-container {
            padding: 20px;
            margin: 15px auto;
            max-width: 800px; 
            background-color: #ffffff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: auto;
            font-size: 14px;
            margin-right: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px; 
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            color: white;
            font-weight: bold;
        }

        th.title-box {
            background-color: #008080; 
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
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
    </style>
</head>
<body>

<div id="header" style="font-size: 35px; font-family: Helvetica, sans-serif;">
   PROFILE
</div>


<div id="sidebar">
<div id="student-icon">
        
        <h1>Student</h1>
        <div class="student-line"></div>
    </div>
    <a href="dashboard_student.php"><i class="fas fa-home"></i> Home</a>
    <a href="student.php" class="active"><i class="fas fa-user"></i> Profile</a>
    <a href="view_notices.php"><i class="fas fa-bell"></i> Notices</a>
    <a href="student_prescription.php"><i class="fas fa-bell"></i> Prescription</a>
    <a href="send_message_student.php"><i class="fas fa-comment"></i> Send Message</a>
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>

<div id="content-container">
    <?php

    $student_id = $_SESSION['student_id']; 

    $sql = "SELECT * FROM student WHERE student_id='$student_id'";
    $result = mysqli_query($connectivity, $sql);

    if (mysqli_num_rows($result) <= 0) {
        echo "No data found";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $student_id = $row['student_id'];
            $name = $row['name'];
            $email = $row['email'];
            $pass = $row['password'];
            $dob = $row['date_of_birth'];
            $gender = $row['gender'];
           
            $address = $row['address'];
            $course = $row['department'];
            $weight = $row['weight'];
            $height = $row['height'];
            $illness = ($row['illness'] === 'Others') ? $row['other_illness'] : $row['illness'];
            $past_medical_history = ($row['past_medical_history'] === 'Others') ? $row['other_past_medical_history'] : $row['past_medical_history'];
            $mental_health = ($row['mental_health'] === 'Others') ? $row['other_mental_health'] : $row['mental_health'];
            $medication = $row['medication'];
            $guardian_fname = $row['guardian_fname'];
            $guardian_contact = $row['guardian_contact'];

            ?>

            <div style="margin-left: 15px;">
                <p><strong>Email:</strong> <?= $email; ?></p>
                <p><strong>Password:</strong> <input type="password" id="passwordField" value="<?= $pass; ?>" readonly> 
                    <button type="button" onclick="togglePassword()">Show/Hide</button></p>
            </div>

       
<table border="1">
    
    <tr>
        <th colspan="2" class="title-box">Personal Information</th>
    </tr>
    <tr>
        <td>Student ID</td>
        <td><?= $student_id; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $name; ?></td>
    </tr>
    <tr>
        <td>Date of Birth</td>
        <td><?= $dob; ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td><?= $gender; ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?= $address; ?></td>
    </tr>
    <tr>
        <td>Course</td>
        <td><?= $course; ?></td>
    </tr>
    <tr>
        <td>Guardian Full Name</td>
        <td><?= $guardian_fname; ?></td>
    </tr>
    <tr>
        <td>Guardian Contact</td>
        <td><?= $guardian_contact; ?></td>
    </tr>
    <tr>
        <th colspan="2" class="title-box">Medical Information</th>
    </tr>
    <tr>
        <td>Weight</td>
        <td><?= $weight; ?></td>
    </tr>
    <tr>
        <td>Height</td>
        <td><?= $height; ?></td>
    </tr>
    <tr>
        <td>Illness</td>
        <td><?= $illness; ?></td>
    </tr>
    <tr>
        <td>Past Medical History</td>
        <td><?= $past_medical_history; ?></td>
    </tr>
    <tr>
        <td>Mental Health</td>
        <td><?= $mental_health; ?></td>
    </tr>
    <tr>
        <td>Medication</td>
        <td><?= $medication; ?></td>
    </tr>
            
</table>


            <br>
            <div style="text-align: left;">
              
                <a href="insert_db.php?st_id=<?= $student_id; ?>">DELETE ACCOUNT</a>
            </div>
            <form id="updateForm" action="update.php" method="GET" style="display: none;">
                <input type="hidden" name="s_id" value="<?= $student_id; ?>">
            </form>
        </div>
        <br><br>

            <?php
        }
    }
    ?>
</div>

<script>
    function submitUpdateForm() {
        document.getElementById("updateForm").submit();
    }
    function togglePassword() {
        var x = document.getElementById("passwordField");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


</body>
</html>
