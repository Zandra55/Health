<?php
require('connection_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    
    $search = mysqli_real_escape_string($connectivity, $_POST['search']);

   
    $sql = "SELECT * FROM student WHERE 
            name LIKE '%$search%' OR 
            Gender LIKE '%$search%' OR
            Department LIKE '%$search%' OR
            weight LIKE '%$search%' OR 
            height LIKE '%$search%' OR 
            illness LIKE '%$search%' OR 
            past_medical_history LIKE '%$search%' OR 
            mental_health LIKE '%$search%' OR 
            medication LIKE '%$search%' OR 
            guardian_fname LIKE '%$search%' OR 
            guardian_contact LIKE '%$search%'";
    $result = mysqli_query($connectivity, $sql);

    if ($result === false || mysqli_num_rows($result) <= 0) {
        echo "Student's data not found";
    } else {
        
        echo '<table border="1px">';
        echo '<tr>';
        echo '<th>S.N</th>';
        echo '<th>Name</th>';
        echo '<th>Gender</th>';
        echo '<th>Department</th>';
        echo '<th>Weight</th>';
        echo '<th>Height</th>';
        echo '<th>Illness</th>';
        echo '<th>Past Medical History</th>';
        echo '<th>Mental Health Problem</th>';
        echo '<th>Medication</th>';
        echo '<th>Guardian Full Name</th>';
        echo '<th>Guardian Contact Number</th>';
        echo '<th>Update</th>';
        echo '<th>Delete</th>';
        echo '</tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['student_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['gender'] . '</td>';
            echo "<td>" . (!empty($row['department']) ? $row['department'] : 'None') . "</td>";
            echo '<td>' . $row['weight'] . '</td>';
            echo '<td>' . $row['height'] . '</td>';
            echo '<td>' . (!empty($row['illness']) ? $row['illness'] : 'None') . '</td>';
            echo '<td>' . (!empty($row['past_medical_history']) ? $row['past_medical_history'] : 'None') . '</td>';
            echo '<td>' . (!empty($row['mental_health']) ? $row['mental_health'] : 'None') . '</td>';
            echo '<td>' . (!empty($row['medication']) ? $row['medication'] : 'None') . '</td>';
            echo '<td>' . (!empty($row['guardian_fname']) ? $row['guardian_fname'] : 'None') . '</td>';
            echo '<td>' . (!empty($row['guardian_contact']) ? $row['guardian_contact'] : 'None') . '</td>';
            echo '<td><a href="update.php?s_id=' . $row['student_id'] . '">UPDATE</a></td>';
            echo '<td><a href="insert_db.php?s_id=' . $row['student_id'] . '">DELETE</a></td>';
            echo '</tr>';
        }

        echo '</table>';
    }
} else {
   
    echo "Invalid request!";
}
?>
