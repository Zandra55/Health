<?php
session_start(); 

require('connection_db.php');

if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php'); 
    exit();
}

$teacher_id = $_SESSION['teacher_id']; 

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Portal Teacher Panel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            color: #008080; 
        }

        #header {
            background-color: #008080; 
            padding: 10px 20px;
            color: #ffffff; 
            font-family: cursive;
            font-size: 30px;
            text-align: center;
        }

        #logout-btn {
            margin: 10px;
            padding: 8px 20px;
            background-color: #f44336; 
            color: white;
            border: none;
            cursor: pointer;
            float: right;
            font-size: 16px;
        }

        #content-container {
            background-color: #ffffff; 
            padding: 20px;
            margin-top: 10px;
            margin-left: 200px; 
            width: calc(80% - 200px); 
            color: #008080; 
        }

        #sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 200px;
            background-color: #008080; 
            color: #ffffff; 
            padding-top: 20px;
        }

        #sidebar a {
            display: block;
            color: #ffffff; 
            padding: 10px 20px;
            text-decoration: none;
        }

        #sidebar a:hover {
            background-color: #005454; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd; 
            text-align: left;
        }

        th {
            background-color: #008080; 
            color: #ffffff; 
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; 
        }

        tr:hover {
            background-color: #ddd; 
        }

        footer {
            background-color: #008080; 
            color: #ffffff; 
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .password-icon {
            cursor: pointer;
            font-size: 16px;
            color: #008080; 
        }
    </style>
</head>
<body>

<div id="sidebar">
    <a href="dashboard_teacher.php">Home</a>
    <a href="teacher.php">Profile</a>
</div>

<div id="header">
    Health And Medical Record System
    <form style="display: inline;" action="#" method="POST">
        <input type="submit" id="logout-btn" name="logout" value="Logout">
    </form>
</div>

<div id="content-container">
    <?php
        $sql = "SELECT *, password FROM teacher WHERE teacher_id='$teacher_id'";
        $result = mysqli_query($connection, $sql);

        if (!$result || mysqli_num_rows($result) <= 0) {
            echo "No data found";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                
            }
        }
   

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
                    <tr>
                        <td>Guardian Full Name</td>
                        <td><?= $guardian_fname; ?></td>
                    </tr>
                    <tr>
                        <td>Guardian Contact</td>
                        <td><?= $guardian_contact; ?></td>
                    </tr>
                </table>
                <br>
                <div style="text-align: left;">
                    <a href="update.php?t_id=<?= $teacher_id; ?>">UPDATE</a>&emsp;&emsp;
                    <a href="insert_db.php?tt_id=<?= $teacher_id; ?>">DELETE ACCOUNT</a>
                </div>
    <?php
            }
        }
    ?>
</div>

<footer>
    <div>&copy; 2024 Laguna University Students</div>
</footer>

<script>
    function password() {
        alert('The password is: <?= $password; ?>');
    }
</script>

</body>
</html>
