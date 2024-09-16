<?php
include "connection_db.php";

$sql = "SELECT n.notice_id AS id, 
            t.name AS sender_name, 
            n.sender_type,
            n.notice_message, 
            n.file_name, 
            n.created_at 
        FROM notices n
        INNER JOIN teacher t ON n.sender_type = 'teacher' AND n.teacher_id = t.teacher_id
        ORDER BY n.notice_id DESC";

$result = mysqli_query($connectivity, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teacher Notices</title>
   
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

        table {
            width: 80%; 
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #008080;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #content {
            margin-left: 150px; 
            padding: 20px;
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
#search-container {
    text-align: center; 
    margin-top: 20px; 
}

#search-container input[type="text"] {
    width: 800px; 
    padding: 8px; 
    margin-right: 5px; 
    border-radius: 4px; 
    border: 1px solid #ccc; 
}

#search-container button {
    padding: 8px 16px; 
    border-radius: 4px; 
    border: 1px solid #ccc; 
    background-color: #f2f2f2; 
    cursor: pointer;
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
   
    <h2>Teacher Notices History</h2>
    <div id="search-container" style="text-align: center;">
        <input type="text" id="search" oninput="searchNotices()" placeholder="Search">
        <button id="search-btn"><i class="fas fa-search"></i></button>
    </div>


    <table>
        <thead>
            <tr>
                <th>Sender Name</th>
                <th>Notice Message</th>
                <th>File Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            if (mysqli_num_rows($result) > 0) {
               
                while ($row = mysqli_fetch_assoc($result)) {
                   
                    echo "<tr>";
                    echo "<td>" . $row['sender_name'] . "</td>"; 
                    echo "<td>" . $row['notice_message'] . "</td>";
                    echo "<td>" . ($row['file_name'] ? $row['file_name'] : "No file attached") . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    
                    echo "<td><button onclick=\"deleteNotice(" . $row['id'] . ")\">Delete</button></td>";
                    echo "</tr>";
                }
            } else {
               
                echo "<tr><td colspan='5'>No notices found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    function deleteNotice(noticeId) {
    console.log("Deleting notice with ID: " + noticeId); 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log("Deletion successful"); 
                location.reload(); 
            } else {
                console.error("Error deleting notice: " + this.responseText); 
            }
        }
    };
    xhttp.open("GET", "delete_notice.php?id=" + noticeId, true);
    xhttp.send();
}

function searchNotices() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            
            if (txtValue.toUpperCase().startsWith(filter)) {
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
