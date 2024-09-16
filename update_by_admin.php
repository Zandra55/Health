<?php
	session_start();
	require('connection_db.php');

	$Account_C = $_POST['c_type'];

	if ($Account_C == 'teacher') {
		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Sex=mysqli_real_escape_string($connectivity,$_POST['Sex']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
		
        $Weight=mysqli_real_escape_string($connectivity,$_POST['weight']);
        $Height=mysqli_real_escape_string($connectivity,$_POST['height']);
        $Illness=mysqli_real_escape_string($connectivity,$_POST['illness']);
        $Past_Medical_History=mysqli_real_escape_string($connectivity,$_POST['past_medical_history']);
        $Mental_Health=mysqli_real_escape_string($connectivity,$_POST['mental_health']);
        $Medication=mysqli_real_escape_string($connectivity,$_POST['medication']);
        $Guardian_Fname=mysqli_real_escape_string($connectivity,$_POST['guardian_fname']);
        $Guardian_Contact=mysqli_real_escape_string($connectivity,$_POST['guardian_contact']);

		$Department=mysqli_real_escape_string($connectivity,$_POST['department']);
		$Salary=mysqli_real_escape_string($connectivity,$_POST['salary']);

		$username= $_POST['email'];
		$Pass=$_POST['password'];
		$C_Pass=$_POST['confirm_password'];

		$Checking = "SELECT * FROM teacher WHERE email ='$username'";
		$result= mysqli_query($connectivity,$Checking);
		$row_count= mysqli_num_rows($result);
			if($row_count > 0)
			{
				$_SESSION['message']=" Dear, admin the Name ". $Name." is already registered.";
				header("Location:admin.php");
			}
			elseif ($Pass != $C_Pass) {
				$_SESSION['error']="Password do not match";
				header('Location:admin.php');
			}
			else{
				$Database="INSERT INTO teacher(name,email,password,address,weight,height,illness,past_medical_history,mental_health,medication,guardian_fname,guardian_contact,Date_of_birth,gender,department,)VALUES('$Name','$Email','$Pass','$Address','$Weight','$Height','$illness','$Past_Medical_History','$Mental_Health','$Medication','$Guardian_Fname','$Guardian_Contact','$Dob','$Sex','$Salary','$Department')";
				if(mysqli_query($connectivity,$Database))
				{
					$_SESSION['message']=" Dear, admin the Name ". $Name." is registered.";
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
        $Weight=mysqli_real_escape_string($connectivity,$_POST['weight']);
        $Height=mysqli_real_escape_string($connectivity,$_POST['height']);
        $Illness=mysqli_real_escape_string($connectivity,$_POST['illness']);
        $Past_Medical_History=mysqli_real_escape_string($connectivity,$_POST['past_medical_history']);
        $Mental_Health=mysqli_real_escape_string($connectivity,$_POST['mental_health']);
        $Medication=mysqli_real_escape_string($connectivity,$_POST['medication']);
        $Guardian_Fname=mysqli_real_escape_string($connectivity,$_POST['guardian_fname']);
        $Guardian_Contact=mysqli_real_escape_string($connectivity,$_POST['guardian_contact']);
		

		$Course=mysqli_real_escape_string($connectivity,$_POST['course']);

		$username= $_POST['email'];
		$Pass=$_POST['password'];
		$C_Pass=$_POST['confirm_password'];

		$Checking = "SELECT * FROM student WHERE email ='$username'";
		$result= mysqli_query($connectivity,$Checking);
		$row_count= mysqli_num_rows($result);
			if($row_count > 0)
			{
				$_SESSION['message']=" Dear, admin the Name ". $Name." is already registered.";
				header("Location:admin.php");
				exit();
			}
			elseif ($Pass != $C_Pass) {
				$_SESSION['error']="Password do not match";
				header('Location:admin.php');
			}
			else{
				$Database="INSERT INTO student(name,email,password,Date_of_birth,Gender,address,weight,height,illness,past_medical_history,mental_health,medication,guardian_fname,guardian_contact,Date_of_birth,gender,department,)VALUES('$Name','$Email','$Pass','$Address','$Weight','$Height','$illness','$Past_Medical_History','$Mental_Health','$Medication','$Guardian_Fname','$Guardian_Contact','$Dob','$Sex','$Salary','$Department')";
			
				if(mysqli_query($connectivity,$Database))
				{
					$_SESSION['message']=" Dear, admin the Name ". $Name." is registered.";
					header("Location:admin.php");
					exit();
				}
				else
				{
					echo mysqli_error($connectivity);
				}
			}
	}