<?php
session_start();
require('connection_db.php');

function emailExists($Email, $connectivity) {
    $query = "SELECT email FROM teacher WHERE email = '$Email' UNION ALL SELECT email FROM student WHERE email = '$Email'";
    $result = mysqli_query($connectivity, $query);
    return mysqli_num_rows($result) > 0;
}

function redirectWithError($errorMessage) {
    $_SESSION['error'] = $errorMessage;
    header('Location: index.php');
    exit();
}

function redirectWithMessage($message) {
    $_SESSION['message'] = $message;
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $Email = mysqli_real_escape_string($connectivity, $_POST['email']);
    if (emailExists($Email, $connectivity)) {
        redirectWithError("Pls try again! Email address already in use");
    }
}

	$Account_C = $_POST['c_type'];
   
	if ($Account_C == 'teacher') {
		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Sex=mysqli_real_escape_string($connectivity,$_POST['Sex']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
        $Weight = mysqli_real_escape_string($connectivity, $_POST['weight']);
        if ($Weight > 700) {
            $_SESSION['error'] = "ENTER A VALID WEIGHT!";
            header('Location: index.php');
            exit();
        }
        $Height = mysqli_real_escape_string($connectivity, $_POST['height']);
        if ($Height > 500) {
            $_SESSION['error'] = "ENTER A VALID HEIGHT";
            header('Location: index.php');
            exit();
        }
        $Illness = isset($_POST['illness']) ? $_POST['illness'] : array();
		$OtherIllness = null;
		
		if (in_array('Others', $Illness)) {
			$OtherIllness = mysqli_real_escape_string($connectivity, $_POST['otherIllness']);
			
			$Illness = array_diff($Illness, ['Others']);
			
			$Illness[] = $OtherIllness;
		}
		
		
		$Illness = implode(", ", $Illness);
		

        $Past_Medical_History = isset($_POST['past_medical_history']) ? $_POST['past_medical_history'] : array();
        if (in_array('Others', $Past_Medical_History)) {
            $OtherPastMedicalHistory = mysqli_real_escape_string($connectivity, $_POST['otherPastMedicalHistory']);
            
            $Past_Medical_History = array_diff($Past_Medical_History, ['Others']);
          
            $Past_Medical_History[] = $OtherPastMedicalHistory;
        }
        
        $Past_Medical_History = implode(", ", $Past_Medical_History);

        $Mental_Health = isset($_POST['mental_health']) ? $_POST['mental_health'] : array();
        if (in_array('Others', $Mental_Health)) {
            $OtherMentalHealth = mysqli_real_escape_string($connectivity, $_POST['otherMentalHealth']);
           
            $Mental_Health = array_diff($Mental_Health, ['Others']);
           
            $Mental_Health[] = $OtherMentalHealth;
        }
       
        $Mental_Health = implode(", ", $Mental_Health);
        $Medication = mysqli_real_escape_string($connectivity, $_POST['medication']);
        $Guardian_Fname = mysqli_real_escape_string($connectivity, $_POST['guardian_fname']);
        $Guardian_Contact = mysqli_real_escape_string($connectivity, $_POST['guardian_contact']);

		$Department=mysqli_real_escape_string($connectivity,$_POST['department']);
		
		$username= $_POST['email'];
		$Pass=$_POST['password'];
		$C_Pass=$_POST['confirm_password'];

		$Checking = "SELECT * FROM teacher WHERE email ='$username'";
		$result= mysqli_query($connectivity,$Checking);
		$row_count= mysqli_num_rows($result);
        $sql = "SELECT * FROM teacher WHERE email = '$Email'";
        $result = mysqli_query($connectivity, $sql);
       
			if($row_count > 0)
			{
				$_SESSION['message']=" Dear, ". $Name." You are already registered.";
				header("Location:index.php");
			}
			elseif ($Pass != $C_Pass) {
				$_SESSION['error']="Password do not match";
				header('Location:index.php');
			}
			else{
				$Database="INSERT INTO teacher(name,email,password,address,weight,height,illness,past_medical_history,mental_health,medication,guardian_fname,guardian_contact,Date_of_birth,gender,salary,department)VALUES('$Name','$Email','$Pass','$Address','$Weight','$Height','$Illness','$Past_Medical_History','$Mental_Health','$Medication','$Guardian_Fname','$Guardian_Contact','$Dob','$Sex','$Salary','$Department')";
				if(mysqli_query($connectivity,$Database))
				{
					$_SESSION['message']=" Dear, ". $Name." your are registered.";
					header("Location:teacher.php");
				}
				else
				{
					echo '<script type="text/javascript">alert("!! May be SQL query wrong");</script>';
					echo mysqli_error($connectivity);
				}
			}
	}
	elseif ($Account_C == 'student') {

		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Sex=mysqli_real_escape_string($connectivity,$_POST['Sex']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
        $Weight = mysqli_real_escape_string($connectivity, $_POST['weight']);
        if ($Weight > 700) {
            $_SESSION['error'] = "ENTER A VALID WEIGHT!";
            header('Location: index.php');
            exit();
        }
        $Height = mysqli_real_escape_string($connectivity, $_POST['height']);
        if ($Height > 500) {
            $_SESSION['error'] = "ENTER A VALID HEIGHT";
            header('Location: index.php');
            exit();
        }
        $Illness = isset($_POST['illness']) ? $_POST['illness'] : array();
		$OtherIllness = null;
		
		if (in_array('Others', $Illness)) {
			$OtherIllness = mysqli_real_escape_string($connectivity, $_POST['otherIllness']);
		
			$Illness = array_diff($Illness, ['Others']);
			
			$Illness[] = $OtherIllness;
		}
		
		
		$Illness = implode(", ", $Illness);
		

        $Past_Medical_History = isset($_POST['past_medical_history']) ? $_POST['past_medical_history'] : array();
        if (in_array('Others', $Past_Medical_History)) {
            $OtherPastMedicalHistory = mysqli_real_escape_string($connectivity, $_POST['otherPastMedicalHistory']);
            
            $Past_Medical_History = array_diff($Past_Medical_History, ['Others']);
            
            $Past_Medical_History[] = $OtherPastMedicalHistory;
        }
        
        $Past_Medical_History = implode(", ", $Past_Medical_History);

        $Mental_Health = isset($_POST['mental_health']) ? $_POST['mental_health'] : array();
        if (in_array('Others', $Mental_Health)) {
            $OtherMentalHealth = mysqli_real_escape_string($connectivity, $_POST['otherMentalHealth']);
         
            $Mental_Health = array_diff($Mental_Health, ['Others']);
           
            $Mental_Health[] = $OtherMentalHealth;
        }
      
        $Mental_Health = implode(", ", $Mental_Health);
        $Medication = mysqli_real_escape_string($connectivity, $_POST['medication']);
        $Guardian_Fname = mysqli_real_escape_string($connectivity, $_POST['guardian_fname']);
        $Guardian_Contact = mysqli_real_escape_string($connectivity, $_POST['guardian_contact']);

		$Department = mysqli_real_escape_string($connectivity,$_POST['department']);

		$username= $_POST['email'];
		$Pass=$_POST['password'];
		$C_Pass=$_POST['confirm_password'];

		$Checking = "SELECT * FROM student WHERE email ='$username'";
		$result= mysqli_query($connectivity,$Checking);
		$row_count= mysqli_num_rows($result);
			if($row_count > 0)
			{
				$_SESSION['message']=" Dear, ". $Name." You are already registered.";
				header("Location:index.php");
			}
			elseif ($Pass != $C_Pass) {
				$_SESSION['error']="Password do not match";
				header('Location:index.php');
			}
			else{
				$Database="INSERT INTO student(name,email,password,date_of_birth,Gender,address,weight,height,illness,past_medical_history,mental_health,medication,guardian_fname,guardian_contact,department)VALUES('$Name','$Email','$Pass','$Dob','$Sex','$Address','$Weight','$Height','$Illness','$Past_Medical_History','$Mental_Health','$Medication','$Guardian_Fname','$Guardian_Contact','$Department')";
			
				if(mysqli_query($connectivity,$Database))
				{
					$_SESSION['message']=" Dear, ". $Name." you are registered.";
					header("Location:student.php");
				}
				else
				{
					echo mysqli_error($connectivity);
				}
			}
	}
	elseif (isset($_POST['s_id'])) {

		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$dob=mysqli_real_escape_string($connectivity,$_POST['dob']);
		$gender=$_POST['gender'];
		$photo=$_POST['photo'];
		$address=$_POST['address'];
        $Weight = mysqli_real_escape_string($connectivity, $_POST['weight']);
        if ($Weight > 700) {
            $_SESSION['error'] = "ENTER A VALID WEIGHT!";
            header('Location: index.php');
            exit();
        }
        $Height = mysqli_real_escape_string($connectivity, $_POST['height']);
        if ($Height > 500) {
            $_SESSION['error'] = "ENTER A VALID HEIGHT";
            header('Location: index.php');
            exit();
        }
        $Illness = isset($_POST['illness']) ? $_POST['illness'] : array();
		$OtherIllness = null;
		
		if (in_array('Others', $Illness)) {
			$OtherIllness = mysqli_real_escape_string($connectivity, $_POST['otherIllness']);
			
			$Illness = array_diff($Illness, ['Others']);
			
			$Illness[] = $OtherIllness;
		}
		
		
		$Illness = implode(", ", $Illness);
		

        $Past_Medical_History = isset($_POST['past_medical_history']) ? $_POST['past_medical_history'] : array();
        if (in_array('Others', $Past_Medical_History)) {
            $OtherPastMedicalHistory = mysqli_real_escape_string($connectivity, $_POST['otherPastMedicalHistory']);
            
            $Past_Medical_History = array_diff($Past_Medical_History, ['Others']);
            
            $Past_Medical_History[] = $OtherPastMedicalHistory;
        }
       
        $Past_Medical_History = implode(", ", $Past_Medical_History);

        $Mental_Health = isset($_POST['mental_health']) ? $_POST['mental_health'] : array();
        if (in_array('Others', $Mental_Health)) {
            $OtherMentalHealth = mysqli_real_escape_string($connectivity, $_POST['otherMentalHealth']);
      
            $Mental_Health = array_diff($Mental_Health, ['Others']);
            
            $Mental_Health[] = $OtherMentalHealth;
        }
     
        $Mental_Health = implode(", ", $Mental_Health);
        $Medication = mysqli_real_escape_string($connectivity, $_POST['medication']);
        $Guardian_Fname = mysqli_real_escape_string($connectivity, $_POST['guardian_fname']);
        $Guardian_Contact = mysqli_real_escape_string($connectivity, $_POST['guardian_contact']);
		$course=$_POST['course'];
		$student_id=$_POST['s_id'];

			$sql="UPDATE student SET name='$name',email='$email',password='$password',date_of_birth='$dob',Gender='$gender',photo='$photo',address='$address',weight='$Weight',height='$Height',illness='$Illness',past_medical_history='$Past_Medical_History',mental_health='$Mental_health',medication='$Medication',guardian_fname='$Guardian_Fname',guardian_contact='$Guardian_Contact',course_type='$course' WHERE student_id=$student_id";
				if(mysqli_query($connectivity,$sql)){
					header('location:admin.php');
				}
				else{
					mysqli_error($connectivity);
				}
			
	}
	elseif (isset($_POST['t_id'])) {

		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$address=$_POST['address'];
        $Weight = mysqli_real_escape_string($connectivity, $_POST['weight']);
    if ($Weight > 700) {
        $_SESSION['error'] = "ENTER A VALID WEIGHT";
        header('Location: index.php');
        exit();
    }
    $Height = mysqli_real_escape_string($connectivity, $_POST['height']);
    if ($Height > 500) {
        $_SESSION['error'] = "ENTER A VALID HEIGHT";
        header('Location: index.php');
        exit();
    }
        $Illness = isset($_POST['illness']) ? $_POST['illness'] : array();
		$OtherIllness = null;
		
		if (in_array('Others', $Illness)) {
			$OtherIllness = mysqli_real_escape_string($connectivity, $_POST['otherIllness']);
			
			$Illness = array_diff($Illness, ['Others']);
			
			$Illness[] = $OtherIllness;
		}
		
		
		$Illness = implode(", ", $Illness);
		

        $Past_Medical_History = isset($_POST['past_medical_history']) ? $_POST['past_medical_history'] : array();
        if (in_array('Others', $Past_Medical_History)) {
            $OtherPastMedicalHistory = mysqli_real_escape_string($connectivity, $_POST['otherPastMedicalHistory']);
          
            $Past_Medical_History = array_diff($Past_Medical_History, ['Others']);
            
            $Past_Medical_History[] = $OtherPastMedicalHistory;
        }
       
        $Past_Medical_History = implode(", ", $Past_Medical_History);

        $Mental_Health = isset($_POST['mental_health']) ? $_POST['mental_health'] : array();
        if (in_array('Others', $Mental_Health)) {
            $OtherMentalHealth = mysqli_real_escape_string($connectivity, $_POST['otherMentalHealth']);
           
            $Mental_Health = array_diff($Mental_Health, ['Others']);
          
            $Mental_Health[] = $OtherMentalHealth;
        }
      
        $Mental_Health = implode(", ", $Mental_Health);
        $Medication = mysqli_real_escape_string($connectivity, $_POST['medication']);
        $Guardian_Fname = mysqli_real_escape_string($connectivity, $_POST['guardian_fname']);
        $Guardian_Contact = mysqli_real_escape_string($connectivity, $_POST['guardian_contact']);
		$dob=$_POST['dob'];
		$gender=$_POST['gender'];
		$photo=$_POST['photo'];
		$salary=$_POST['salary'];
		$department=$_POST['department'];
		$teacher_id=$_POST['t_id'];

			$sql="UPDATE teacher SET name='$name',email='$email',password='$password',address='$address',weight='$Weight',height='$Height',illness='$Illness',past_medical_history='$Past_Medical_History',mental_health='$Mental_Health',medication='$Medication',guardian_fname='$Guardian_Fname',guardian_contact='$Guardian_Contact',Date_of_birth='$dob',gender='$gender',photo='$photo',salary='$salary',department='$department' WHERE teacher_id=$teacher_id";
				if(mysqli_query($connectivity,$sql)){
					header('location:admin.php');
				}
				else{
					mysqli_error($connectivity);
				}
			
	}
	elseif (isset($_GET['s_id'])) {
		$student_id=$_GET['s_id'];

		$sql="DELETE FROM student WHERE student_id=$student_id";
			if(mysqli_query($connectivity,$sql)){
				header('location:admin.php');
			}
			else{
				mysqli_error($connectivity);
			}
	}
	elseif (isset($_GET['t_id'])) {
		$teacher_id=$_GET['t_id'];

		$sql="DELETE FROM teacher WHERE teacher_id=$teacher_id";
			if(mysqli_query($connectivity,$sql)){
				header('location:admin.php');
			}
			else{
				mysqli_error($connectivity);
			}
	}
	elseif (isset($_GET['st_id'])) {
		$student_id=$_GET['st_id'];

		$sql="DELETE FROM student WHERE student_id=$student_id";
			if(mysqli_query($connectivity,$sql)){
				header('location:index.php');
				session_destroy();
			}
			else{
				mysqli_error($connectivity);
			}
	}
	elseif (isset($_GET['tt_id'])) {
		$teacher_id=$_GET['tt_id'];

		$sql="DELETE FROM teacher WHERE teacher_id=$teacher_id";
			if(mysqli_query($connectivity,$sql)){
				header('location:index.php');
				session_destroy();
			}
			else{
				mysqli_error($connectivity);
			}
	}
	else
	{
		echo mysqli_error($connectivity);
	}

?>