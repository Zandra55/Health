<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style type="text/css">
    
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        #sidebar {
            background-color: #34495e;
            color: #ffffff;
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
        }

        #sidebar a {
            padding: 10px;
            display: block;
            color: #ffffff;
            text-decoration: none;
        }

        #content {
            margin-left: 220px;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            width: 60%;
            margin: auto;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div id="sidebar">
    <a href="index.php">Home</a>
    <a href="add_student.php">Add Student</a>
    <a href="manage_student.php">Manage Students</a>
    <a href="manage_teacher.php">Manage Teachers</a>
    <form action="#" method="POST"> 
        <input id="logout-btn" type="submit" name="logout" value="Logout">
    </form>
</div>
<div id="content">
    <h2>Add Student</h2>
    <form method="post" action="insert_db.php"> 
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br><br>
       
<label for="course">Course:</label>
<input type="text" id="course" name="course"><br><br>

<label for="weight">Weight:</label>
<input type="text" id="weight" name="weight"><br><br>

<label for="height">Height:</label>
<input type="text" id="height" name="height"><br><br>

<label for="illness">Illness:</label>
<input type="text" id="illness" name="illness"><br><br>

<label for="past_medical_history">Past Medical History:</label>
<input type="text" id="past_medical_history" name="past_medical_history"><br><br>

<label for="mental_health">Mental Health Problem:</label>
<input type="text" id="mental_health" name="mental_health"><br><br>

<label for="medication">Medication:</label>
<input type="text" id="medication" name="medication"><br><br>

<label for="guardian_fname">Guardian Full Name:</label>
<input type="text" id="guardian_fname" name="guardian_fname"><br><br>

<label for="guardian_contact">Guardian Contact Number:</label>
<input type="text" id="guardian_contact" name="guardian_contact"><br><br>
<input type="submit" name="submit" value="Add Student">
    </form>
</div>

</body>
</html>