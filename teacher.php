<?php
require('connection_db.php');
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:index.php');
} elseif (!isset($_SESSION['login']) || $_SESSION['login'] != "teacher") {
    header('Location:index.php');
} else {
    $user = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown";
}

$teacher_id = $_SESSION['teacher_id'];
$sql = "SELECT *, password FROM teacher WHERE teacher_id='$teacher_id'";
$result = mysqli_query($connectivity, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Portal Teacher Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <style>
      body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
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

        #sidebar a.active {
    background-color: #008080;
    color: #ffffff;
}
#content-container {
    max-height: calc(100vh - 120px);
    overflow-y: auto;
    background-color: #d8dedc;
    padding: 20px;
    margin-top: 60px;
    margin-left: 220px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    table-layout: fixed;
}

th {
    background-color: teal;
   
    color: white;
   
}

.medical-history {
    background-color: #008080;
    
    color: white;
    
    text-align: center;
    font-weight: bold;
}

td {
    padding: 8px;
    
    border-bottom: 1px solid #ddd;
    text-align: left;
    word-wrap: break-word;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

footer {
    background-color: gray;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

.password-icon {
    cursor: pointer;
    font-size: 16px;
    color: blue;
}

@media screen and (max-width: 600px) {
    #sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    #sidebar a {
        padding: 5px;
    }

    #content-container {
        margin-left: 0;
    }

    table {
        word-wrap: break-word;
    }
}
#teacher-icon {
        position: relative;
        text-align: center;
        margin-bottom: 20px;
    }

    .teacher-line {
        width: 150px;
        height: 2px;
        background-color: #008080;
        margin: 10px auto 20px auto;
    }

    .teacher-line h1 {
        font-size: 16px;
        margin: 0;
    }
    </style>
</head>
<body>

<div id="sidebar">
<div id="teacher-icon">
        
        <h1>TEACHER</h1>
        <div class="teacher-line"></div>
    </div>
    <a href="dashboard_teacher.php"><i class="fas fa-home"></i> Home</a>
    <a href="teacher.php"class="active"><i class="fas fa-user"></i> Profile</a>
    <a href="view_teacher_notices.php"><i class="fas fa-bell"></i> Notices</a>
    <a href="view_teacher_prescription.php"><i class="fas fa-prescription"></i> Prescription</a>
    <a href="send_message_teacher.php"><i class="fas fa-comment"></i> Send Message</a>
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>

<div id="header" style="font-size: 35px; font-family: Helvetica, sans-serif;">
   PROFILE
</div>


<div id="content-container">
    <?php
    if (mysqli_num_rows($result) <= 0) {
        echo "No data found";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $teacher_id = $row['teacher_id'];
            $name = $row['name'];
            $email = $row['email'];
            $password = $row['password'];
            $address = $row['address'];
            $dob = $row['date_of_birth'];
            $gender = $row['gender'];
            $department = $row['department'];
            $weight = $row['weight'];
            $height = $row['height'];
            $illness = !empty($row['illness']) ? $row['illness'] : 'None';
            $past_medical_history = !empty($row['past_medical_history']) ? $row['past_medical_history'] : 'None';
            $mental_health = $row['mental_health'];
            $medication = $row['medication'];
            $guardian_fname = $row['guardian_fname'];
            $guardian_contact = $row['guardian_contact'];
            ?>
            
            <div style="margin-left: 20px;">
                <p><strong>Email:</strong> <?= $email; ?></p>
                <p><strong>Password:</strong> <span class="password-icon" onclick="password()">🔒</span></p>
            </div>
            <table border="1">
            <tr>
                    <th>Attribute</th>
                    <th>Value</th>
                </tr>
           

             
                <tr>
                    <td>Teacher ID</td>
                    <td><?= $teacher_id; ?></td>
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
                    <td>Department</td>
                    <td><?= $department; ?></td>
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
                    <td class="medical-history" colspan="2">Medical History</td>
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
            <br><br>
          
                    
    <a href="insert_db.php?tt_id=<?= $teacher_id; ?>">DELETE ACCOUNT</a>
</div>

            <?php
        }
    }
    ?>
</div>



<script>
    function password() {
        alert('The password is: <?= $password; ?>');
    }
</script>

</body>
</html>
