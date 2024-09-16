<?php
session_start(); 

include "connection_db.php";


$success_message = "";


if(isset($_SESSION['student_id'])) {
    
    $student_id = $_SESSION['student_id'];

    
    if(isset($_POST['submit'])) {
       
        if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
           
            $file_name = $_FILES['file']['name'];
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];

           
            $upload_directory = "uploads/";

           
            $file_path = $upload_directory . $file_name;
            if(move_uploaded_file($file_tmp_name, $file_path)) {
                

                
                if(isset($_POST['message']) && !empty($_POST['message'])) {
                    $message = $_POST['message']; 
                } else {
                    $message = ""; 
                }

               
                $conn = new mysqli($hostname, $username, $password, $dbName);

               
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

               
                $stmt = $conn->prepare("INSERT INTO student_messages (sender_id, recipient_type, message, file_name, file_size, file_type, created_at) VALUES (?, 'admin', ?, ?, ?, ?, NOW())");
                $stmt->bind_param("issss", $student_id, $message, $file_name, $file_size, $file_type);

               
                if ($stmt->execute()) {
                    $success_message = "Message sent successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                
                $stmt->close();
                $conn->close();
            } else {
                echo "Error: Failed to move the uploaded file.";
            }
        } else {
           
            if(isset($_POST['message']) && !empty($_POST['message'])) {
               
                $message = $_POST['message'];

                
                $conn = new mysqli($hostname, $username, $password, $dbName);

                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

               
                $stmt = $conn->prepare("INSERT INTO student_messages (sender_id, recipient_type, message, created_at) VALUES (?, 'admin', ?, NOW())");
                $stmt->bind_param("is", $student_id, $message);

                
                if ($stmt->execute()) {
                    $success_message = "Message sent successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

               
                $stmt->close();
                $conn->close();
            } else {
                $success_message = "Error: Message is empty!";
            }
        }
    }
} else {
   
    header("Location: login.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Send Message</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #white; 
}

.container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: 5px solid teal; 
    margin-right: 190px; 
}


h2 {
    text-align: center;
    color: #008080; 
}

form {
    max-width: 400px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #008080; 
}

input[type="text"],
textarea,
input[type="file"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
    background-color: #fff; 
}

textarea {
    height: 150px;
    resize: vertical;
}

input[type="submit"] {
    background-color: #008080; 
    color: #fff;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #005454; 
}

.success-message {
    color: #008080; 
    text-align: center;
    margin-top: 20px;
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
    background-color: #008080; 
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
   MESSAGES
</div>

    <div id="sidebar">
    <div id="student-icon">
        
        <h1>Student</h1>
        <div class="student-line"></div>
    </div>
        <a href="dashboard_student.php"><i class="fas fa-home"></i> Home</a>
        <a href="student.php"><i class="fas fa-user"></i> Profile</a>
        <a href="view_notices.php"><i class="fas fa-bell"></i> Notices</a>
        <a href="student_prescription.php"><i class="fas fa-bell"></i> Prescription</a>
        <a href="send_message_student.php" class="active"><i class="fas fa-comment"></i> Send Message</a>
        <form method="post" action="logout.php" id="logout-form">
            <input type="submit" id="logout-btn" value="Logout">
        </form>
    </div>
    
    
    <div class="container">
        <h2>Send Message to Admin</h2>
        <form action="send_message_student.php" method="post" enctype="multipart/form-data">
           
            <label for="student_id">Your Student ID:</label>
            <input type="text" id="student_id" name="student_id" value="<?php echo isset($student_id) ? $student_id : ''; ?>" disabled>

            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" cols="50"></textarea>

           
            <label for="file">Upload File (Optional):</label>
            <input type="file" id="file" name="file">

          
            <input type="submit" name="submit" value="Send Message">

           
            <?php if(!empty($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
   
   

</body>
</html>

