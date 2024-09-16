<?php
require('connection_db.php');


if(isset($_POST['email'])) {
   
    $email = mysqli_real_escape_string($connectivity, $_POST['email']);

   
    $stmt = $connectivity->prepare("SELECT * FROM users WHERE email=?");
  
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

       
        header('Content-Type: application/json');

        if ($result) {
            if ($result->num_rows > 0) {
             
                echo json_encode(array('exists' => true));
            } else {
              
                echo json_encode(array('exists' => false));
            }
        } else {
          
            http_response_code(500); 
            echo json_encode(array('error' => 'Error executing query.'));
        }

      
        $stmt->close();
    } else {
       
        http_response_code(500); 
        echo json_encode(array('error' => 'Error preparing statement.'));
    }
} else {
  
    http_response_code(400); 
    echo json_encode(array('error' => 'Email parameter is missing.'));
}
?>
