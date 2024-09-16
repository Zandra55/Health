<?php

include "connection_db.php";


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $noticeId = $_GET['id'];
    
  
    $sql = "DELETE FROM notices WHERE notice_id = $noticeId"; 
    $result = mysqli_query($connectivity, $sql);
    
   
    if ($result) {
       
        echo "Notice deleted successfully!";
    } else {
      
        echo "Error deleting notice: " . mysqli_error($connectivity);
    }
} else {
   
    echo "Invalid notice ID!";
}
?>
