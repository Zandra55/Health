<?php
include "connection_db.php";

function deletePrescription($prescription_id) {
    global $connectivity;
    $sql = "DELETE FROM prescription_history WHERE id = $prescription_id";
    if ($connectivity->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


$sql = "SELECT ph.id, 
               s.name AS patient_name, 
               ph.doctor_name, 
               ph.medications AS prescription_message, 
               ph.created_at
        FROM prescription_history ph
        INNER JOIN student s ON ph.recipient_id = s.student_id AND ph.recipient_type = 'student'";
$result = $connectivity->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Prescriptions</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
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

        .container {
            margin-left: 220px;
            padding: 20px;
        }

        h2 {
            color: #008080;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #008080;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .delete-btn {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }
        #search-container {
            margin: 20px auto; 
            text-align: center; 
        }

        #search {
            padding: 8px;
            width: 800px;
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
            <a href="view_prescription_teacher.php">View Prescription</a>
            <a href="view_message_teacher.php">View Message</a>
        </div>
    </div>

    <form method="post" action="logout.php" id="logout-form">
        <button type="submit" id="logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
    </form>
</div>
<div class="container">
    <h2>Student Prescriptions</h2>
    <div id="search-container">
            <input type="text" id="search" oninput="searchPrescriptions()" placeholder="Search">
            <button id="search-btn"><i class="fas fa-search"></i></button>
        </div>

    <table border="1">
        <tr>
            <th>Prescription ID</th>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Prescription Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["patient_name"] . "</td>";
                echo "<td>" . $row["doctor_name"] . "</td>";
                echo "<td>" . $row["prescription_message"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td><button class='delete-btn' onclick='deletePrescription(" . $row["id"] . ")'>Delete</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No prescriptions found.</td></tr>";
        }
        ?>
    </table>
</div>

<script>
    function deletePrescription(id) {
        if (confirm("Are you sure you want to delete this prescription?")) {
           
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    location.reload();
                }
            };
            xhttp.open("GET", "delete_prescription.php?id=" + id, true);
            xhttp.send();
        }
    }
    function searchPrescriptions() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
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
