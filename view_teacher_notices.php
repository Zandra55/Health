<?php
require('connection_db.php');
session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] != "teacher") {
    header('Location: index.php');
    exit;
}

$user = isset($_SESSION['name']) ? $_SESSION['name'] : ''; 
$teacher_id = $_SESSION['teacher_id'];


$sql = "SELECT * FROM notices WHERE teacher_id = '$teacher_id'";
$result = mysqli_query($connectivity, $sql);


if (!$result || !($result instanceof mysqli_result)) {
    echo "Error: " . mysqli_error($connectivity);
    exit;
}
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
            margin-left: 220px; 
            margin-top: 90px; 
            padding: 20px;
            padding-top: 0; 
        }

        
        table {
            width: calc(100% - 50px); 
            margin-top: 20px; 
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #008080;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        
       
        footer {
            background-color: #008080;
            color: white;
            text-align: center;
            padding: 8px;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
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
    #sidebar a.active {
    background-color: #008080;
    color: #ffffff;
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
    <a href="teacher.php"><i class="fas fa-user"></i> Profile</a>
    <a href="view_teacher_notices.php"class="active"><i class="fas fa-bell"></i> Notices</a>
    <a href="view_teacher_prescription.php"><i class="fas fa-prescription"></i> Prescription</a>
    <a href="send_message_teacher.php"><i class="fas fa-comment"></i> Send Message</a>
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>
<div id="header" style="font-size: 35px; font-family: Helvetica, sans-serif;">
   NOTICES
</div>


<div id="content-container">

    <?php if (mysqli_num_rows($result) <= 0) : ?>
        <p>No notices found.</p>
    <?php else : ?>
        <table border="1">
            <tr>
                <th>Notice ID</th>
                <th>Notice Message</th>
                <th>File name</th>
                <th>Created At</th>

            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr onclick="viewNotice('<?php echo $row['notice_message']; ?>')">
                    <td><?php echo $row['notice_id']; ?></td>
                    <td><?php echo $row['notice_message']; ?></td>
                    <td><?php echo $row['file_name']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                   
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</div>

<div id="notice-box" class="notice-box"></div>

<footer>
    <div>&copy; <?php echo date('Y'); ?></div>
    <div>Laguna University Students</div>
</footer>



</body>
</html>
