<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generator</title>
    <style>
  
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding-left: 220px; 
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            margin-bottom: 20px;
            text-align: center; 
        }

        .form-group {
            margin-bottom: 20px;
            text-align: center; 
        }

        label {
            font-size: 18px;
            display: block;
            margin-bottom: 5px;
            text-align: center; 
        }

        select, button {
            width: 50%; 
            padding: 8px; 
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 auto; 
            display: block;
        }

        button:hover {
            background-color: #008080;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-results {
            text-align: center;
            font-size: 18px;
            color: #777;
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

        .icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div id="sidebar">
    <a href="admin.php"><i class="fas fa-home"></i>Home</a>
    <a href="add_notice.php"><i class="fas fa-plus"></i>Add Notice</a>
    <a href="prescription.php"><i class="fas fa-file-prescription"></i> Add Prescription</a>
    <a href="report_generator.php"><i class="fas fa-file-prescription"></i> Report Generator</a>
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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <form method="post" action="logout.php" id="logout-form">
        <input type="submit" id="logout-btn" value="Logout">
    </form>
</div>
<div class="container">
    <h1>Generate Patient Report</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="reportForm">
    <div class="form-group">
    <label for="personalSelect">Select:</label>
    <select id="personalSelect" name="personal">
        <option value="">Select</option>
        <option value="department">Department</option>
        <option value="course_type">Course</option>
    </select>
</div>

<div class="form-group" id="departmentOptionsDiv" style="display: none;">
    <label for="optionsSelectDepartment">Select Department:</label>
    <select id="optionsSelectDepartment" name="department">
        <option value="">Select Department</option>
        <option value="CBAA">College of Business Administration and Accountancy (CBAA)</option>
        <option value="CCS">College of Computer Studies (CCS)</option>
        <option value="CHS">College of Health Sciences (CHS)</option>
        <option value="CoEd">College of Education (CoEd)</option>
        <option value="CoEng">College of Engineering (CoEng)</option>
    </select>
</div>
<div class="form-group" id="courseOptionsDiv" style="display: none;">
    <label for="optionsSelectCourse">Select Course:</label>
    <select id="optionsSelectCourse" name="course_type">
        <option value="">Select Course</option>
        <option value="BEED">Bachelor of Elementary Education (BEED)</option>
        <option value="BSED">Bachelor of Secondary Education (BSED)</option>
        <option value="BS ENTREP">Bachelor of Science in Entrepreneurship (BS ENTREP)</option>
        <option value="BSAIS">Bachelor of Science in Accountancy and Information Systems (BSAIS)</option>
        <option value="BSA">Bachelor of Science in Accountancy (BSA)</option>
        <option value="BSTM">Bachelor of Science in Tourism Management (BSTM)</option>
        <option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
        <option value="BSCS">Bachelor of Science in Computer Science (BSCS)</option>
        <option value="BAC">Bachelor of Arts in Communication (BAC)</option>
        <option value="BSME">Bachelor of Science in Mechanical Engineering (BSME)</option>
        <option value="MID">Master in Industrial Design (MID)</option>
    </select>
</div>



    <div class="form-group">
            <label for="criteriaSelect">Select Option:</label>
            <select id="criteriaSelect" name="criteria">
                <option value="">Select</option>
                <option value="illness">Present Illness</option>
                <option value="past_medical_history">Past Medical History</option>
                <option value="mental_health">Mental Health Problem</option>
            </select>
        </div>
        <div class="form-group" id="optionsDiv" style="display: none;">
            <label for="optionsSelect">Select:</label>
            <select id="optionsSelectIllness" name="illness" style="display: none;">
            <option value="">Select</option>
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
            <select id="optionsSelectHistory" name="past_medical_history" style="display: none;">
            <option value="">Select</option>
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
            <select id="optionsSelectMentalHealth" name="mental_health" style="display: none;">
            <option value="">Select</option>
                <option value="">None</option>
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
        <button type="submit">Generate Report</button>
        <button type="button" onclick="printReport()">Print Report</button>
    </form>
    <div id="reportTable">
        <?php
       require('connection_db.php');
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
           $personal = $_POST['personal'] ?? null;
           $department = $_POST['department'] ?? null;
           $courseType = $_POST['course_type'] ?? null;
           $criteria = $_POST['criteria'] ?? null;
           $illness = $_POST['illness'] ?? null;
           $pastMedicalHistory = $_POST['past_medical_history'] ?? null;
           $mentalHealth = $_POST['mental_health'] ?? null;
       
           $sql = "SELECT 'teacher' AS type, t.name, t.email, t.department, t.illness, t.past_medical_history, t.mental_health 
                   FROM teacher t";
       
           if (!empty($personal)) {
               if ($personal === 'department') {
                   $sql .= " WHERE t.department = '$department'";
               } elseif ($personal === 'course_type') {
                   $sql = "SELECT 'student' AS type, name, email, course_type, illness, past_medical_history, mental_health 
                           FROM student";
                   if (!empty($courseType)) {
                       $sql .= " WHERE course_type = '$courseType'";
                   }
               }
           }
       
           if (!empty($criteria)) {
            $whereClauseNeeded = true;
        
            if (!is_array($criteria)) {
                $criteria = [$criteria];
            }
        
            foreach ($criteria as $criterion) {
                $criterionValue = $_POST[$criterion] ?? null;
        
                if ($whereClauseNeeded) {
                    $sql .= " WHERE";
                    $whereClauseNeeded = false;
                } else {
                    $sql .= " AND";
                }
        
                switch ($criterion) {
                    case 'illness':
                        if (!empty($criterionValue)) {
                            $sql .= " illness = '$criterionValue'";
                        }
                        break;
                    case 'past_medical_history':
                        if (!empty($criterionValue)) {
                            $sql .= " past_medical_history = '$criterionValue'";
                        }
                        break;
                    case 'mental_health':
                        if (!empty($criterionValue)) {
                            $sql .= " mental_health = '$criterionValue'";
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        
       
           $result = mysqli_query($connectivity, $sql);
       
           if (mysqli_num_rows($result) > 0) {
               echo "<h2>People with Selected Criteria:</h2>";
               echo "<table border='1'>";
               echo "<tr><th>Type</th><th>Name</th><th>" . ($personal == 'department' ? 'Department' : 'Course Type') . "</th><th>Illness</th><th>Past Medical History</th><th>Mental Health</th></tr>";
               while ($row = mysqli_fetch_assoc($result)) {
                   echo "<tr>";
                   echo "<td>" . ucfirst($row['type']) . "</td>";
                   echo "<td>" . $row['name'] . "</td>";
                   echo "<td>" . ($row['type'] === 'teacher' ? $row['department'] : $row['course_type']) . "</td>";
                   echo "<td>" . $row['illness'] . "</td>";
                   echo "<td>" . $row['past_medical_history'] . "</td>";
                   echo "<td>" . $row['mental_health'] . "</td>";
                   echo "</tr>";
               }
               echo "</table>";
           } else {
               echo "<h2>No people found with the selected criteria.</h2>";
           }
       }
       ?>

   <script>
    document.getElementById('personalSelect').addEventListener('change', function() {
        var personal = this.value;
        var departmentOptionsDiv = document.getElementById('departmentOptionsDiv');
        var courseOptionsDiv = document.getElementById('courseOptionsDiv');

        if (personal) {
            departmentOptionsDiv.style.display = (personal === 'department') ? 'block' : 'none';
            courseOptionsDiv.style.display = (personal === 'course_type') ? 'block' : 'none';
        } else {
            departmentOptionsDiv.style.display = 'none';
            courseOptionsDiv.style.display = 'none';
        }
    });

    document.getElementById('criteriaSelect').addEventListener('change', function() {
        var criteria = this.value;
        var optionsDiv = document.getElementById('optionsDiv');
        var optionsSelectIllness = document.getElementById('optionsSelectIllness');
        var optionsSelectHistory = document.getElementById('optionsSelectHistory');
        var optionsSelectMentalHealth = document.getElementById('optionsSelectMentalHealth');

        if (criteria) {
            optionsDiv.style.display = 'block';
            optionsSelectIllness.style.display = 'none';
            optionsSelectHistory.style.display = 'none';
            optionsSelectMentalHealth.style.display = 'none';

            switch (criteria) {
                case 'illness':
                    optionsSelectIllness.style.display = 'block';
                    break;
                case 'past_medical_history':
                    optionsSelectHistory.style.display = 'block';
                    break;
                case 'mental_health':
                    optionsSelectMentalHealth.style.display = 'block';
                    break;
                default:
                    break;
            }
        } else {
            optionsDiv.style.display = 'none';
        }
    }); document.getElementById('criteriaSelect').addEventListener('change', function() {
        var criteria = this.value;
        var optionsDiv = document.getElementById('optionsDiv');
        var optionsSelectIllness = document.getElementById('optionsSelectIllness');
        var optionsSelectHistory = document.getElementById('optionsSelectHistory');
        var optionsSelectMentalHealth = document.getElementById('optionsSelectMentalHealth');

        if (criteria) {
            optionsDiv.style.display = 'block';
            optionsSelectIllness.style.display = 'none';
            optionsSelectHistory.style.display = 'none';
            optionsSelectMentalHealth.style.display = 'none';

            switch (criteria) {
                case 'illness':
                    optionsSelectIllness.style.display = 'block';
                    break;
                case 'past_medical_history':
                    optionsSelectHistory.style.display = 'block';
                    break;
                case 'mental_health':
                    optionsSelectMentalHealth.style.display = 'block';
                    break;
                default:
                    break;
            }
        } else {
            optionsDiv.style.display = 'none';
        }
    });

    function printReport() {
        var reportTable = document.getElementById("reportTable").innerHTML;
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Report</title></head><body>');
        printWindow.document.write('<div class="container">');
        printWindow.document.write('<h1>Generated Patient Report</h1>');
        printWindow.document.write(reportTable);
        printWindow.document.write('</div>');
        var logoImg = document.querySelector('.logo img');
        if (logoImg) {
            var logoHTML = '<div class="logo">' + logoImg.outerHTML + '</div>';
            printWindow.document.write(logoHTML);
        }
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
