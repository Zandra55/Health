<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$department = isset($_GET['department']) ? $_GET['department'] : '';
$illness = isset($_GET['illness']) ? $_GET['illness'] : '';
$past_medical_history = isset($_GET['past_medical_history']) ? $_GET['past_medical_history'] : '';
$mental_health = isset($_GET['mental_health']) ? $_GET['mental_health'] : '';


$sql = "(SELECT name, email, gender, 'student' as type, department, illness, past_medical_history, mental_health FROM student WHERE 1=1";
$params = [];
if (!empty($gender)) {
    $sql .= " AND gender = ?";
    $params[] = $gender;
}
if (!empty($department)) {
    $sql .= " AND department = ?";
    $params[] = $department;
}
if (!empty($illness)) {
    $sql .= " AND illness = ?";
    $params[] = $illness;
}
if (!empty($past_medical_history)) {
    $sql .= " AND past_medical_history = ?";
    $params[] = $past_medical_history;
}
if (!empty($mental_health)) {
    $sql .= " AND mental_health = ?";
    $params[] = $mental_health;
}
$sql .= ") UNION ALL (SELECT name, email, gender, 'teacher' as type, department, illness, past_medical_history, mental_health FROM teacher WHERE 1=1";
if (!empty($gender)) {
    $sql .= " AND gender = ?";
    $params[] = $gender;
}
if (!empty($department)) {
    $sql .= " AND department = ?";
    $params[] = $department;
}
if (!empty($illness)) {
    $sql .= " AND illness = ?";
    $params[] = $illness;
}
if (!empty($past_medical_history)) {
    $sql .= " AND past_medical_history = ?";
    $params[] = $past_medical_history;
}
if (!empty($mental_health)) {
    $sql .= " AND mental_health = ?";
    $params[] = $mental_health;
}
$sql .= ")";


$stmt = $conn->prepare($sql);


if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}


if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();


$result = $stmt->get_result();


if (!$result) {
    echo "Error executing query: " . $conn->error . "<br>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Filter</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            line-height: 1.6;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            #print-content, #print-content * {
                visibility: visible;
            }
            #print-content {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 240px; 
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        footer {
            background-color: #2ecc71;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            border-radius: 0 0 10px 10px;
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
        .sidebar-dropdown-content {
    display: none;
    position: absolute;
    background-color: #e0f2f1;
    min-width: 200px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown:hover .sidebar-dropdown-content {
    display: block;
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


        .form-container {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 10px;
        }

        .input {
            width: calc(100% - 10px);
            height: 30px; 
            padding: 5px;
            font-size: 14px; 
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            height: 30px;
            width: 48%;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #008080;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-reset {
            background-color: #ccc;
            color: #000;
            transition: background-color 0.3s;
        }

        .btn:hover, .btn-reset:hover {
            background-color: #005454;
        }

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px; 
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        header {
    background-color: #008080;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
h2 {
    
    font-size: 28px;
    margin-bottom: 10px;
   
}
h1 {
    
    font-size: 24px;
    margin-bottom: 10px;
    margin-left: 160px;
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
        
        <h2>Admin</h2>
        <div class="admin-line"></div>
    </div>
    <a href="admin.php"><i class="fas fa-home"></i> Home</a>
    <a href="add_notice.php"><i class="fas fa-plus"></i> Add Notice</a>
    <a href="prescription.php"><i class="fas fa-file-prescription"></i> Add Prescription</a>
    <a href="filter.php" class="active"><i class="fas fa-file-prescription"></i> Report Generator</a>
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
<header>
    <h1>HEALTH AND MEDICAL RECORD SYSTEM</h1>
</header>
<div class="container">
    <div class="form-container">
        <h2>Filter Records</h2>
        <form action="filter.php" method="GET">
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" class="input">
                    <option value="">Any</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Department:</label>
                <select name="department" class="input">
                    <option value="">Select Department</option>
                    <option value="CAS">College of Arts And Sciences (CAS)</option>
                    <option value="CBAA">College of Business Administration and Accountancy (CBAA)</option>
                    <option value="CCS">College of Computer Studies (CCS)</option>
                    <option value="CHS">College of Health Sciences (CHS)</option>
                    <option value="CoEd">College of Education (CoEd)</option>
                    <option value="CoEng">College of Engineering (CoEng)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Illness:</label>
                <select name="illness" class="input">
                    <option value="">Any</option>
                    <option value="">None</option>
                    <option value="Dental">Dental</option>
                    <option value="Abdominal Pain">Abdominal Pain</option>
                    <option value="Blurring of Vision">Blurring of Vision</option>
                    <option value="Chest Pain">Chest Pain</option>
                    <option value="Cough and Colds">Cough and Colds</option>
                    <option value="Dysuria">Dysuria</option>
                    <option value="Easy Bruisability">Easy Bruisability</option>
                    <option value="Easy Fatigability">Easy Fatigability</option>
                    <option value="Fever">Fever</option>
                    <option value="LBM">LBM</option>
                    <option value="LOC/Seizure">LOC/Seizure</option>
                    <option value="Recurrent Headache">Recurrent Headache</option>
                    <option value="Vomiting">Vomiting</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <label>Past Medical History:</label>
                <select name="past_medical_history" class="input">
                    <option value="">Any</option>
                    <option value="">None</option>
                    <option value="Allergy">Allergy</option>
                    <option value="Bleeding Disorder">Bleeding Disorder</option>
                    <option value="Bronchial Asthma">Bronchial Asthma</option>
                    <option value="Cardiovascular disease">Cardiovascular disease</option>
                    <option value="Hypertension">Hypertension</option>
                    <option value="Pulmonary Tuberculosis">Pulmonary Tuberculosis</option>
                    <option value="Skin disorder">Skin disorder</option>
                    <option value="Surgery">Surgery</option>
                    <option value="Urinary Tract Infection">Urinary Tract Infection</option>
                    <option value="Loss of consciousness">Loss of consciousness</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mental Health:</label>
                <select name="mental_health" class="input">
                    <option value="">Any</option>
                    <option value="">None</option>
                    <option value="Excessive sadness">Excessive sadness</option>
                    <option value="Confuse thinking or reduced ability to concentrate">Confuse thinking or reduced ability to concentrate</option>
                    <option value="Excessive fears or worries or extreme feelings of guilt">Excessive fears or worries or extreme feelings of guilt</option>
                    <option value="Extreme mood changes of highs and low">Extreme mood changes of highs and low</option>
                    <option value="Withdrawal from friends and activities">Withdrawal from friends and activities</option>
                    <option value="Significant tiredness, low energy or problems sleepings">Significant tiredness, low energy or problems sleepings</option>
                    <option value="Delusions, paranoia or hallucinations">Delusions, paranoia or hallucinations</option>
                    <option value="Inability to cope with daily problems or stress">Inability to cope with daily problems or stress</option>
                    <option value="Trouble understanding and relating to situations and to people">Trouble understanding and relating to situations and to people</option>
                    <option value="Problems with alcohol or drug use">Problems with alcohol or drug use</option>
                    <option value="Major changes in eating habits">Major changes in eating habits</option>
                    <option value="Sex drive changes">Sex drive changes</option>
                    <option value="Excessive anger, hostility or violence">Excessive anger, hostility or violence</option>
                    <option value="Suicidal thinking">Suicidal thinking</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="flex">
           
                <input class="btn" type="submit" value="Apply Filter">
                <button id="print-btn" class="btn btn-print" onclick="printRecords()">Print</button>

                <a href="filter.php" class="btn btn-reset">Clear Filter</a>
            </div>
        </form>
    </div>
    <div id="print-content">
    <?php if ($result !== null && $result->num_rows > 0) { ?>
        <div class="record-table">
            <h2>Filtered Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Illness</th>
                        <th>Past Medical History</th>
                        <th>Mental Health</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo ucfirst($row['type']); ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['illness']; ?></td>
                            <td><?php echo $row['past_medical_history']; ?></td>
                            <td><?php echo $row['mental_health']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
    <div>No Results Found</div>
<?php } ?>
    
</div>
<script>
    
    function printRecords() {
        window.print();
    }
</script>
</body>
</html>
