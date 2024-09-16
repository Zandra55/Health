<?php
include 'connection_db.php';

if(isset($_POST['medical_problem']) && isset($_POST['selected_option'])) {
   
    $medicalProblem = mysqli_real_escape_string($conn, $_POST['medical_problem']);
    $selectedOption = mysqli_real_escape_string($conn, $_POST['selected_option']);

    $sql = "";

    if ($medicalProblem === 'present_illness') {
        $sql = "SELECT * FROM student WHERE illness = '$selectedOption'";
    } else if ($medicalProblem === 'past_medical_history') {
        $sql = "SELECT * FROM student WHERE past_medical_history = '$selectedOption'";
    } else if ($medicalProblem === 'mental_health') {
        $sql = "SELECT * FROM student WHERE mental_health = '$selectedOption'";
    }

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    } else {
        
        echo "Error: " . $conn->error;
    }
} else {
   
    echo "Invalid request";
}


$conn->close();
?>
