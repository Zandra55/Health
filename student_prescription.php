<?php
require('connection_db.php');
session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] != "student") {
    header('Location: index.php');
    exit;
}


$student_id = $_SESSION['student_id'];


$sql = "SELECT * FROM prescription_history WHERE recipient_id = '$student_id' AND recipient_type = 'student'";

$result = $connectivity->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Prescription</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
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


        .container {
            margin-left: 220px; 
            padding: 20px;
            padding-top: 70px; 
        }


        .prescription {
            background-color: #ffffff;
            border: 2px solid #008080;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 19px;
        }
        .prescription-details {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start; 
        }
        .prescription-details label {
            font-weight: bold;
            width: 150px; 
        }
        .prescription-details p {
            margin: 5px 0;
        }
        p.no-prescription {
            text-align: center;
            margin-top: 20px;
        }
        #student-icon {
        position: relative;
        text-align: center;
        margin-bottom: 20px;
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

<div id="header" style="font-size: 35px; font-family: Helvetica, sans-serif; ">
   PRESCRIPTION
</div>


<div id="sidebar">
<div id="student-icon">
        
        <h1>Student</h1>
        <div class="student-line"></div>
    </div>
     <a href="dashboard_student.php"><i class="fas fa-home"></i> Home</a>
    <a href="student.php"><i class="fas fa-user"></i> Profile</a>
    <a href="view_notices.php"><i class="fas fa-bell"></i> Notices</a>
    <a href="student_prescription.php" class="active"><i class="fas fa-bell"></i> Prescription</a>
    <a href="send_message_student.php"><i class="fas fa-comment"></i> Send Message</a>
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>

<div class="container">
    <?php if ($result->num_rows > 0) { ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="prescription">
                <h2>Prescription ID: <?php echo $row['id']; ?></h2>
                <div class="prescription-details">
                    <label>Doctor Name:</label>
                    <p><?php echo $row['doctor_name']; ?></p>
                </div>
                <div class="prescription-details">
                    <label>Medications:</label>
                    <p><?php echo $row['medications']; ?></p>
                </div>
                <div class="prescription-details">
                    <label>Instructions:</label>
                    <p><?php echo $row['instructions']; ?></p>
                </div>
                <div class="prescription-details">
                    <label>Notes:</label>
                    <p><?php echo $row['notes']; ?></p>
                </div>
                <div class="prescription-details">
                    <label>Created At:</label>
                    <p><?php echo $row['created_at']; ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p class="no-prescription">No prescription available.</p>
    <?php } ?>
</div>


</body>
</html>
