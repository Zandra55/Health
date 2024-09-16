<?php

include "connection_db.php";


$conn = new mysqli($hostname, $username, $password, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT * FROM student_messages");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: calc(95% - 250px); 
            max-width: 100%; 
            margin: 50px auto;
            margin-left: 220px; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #008080;
            color: #fff;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        
        td {
            border: 1px solid #ddd;
        }

        .delete-btn {
            background-color: #ff6666;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
            margin-top: 20px;
            width: 120px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #logout-btn:h over {
            background-color: #005454;
        }

       
        #search-container {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        #search {
            padding: 8px;
            width: 80%;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 5px;
        }

        #search-btn {
            padding: 8px 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
            cursor: pointer;
        }

        #search-btn:hover {
            background-color: #ddd;
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
            <a href="view_prescription_teacher.php">View Teacher Prescription</a>
            <a href="view_message_teacher.php">View Message</a>
        </div>
    </div>

    <form method="post" action="logout.php" id="logout-form">
        <button type="submit" id="logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
    </form>
</div>


<div class="container">
    <h2>Student Messages</h2>
    <div id="search-container">
        <input type="text" id="search" oninput="searchMessages()" placeholder="Search">
        <button id="search-btn"><i class="fas fa-search"></i></button>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Message</th>
                    <th>File</th>
                    <th>Date</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['sender_id']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['file_name']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><button class="delete-btn" onclick="deleteMessage(<?php echo $row['message_id']; ?>)">Delete</button></td> <!-- Delete button -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteMessage(messageId) {
        if (confirm("Are you sure you want to delete this message?")) {
          
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    window.location.reload();
                }
            };
            xhttp.open("GET", "delete_message.php?id=" + messageId, true);
            xhttp.send();
        }
    }

    function searchMessages() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

</script>
</body>
</html>
