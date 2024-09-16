<?php
include "connection_db.php"; 


function sanitize_filename($filename) {

    $filename = preg_replace("/[^\w\-.]/", '', $filename);
    return $filename;
}


$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $notice_message = $_POST["notice_message"];
    $file_name = "";
    $file_temp = "";

   
    if (!empty($_FILES["file"]["name"])) {
        $file_name = $_FILES["file"]["name"]; 
        $file_name = sanitize_filename($file_name); 
        $file_temp = $_FILES["file"]["tmp_name"]; 
    }

  
    $student_id = null;
    $teacher_id = null;

    
    $recipient_type = $_POST["recipient_type"];
    if ($recipient_type === "student") {
        $student_id = $_POST["student_id"];
    } elseif ($recipient_type === "teacher") {
        $teacher_id = $_POST["teacher_id"];
    }

   
    $sql = "INSERT INTO notices (student_id, teacher_id, recipient_type, notice_message, file_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connectivity, $sql);

   
    mysqli_stmt_bind_param($stmt, "iisss", $student_id, $teacher_id, $recipient_type, $notice_message, $file_name);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        
        if (!empty($file_temp)) {
    
            $upload_directory = "uploads/"; 

          
            if (!file_exists($upload_directory)) {
                mkdir($upload_directory, 0777, true); 
            }

            $target_file = $upload_directory . basename($file_name);

            if (move_uploaded_file($file_temp, $target_file)) {
                $message = "Notice added successfully.";
            } else {
                $message = "Error uploading file.";
             
                $message .= "Upload directory: $upload_directory<br>";
                $message .= "Target file: $target_file<br>";
                $message .= "File temp: $file_temp<br>";
            }
        } else {
     
            $message = "Notice added successfully.";
        }
    } else {
        $message = "Error: " . mysqli_error($connectivity);
    }


    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notice</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 14px;
            color: #008080;
        }
        

        h2 {
            text-align: center;
            margin-bottom: 16px;
            font-size: 18px;
            color: #008080;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
            font-size: 14px;
            color: #008080;
        }

        select,
        textarea,
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            background-color: #008080;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005454;
        }

        #student_selection,
        #teacher_selection {
            display: none;
        }

        #recipient_type {
            margin-bottom: 16px;
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
            margin-top: 20px;
            width: 120px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #logout-btn:h over {
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

        #sidebar a, .dropbtn {
            padding: 12px;
            display: block;
            text-decoration: none;
            color: #008080;
            cursor: pointer;
        }

        #sidebar a:hover, .dropdown:hover .dropbtn {
            background-color: #4dcccc;
            color: #ffffff;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #e0f2f1;
            min-width: 200px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content.show {
            display: block;
        }

       
        .dropdown:hover .dropdown-content {
            display: block;
        }

       
        .dropbtn {
        padding: 12px;
        display: block;
        text-decoration: none;
        color: #008080;
        cursor: pointer;
        width: 200px; 
        text-align: left; 
    }
       
        .arrow-down {
            float: right;
        }
        
        #form-container {
            margin-left: 220px; 
            padding: 16px;
        }
        #admin-icon {
        position: relative;
        text-align: center;
        margin-bottom: 20px;
    }

    .admin-line {
        width: 160px;
        height: 2px;
        background-color: #008080;
        margin: 10px auto 20px auto;
    }

    .admin-line h1 {
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
<div id="admin-icon">
        
        <h1>Admin</h1>
        <div class="admin-line"></div>
    </div>
    <a href="admin.php"><i class="fas fa-home"></i> Home</a>
   
    
    <a href="add_notice.php" class="active"><i class="fas fa-plus"></i> Add Notice</a>
    <a href="prescription.php"><i class="fas fa-file-prescription"></i> Add Prescription</a>
    <a href="filter.php"><i class="fas fa-file-prescription"></i> Report Generator</a>
    <div style="margin-top: 10px;"></div>
    <div class="dropdown">
        <button class="dropbtn" id="studentDropdownBtn"><i class="fas fa-user-graduate"></i> Student <span class="arrow-down">&#9662;</span></button>
        <div class="dropdown-content" id="studentDropdown">
            <a href="manage_student.php">Manage Students</a>
            <a href="view_admin_notices.php">View Notices</a>
            <a href="view_prescription.php">View Prescription</a>
            <a href="view_message_student.php">View Message</a>
          

        </div>
    </div>
    <div style="margin-top: 10px;"></div>
    <div class="dropdown">
        <button class="dropbtn"><i class="fas fa-chalkboard-teacher"></i> Teacher <span class="arrow-down">&#9662;</span></button>
        <div class="dropdown-content">
            <a href="manage_teacher.php">Manage Teacher</a>
            <a href="view_notice_teacher.php">View Teacher Notices</a>
            <a href="view_prescription_teacher.php">View Prescription</a>
            <a href="view_message_teacher.php">View Message</a>
        </div>
    </div>

    <form method="post" action="logout.php" id="logout-form">
        <button type="submit" id="logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
    </form>
</div>
  
    <div id="form-container">
        <h2>Add Notice</h2>
       
        <?php if (!empty($message)) : ?>
            <div id="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
           
            <label for="recipient_type">Select Recipient Type:</label>
            <select name="recipient_type" id="recipient_type">
                <option value="none">None</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <div id="student_selection">
                <label for="student_id">Select Student:</label>
                <select name="student_id" id="student_id">
                   
                    <?php
                   
                    $student_query = "SELECT student_id, name FROM student";
                    $student_result = mysqli_query($connectivity, $student_query);
                    while ($row = mysqli_fetch_assoc($student_result)) {
                        echo "<option value='{$row['student_id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="teacher_selection">
                <label for="teacher_id">Select Teacher:</label>
                <select name="teacher_id" id="teacher_id">
                  
                    <?php
                   
                    $teacher_query = "SELECT teacher_id, name FROM teacher";
                    $teacher_result = mysqli_query($connectivity, $teacher_query);
                    while ($row = mysqli_fetch_assoc($teacher_result)) {
                        echo "<option value='{$row['teacher_id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <label for="notice_message">Notice Message:</label>
            <textarea name="notice_message" id="notice_message" rows="4" cols="50"></textarea>
            <label for="file">Upload File:</label>
            <input type="file" name="file" id="file">
            <input type="submit" value="Send Notice">
        </form>
    </div>

   
    <script>
        document.getElementById('recipient_type').addEventListener('change', function() {
            var studentSelection = document.getElementById('student_selection');
            var teacherSelection = document.getElementById('teacher_selection');
            if (this.value === 'student') {
                studentSelection.style.display = 'block';
                teacherSelection.style.display = 'none';
            } else if (this.value === 'teacher') {
                studentSelection.style.display = 'none';
                teacherSelection.style.display = 'block';
            } else {
                studentSelection.style.display = 'none';
                teacherSelection.style.display = 'none';
            }
        });
    </script>
</body>
</html>
