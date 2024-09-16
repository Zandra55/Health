<?php
require('connection_db.php');
session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] != "student") {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['name'];
$student_id = $_SESSION['student_id'];


$sql = "SELECT * FROM notices WHERE student_id = '$student_id'";
$result = mysqli_query($connectivity, $sql);


if (!$result) {
    echo "Error: " . mysqli_error($connectivity);
    exit;
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
            margin-left:50px;
    background-color: #008080;
    color: #ffffff;
    padding: 30px;
    text-align: center;
    width: 100%;
    font-size: 18px;
}
       
        #content-container {
    margin-left: 220px;
    padding: 20px;
    padding-top: 20px;
}


table {
    width: calc(100% - 20px); 
    border-collapse: collapse;
    margin-left: auto; 
    margin-right: auto; 
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

        tr:hover {
            background-color: #ddd;
        }

        
.notice-box {
    display: none;
    background-color: #ffffff;
    border: 5px solid #ddd;
    padding: 130px; 
    margin-top: 0px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 90%;
    max-height: 70%;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 30px;
    text-align: left; 
    line-height: 1.8; 
}

.notice-box h3 {
    margin-bottom: 20px; 
}

.notice-box p {
    margin-bottom: 10px; 
}

.notice-box button {
    background-color: #008080;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
    margin-top: 20px; 
}

.notice-box button:hover {
    background-color: #005454;
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
   NOTICES
</div>


<div id="sidebar">
<div id="student-icon">
        
        <h1>Student</h1>
        <div class="student-line"></div>
    </div>
    <a href="dashboard_student.php"><i class="fas fa-home"></i> Home</a>
    <a href="student.php" ><i class="fas fa-user"></i> Profile</a>
    <a href="view_notices.php" class="active"><i class="fas fa-bell"></i> Notices</a>
    <a href="student_prescription.php"><i class="fas fa-bell"></i> Prescription</a>
    <a href="send_message_student.php"><i class="fas fa-comment"></i> Send Message</a>
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>



<div id="content-container">
    <h2>Notices</h2>
    <?php if (mysqli_num_rows($result) <= 0) : ?>
        <p>No notices found.</p>
    <?php else : ?>
        <table border="1">
            <tr>
                <th>Notice ID</th>
                <th>Notice Message</th>
                <th>File Name</th>
                <th>Created At</th>
              
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr onclick="viewNotice('<?php echo $row['notice_message']; ?>', '<?php echo $row['file_name']; ?>', '<?php echo $row['created_at']; ?>')">
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



   <script>
    function viewNotice(message, fileName, createdAt) {
        var noticeBox = document.getElementById('notice-box');
        var contentContainer = document.getElementById('content-container');
        contentContainer.style.display = 'none';
        noticeBox.style.display = 'block';
        noticeBox.innerHTML = `
            <div style="text-align: right;"><button onclick="closeNotice()">Close</button></div>
            <h3>Notice Details</h3>
            <p><strong>Message:</strong> ${message}</p>
            <p><strong>File Name:</strong> ${fileName}</p>
            <p><strong>Created At:</strong> ${createdAt}</p>
            <button onclick="replyToNotice()">Reply</button> <!-- Add reply button -->
        `;
    }

    function closeNotice() {
        var noticeBox = document.getElementById('notice-box');
        var contentContainer = document.getElementById('content-container');
        noticeBox.style.display = 'none';
        contentContainer.style.display = 'block';
    }

    function replyToNotice() {
        
    }
</script>
</script>

</body>
</html>
