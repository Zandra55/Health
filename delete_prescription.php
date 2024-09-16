<?php

include "connection_db.php";


if(isset($_GET['id']) && !empty($_GET['id'])) {
   
    $prescription_id = $_GET['id'];

   
    if(deletePrescription($prescription_id)) {
        
        header("Location: view_prescription.php");
        exit();
    } else {
       
        echo "Error deleting prescription.";
    }
} else {
    
    header("Location: view_prescription.php");
    exit();
}


function deletePrescription($prescription_id) {
    global $connectivity;
    $sql = "DELETE FROM prescription_history WHERE id = $prescription_id";
    if ($connectivity->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
