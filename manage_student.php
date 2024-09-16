<?php
require('connection_db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "CALL GetStudentById(?)";
    $searchTerm = mysqli_real_escape_string($connectivity, $search); 
    $sql = "SELECT * FROM student WHERE 
            name LIKE '$searchTerm%' OR 
            weight LIKE '$searchTerm%' OR 
            height LIKE '$searchTerm%' OR 
            illness LIKE '$searchTerm%' OR 
            past_medical_history LIKE '$searchTerm%' OR 
            mental_health LIKE '$searchTerm%' OR 
            medication LIKE '$searchTerm%' OR 
            guardian_fname LIKE '$searchTerm%' OR 
            guardian_contact LIKE '$searchTerm%' OR 
            (Gender = '$searchTerm')";
    $result = mysqli_query($connectivity, $sql);
} else {
    
    $sql = "SELECT * FROM student";
    $result = mysqli_query($connectivity, $sql);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
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
.action-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: teal;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 5px;
}

.delete-btn {
    background-color: #ff4d4d; 
}

.action-btn:hover,
.delete-btn:hover {
    background-color: #005454; 
}

.action-btn:focus,
.delete-btn:focus {
    outline: none;
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
            margin-top: 20px;
            width: 120px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #logout-btn:h over {
            background-color: #005454;
        }

    
    .arrow-down {
        float: right;
    }

    
    #content {
        margin-left: 220px;
        padding: 16px;
    }

    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
        font-size: 12px; 
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: teal; 
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e0e0e0;
    }

    
    #search-container {
        margin-bottom: 16px;
    }

    #search {
        width: calc(100% - 100px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
        font-size: 14px;
    }

    #search-btn {
        background-color: teal;
        color: #fff;
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
    }

    #search-btn:hover {
        background-color: #005454;
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
    <h2 style="color: teal;">Manage Students</h2> 
    <div id="search-container">
        <input type="text" id="search" placeholder="Search">
        <button id="search-btn">Search</button>
    </div>
    <div id="students">
    <?php
    if ($result === false || mysqli_num_rows($result) <= 0) {
        echo "Student's data not found";
    } else {
        ?>
        <br>
        <b>Dear Admin, you can update all student data from this table:</b>
        <table border="1px">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Illness</th>
                <th>Past Medical History</th>
                <th>Mental Health Problem</th>
                <th>Medication</th>
                <th>Guardian Full Name</th>
                <th>Guardian Contact Number</th>
                <th>Action</th>
</tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $row['student_id']; ?></td>
    <td><?= $row['name']; ?></td>
    <td><?= $row['gender']; ?></td>
    <td><?= $row['department']; ?></td>
    <td><?= $row['weight']; ?></td>
    <td><?= $row['height']; ?></td>
    <td><?= !empty($row['illness']) ? $row['illness'] : 'None'; ?></td>
    <td><?= !empty($row['past_medical_history']) ? $row['past_medical_history'] : 'None'; ?></td>
    <td><?= !empty($row['mental_health']) ? $row['mental_health'] : 'None'; ?></td>
    <td><?= !empty($row['medication']) ? $row['medication'] : 'None'; ?></td>
    <td><?= !empty($row['guardian_fname']) ? $row['guardian_fname'] : 'None'; ?></td>
    <td><?= !empty($row['guardian_contact']) ? $row['guardian_contact'] : 'None'; ?></td>
    <td>
        <a href="update.php?s_id=<?= $row['student_id'] ?>" class="action-btn">UPDATE</a><br><br>
        <a href="insert_db.php?s_id=<?= $row['student_id'] ?>" class="action-btn delete-btn">DELETE</a>
    </td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('search');
        var searchBtn = document.getElementById('search-btn');
        
       
        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.trim();
            if (searchTerm !== '') {
                searchStudents(searchTerm);
            } else {
                loadAllStudents(); 
            }
        });

       
        searchBtn.addEventListener('click', function (event) {
            event.preventDefault(); 
            var searchTerm = searchInput.value.trim();
            if (searchTerm !== '') {
                searchStudents(searchTerm);
            } else {
                loadAllStudents(); 
            }
        });

        loadAllStudents();
    });

    
    function searchStudents(searchTerm) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("students").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "search_students.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("search=" + searchTerm);
    }

   
    function loadAllStudents() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("students").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "load_all_students.php", true);
        xhttp.send();
    }
</script>

</body>
</html>
