<?php
session_start();
require('connection_db.php');

if ($_SESSION['login'] != "admin") {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_student'])) {
       
    } elseif (isset($_POST['update_teacher'])) {
        
    }
}

if (isset($_GET['s_id'])) {
    
} elseif (isset($_GET['t_id'])) {
    
} else {
    echo "Invalid request";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-y: auto; 
        }
        .container {
            max-width: 600px; 
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto; 
        }
        h2 {
            text-align: center;
            color: teal; 
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        textarea {
            width: calc(100% - 42px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: teal; 
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #008080; 
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

    </style>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div id="sidebar">
    <a href="admin.php"><i class="fas fa-home"></i>Home</a>
   
    
    <a href="add_notice.php"><i class="fas fa-plus"></i>Add Notice</a>
    <a href="prescription.php"><i class="fas fa-file-prescription"></i> Add Prescription</a>
    <div style="margin-top: 10px;"></div>
    <div class="dropdown">
        <button class="dropbtn" id="studentDropdownBtn"><i class="fas fa-user-graduate"></i>Student <span class="arrow-down">&#9662;</span></button>
        <div class="dropdown-content" id="studentDropdown">
            <a href="manage_student.php">Manage Students</a>
            <a href="view_admin_notices.php">View Notices</a>
            <a href="view_prescription.php">View Prescription</a>
            <a href="view_message_student.php">View Message</a>
          

        </div>
    </div>
    <div style="margin-top: 10px;"></div>
    <div class="dropdown">
        <button class="dropbtn"><i class="fas fa-chalkboard-teacher"></i>Teacher <span class="arrow-down">&#9662;</span></button>
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
<?php
require('connection_db.php');



if ($_SESSION['login'] != "admin") {
    header('Location:index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_student'])) {
       
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date_of_birth = $_POST['date_of_birth'];
       
        $address = $_POST['address'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $illness = $_POST['illness'];
        $past_medical_history = $_POST['past_medical_history'];
        $mental_health = $_POST['mental_health'];
        $medication = $_POST['medication'];
        $guardian_fname = $_POST['guardian_fname'];
        $guardian_contact = $_POST['guardian_contact'];

        $sql = "UPDATE student SET name='$name', email='$email', password='$password', date_of_birth='$date_of_birth',  address='$address', weight='$weight', height='$height', illness='$illness', past_medical_history='$past_medical_history', mental_health='$mental_health', medication='$medication', guardian_fname='$guardian_fname', guardian_contact='$guardian_contact' WHERE student_id=$student_id";
        if (mysqli_query($connectivity, $sql)) {
            $_SESSION['message'] = "Student data updated successfully";
        } else {
            $_SESSION['message'] = "Error updating student data: " . mysqli_error($connectivity);
        }
        header('Location: admin.php');
        exit();
    } elseif (isset($_POST['update_teacher'])) {
        
        $teacher_id = $_POST['teacher_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date_of_birth = $_POST['date_of_birth'];
       
        $address = $_POST['address'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $illness = $_POST['illness'];
        $past_medical_history = $_POST['past_medical_history'];
        $mental_health = $_POST['mental_health'];
        $medication = $_POST['medication'];
        $guardian_fname = $_POST['guardian_fname'];
        $guardian_contact = $_POST['guardian_contact'];
        $department = $_POST['department'];

        $sql = "UPDATE teacher SET name='$name', email='$email', password='$password', Date_of_birth='$date_of_birth', gender='$gender', address='$address', weight='$weight', height='$height', illness='$illness', past_medical_history='$past_medical_history', mental_health='$mental_health', medication='$medication', guardian_fname='$guardian_fname', guardian_contact='$guardian_contact', department='$department' WHERE teacher_id=$teacher_id";
        if (mysqli_query($connectivity, $sql)) {
            $_SESSION['message'] = "Teacher data updated successfully";
        } else {
            $_SESSION['message'] = "Error updating teacher data: " . mysqli_error($connectivity);
        }
        header('Location: admin.php');
        exit();
    }
}


if (isset($_GET['s_id'])) {
   
    $student_id = $_GET['s_id'];
    $sql = "SELECT * FROM student WHERE student_id=$student_id";
    $result = mysqli_query($connectivity, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container">
        <h2>Update Student</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">
            Name: <input type="text" name="name" value="<?= $row['name'] ?>"><br>
            Email: <input type="email" name="email" value="<?= $row['email'] ?>"><br>
            <label for="password">Password:</label>
        <div class="password-wrapper">
            <input type="password" name="password" id="password" value="<?= $row['password'] ?>" required>
            <span class="toggle-password" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye" id="toggleIcon"></i>
            </span>
        </div>
            Date of Birth: <input type="date" name="date_of_birth" value="<?= $row['date_of_birth'] ?>"><br>
           
            Address: <input type="text" name="address" value="<?= $row['address'] ?>"><br>
            Weight: <input type="text" name="weight" value="<?= $row['weight'] ?>"><br>
            Height: <input type="text" name="height" value="<?= $row['height'] ?>"><br>
            Illness: <input type="text" name="illness" value="<?= $row['illness'] ?>"><br>
            Past Medical History: <input type="text" name="past_medical_history" value="<?= $row['past_medical_history'] ?>"><br>
            Mental Health Problem: <input type="text" name="mental_health" value="<?= $row['mental_health'] ?>"><br>
            Medication: <input type="text" name="medication" value="<?= $row['medication'] ?>"><br>
            Guardian Full Name: <input type="text" name="guardian_fname" value="<?= $row['guardian_fname'] ?>"><br>
            Guardian Contact Number: <input type="text" name="guardian_contact" value="<?= $row['guardian_contact'] ?>"><br>
            <input type="submit" name="update_student" value="Update">
        </form>
    </div>
<?php
} elseif (isset($_GET['t_id'])) {
   
    $teacher_id = $_GET['t_id'];
    $sql = "SELECT * FROM teacher WHERE teacher_id=$teacher_id";
    $result = mysqli_query($connectivity, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container">
        <h2>Update Teacher</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="teacher_id" value="<?= $row['teacher_id'] ?>">
            Name: <input type="text" name="name" value="<?= $row['name'] ?>"><br>
            Email: <input type="email" name="email" value="<?= $row['email'] ?>"><br>
            <label for="password">Password:</label>
        <div class="password-wrapper">
            <input type="password" name="password" id="password" value="<?= $row['password'] ?>" required>
            <span class="toggle-password" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye" id="toggleIcon"></i>
            </span>
        </div>
        Date of Birth: <input type="date" name="date_of_birth" value="<?= $row['date_of_birth'] ?>"><br>
           
            Address: <input type="text" name="address" value="<?= $row['address'] ?>"><br>
            Weight: <input type="text" name="weight" value="<?= $row['weight'] ?>"><br>
            Height: <input type="text" name="height" value="<?= $row['height'] ?>"><br>
            Illness: <input type="text" name="illness" value="<?= $row['illness'] ?>"><br>
            Past Medical History: <input type="text" name="past_medical_history" value="<?= $row['past_medical_history'] ?>"><br>
            Mental Health Problem: <input type="text" name="mental_health" value="<?= $row['mental_health'] ?>"><br>
            Medication: <input type="text" name="medication" value="<?= $row['medication'] ?>"><br>
            Guardian Full Name: <input type="text" name="guardian_fname" value="<?= $row['guardian_fname'] ?>"><br>
            Guardian Contact Number: <input type="text" name="guardian_contact" value="<?= $row['guardian_contact'] ?>"><br>
            Department: <input type="text" name="department" value="<?= $row['department'] ?>"><br>
            <input type="submit" name="update_teacher" value="Update">
        </form>
    </div>
<?php
} else {
    echo "Invalid request";
}
?>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>
