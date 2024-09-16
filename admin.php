<?php
require('connection_db.php');

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == "admin") {
  
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user']; 
    } else {
        $user = "Unknown"; 
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location:index.php');
    }

    if (isset($_SESSION['message'])) {
        echo '<script type="text/javascript">alert("'.$_SESSION['message'].'");</script>';
        unset($_SESSION["message"]); 
    }
} else {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Health And Medical Record System</title>
    <style type="text/css">
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            font-size: 14px;
            color: #008080;
        }

        #header {
    background-color: #008080;
    color: #ffffff;
    padding: 8px;
    text-align: center;
    font-size: 18px;
    margin-left: 140px; 
}


        .dashboard-container {
        background-color: #008080; 
        color: #ffffff; 
        border: 2px solid #008080;
        padding: 20px;
        margin-bottom: 20px;
        width: 30%; 
        min-width: 300px; 
    }

        .dashboard-container h2 {
            margin-top: 0;
            font-size: 20px;
            color: #008080;
        }


.male-box {
    background-color: #4d94ff; 
    color: #000; 
    position: fixed;
    top: 116px; 
    right: 550px;   
}

.female-box {
    background-color: #ff6666; 
    color: #000; 
    position: fixed;
    top: 250px; 
    right: 550px; 
}

.total-students-box {
    background-color: #ffd11a; 
    color: #000; 
    position: fixed;
    top: 116px;
    right: 100px;
}

.total-teachers-box {
    background-color: #70db70; 
    color: #000; 
    position: fixed;
    top: 250px;
    right: 100px;
}
.total-notices-box {
    background-color: #ff9933; 
    color: #000; 
    position: fixed;
    top: 380px; 
    right: 550px;
}

.total-prescriptions-box {
    background-color: #cc66ff; 
    color: #000; 
    position: fixed;
    top: 380px; 
    right: 100px;
}




        footer {
            background-color: #008080;
            color: #ffffff;
            text-align: center;
            padding: 1px;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }

        a {
            color: #008080;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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

        .icon {
            margin-right: 10px;
        }

        #content {
            padding-left: 220px; 
            margin-top: 60px; 
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
<div id="header">
    <h1>Health And Medical Record System</h1>
</div>

<div id="sidebar">
<div id="admin-icon">
        
        <h1>Admin</h1>
        <div class="admin-line"></div>
    </div>
    <a href="admin.php" class="active"><i class="fas fa-home"></i> Home</a>

    <a href="add_notice.php" ><i class="fas fa-plus"></i> Add Notice</a>
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

<div id="content">
    <div class="dashboard-container male-box">
        <h2><i class="fas fa-male icon"></i>Male Count</h2>
        <?php
        $student_male_count_query = "SELECT COUNT(*) AS male_count FROM student WHERE gender = 'Male'";
        $student_male_count_result = mysqli_query($connectivity, $student_male_count_query);
        $student_male_count_row = mysqli_fetch_assoc($student_male_count_result);
        $student_male_count = $student_male_count_row['male_count'];

        $teacher_male_count_query = "SELECT COUNT(*) AS male_count FROM teacher WHERE gender = 'Male'";
        $teacher_male_count_result = mysqli_query($connectivity, $teacher_male_count_query);
        $teacher_male_count_row = mysqli_fetch_assoc($teacher_male_count_result);
        $teacher_male_count = $teacher_male_count_row['male_count'];

        echo "<p>Total Male: " . ($student_male_count + $teacher_male_count) . "</p>";
        ?>
    </div>
    
    <div class="dashboard-container female-box">
        <h2><i class="fas fa-female icon"></i>Female Count</h2>
        <?php
        $student_female_count_query = "SELECT COUNT(*) AS female_count FROM student WHERE gender = 'Female'";
        $student_female_count_result = mysqli_query($connectivity, $student_female_count_query);
        $student_female_count_row = mysqli_fetch_assoc($student_female_count_result);
        $student_female_count = $student_female_count_row['female_count'];

        $teacher_female_count_query = "SELECT COUNT(*) AS female_count FROM teacher WHERE gender = 'Female'";
        $teacher_female_count_result = mysqli_query($connectivity, $teacher_female_count_query);
        $teacher_female_count_row = mysqli_fetch_assoc($teacher_female_count_result);
        $teacher_female_count = $teacher_female_count_row['female_count'];

        echo "<p>Total Female: " . ($student_female_count + $teacher_female_count) . "</p>";
        ?>
    </div>
    
    <div class="dashboard-container total-students-box">
        <h2><i class="fas fa-user-graduate icon"></i>Total Students</h2>
        <?php
        $student_count_query = "SELECT COUNT(*) AS student_count FROM student";
        $student_count_result = mysqli_query($connectivity, $student_count_query);
        $student_count_row = mysqli_fetch_assoc($student_count_result);
        $student_count = $student_count_row['student_count'];

        echo "<p>Total Students: " . $student_count . "</p>";
        ?>
    </div>
    
    <div class="dashboard-container total-teachers-box">
        <h2><i class="fas fa-chalkboard-teacher icon"></i>Total Teachers</h2>
        <?php
        $teacher_count_query = "SELECT COUNT(*) AS teacher_count FROM teacher";
        $teacher_count_result = mysqli_query($connectivity, $teacher_count_query);
        $teacher_count_row = mysqli_fetch_assoc($teacher_count_result);
        $teacher_count = $teacher_count_row['teacher_count'];

        echo "<p>Total Teachers: " . $teacher_count . "</p>";
        ?>
    </div>
    <div class="dashboard-container total-notices-box">
    <h2><i class="fas fa-bell icon"></i>Total Notices</h2>
    <?php
    $total_notices_query = "SELECT COUNT(*) AS total_notices FROM notices";
    $total_notices_result = mysqli_query($connectivity, $total_notices_query);
    $total_notices_row = mysqli_fetch_assoc($total_notices_result);
    $total_notices = $total_notices_row['total_notices'];

    echo "<p>Total Notices: " . $total_notices . "</p>";
    ?>
</div>

<div class="dashboard-container total-prescriptions-box">
    <h2><i class="fas fa-prescription-bottle icon"></i>Total Prescription History</h2>
    <?php
    $total_prescriptions_query = "SELECT COUNT(*) AS total_prescriptions FROM prescription_history";
    $total_prescriptions_result = mysqli_query($connectivity, $total_prescriptions_query);
    $total_prescriptions_row = mysqli_fetch_assoc($total_prescriptions_result);
    $total_prescriptions = $total_prescriptions_row['total_prescriptions'];

    echo "<p>Total Prescription History: " . $total_prescriptions . "</p>";
    ?>
</div>

</div>


<script>
    var studentDropdownBtn = document.getElementById("studentDropdownBtn");
    var studentDropdown = document.getElementById("studentDropdown");

    studentDropdownBtn.addEventListener("click", function() {
        studentDropdown.classList.toggle("show");
    });

    window.onclick = function(event) {
        if (!event.target.matches('#studentDropdownBtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

</body>
</html>
