<?php
include "connection_db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $recipient_type = $_POST['recipient_type'];
    $recipient_id = ($recipient_type == 'teacher') ? $_POST['teacher_id'] : $_POST['student_id'];
    $doctor_name = $_POST['doctor_name'];
    $medications = $_POST['medications'];
    $instructions = $_POST['instructions'];
    $notes = $_POST['notes'];

    
    $sql = "INSERT INTO prescription_history (recipient_id, recipient_type, doctor_name, medications, instructions, notes) VALUES (?, ?, ?, ?, ?, ?)";
    
   
    $stmt = $connectivity->prepare($sql);
    $stmt->bind_param("isssss", $recipient_id, $recipient_type, $doctor_name, $medications, $instructions, $notes);

   
    if ($stmt->execute()) {
       
        $message = "Prescription added successfully.";
    } else {
       
        $error_message = "Error: " . $connectivity->error;
    }

   
    $stmt->close();
}


$teacher_query = "SELECT teacher_id, name FROM teacher";
$teacher_result = mysqli_query($connectivity, $teacher_query);


$student_query = "SELECT student_id, name FROM student";
$student_result = mysqli_query($connectivity, $student_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #white;
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

        .container {
            width: 120%;
            max-width: 600px;
            margin: 80px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 100px rgba(0, 0, 0, 0.1);
            margin-right : 200px;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #008080;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            color: #008080;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #008080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #005454;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
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
   
    
    <a href="add_notice.php"><i class="fas fa-plus"></i> Add Notice</a>
    <a href="prescription.php" class="active"><i class="fas fa-file-prescription"></i> Add Prescription</a>
    <a href="filter.php"><i class="fas fa-file-prescription"></i> Report Generator</a>
    <div style="margin-top: 10px;"></div>
    <div class="dropdown">
        <button class="dropbtn" id="studentDropdownBtn"><i class="fas fa-user-graduate"></i> Student <span class="arrow-down">&#9662;</span></button>
        <div class="dropdown-content" id="studentDropdown">
            <a href="manage_student.php"> Manage Students</a>
            <a href="view_admin_notices.php"> View Notices</a>
            <a href="view_prescription.php"> View Prescription</a>
            <a href="view_message_student.php"> View Message</a>
          

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
<div class="container">
    <h2>Prescription Form</h2>
    <?php if (isset($message)): ?>
    <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-bottom: 10px;"><?php echo $message; ?></div>
    <?php elseif (isset($error_message)): ?>
    <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 10px;"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="recipient_type">Select Recipient Type:</label>
        <select name="recipient_type" id="recipient_type">
            <option value="none">None</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>
        <div id="teacher_selection" style="display: none;">
            <label for="teacher_id">Select Teacher:</label>
            <select name="teacher_id" id="teacher_id">
                <?php while ($row = mysqli_fetch_assoc($teacher_result)): ?>
                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div id="student_selection" style="display: none;">
            <label for="student_id">Select Student:</label>
            <select name="student_id" id="student_id">
                <?php while ($row = mysqli_fetch_assoc($student_result)): ?>
                    <option value="<?php echo $row['student_id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <label for="doctor_name">Doctor Name:</label>
        <input type="text" name="doctor_name" id="doctor_name" required>
        <label for="medications">Medications:</label>
        <textarea name="medications" id="medications" rows="4" required></textarea>
        <label for="instructions">Instructions:</label>
        <textarea name="instructions" id="instructions" rows="4"></textarea>
        <label for="notes">Notes:</label>
        <textarea name="notes" id="notes" rows="4"></textarea>
        <input type="submit" value="Submit">
    </form>
</div>

<script>
    document.getElementById('recipient_type').addEventListener('change', function() {
        var teacherSelection = document.getElementById('teacher_selection');
        var studentSelection = document.getElementById('student_selection');
        if (this.value === 'teacher') {
            teacherSelection.style.display = 'block';
            studentSelection.style.display = 'none';
        } else if (this.value === 'student') {
            teacherSelection.style.display = 'none';
            studentSelection.style.display = 'block';
        } else {
            teacherSelection.style.display = 'none';
            studentSelection.style.display = 'none';
        }
    });
</script>
</body>
</html>
