    <?php
        session_start();
        if(isset($_SESSION['login'])) {
            header('Location:'.$_SESSION['login'].".php");
            exit(); 
        } elseif(isset($_SESSION['message'])) {	
            echo '<script type="text/javascript">alert("'.$_SESSION['message'].'");</script>';
            header('Refresh:0');
            session_destroy();
            exit(); 
        } elseif(isset($_SESSION['error'])) {
            echo '<script type="text/javascript">alert("'.$_SESSION['error'].'");</script>';
            header('Refresh:0');
            session_destroy();
            exit(); 
        } elseif (isset($_SESSION['n_user'])) {
            echo '<script type="text/javascript">alert("'.$_SESSION['n_user'].'");</script>';
            header('Refresh:0');
            session_destroy();
            exit(); 
        }
       
    ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .form-container {
            background-color: #ffffff; 
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .input {
            width: 100%;
            height: 40px;
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50; 
            color: white; 
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn.signup-btn {
            background-color: #1c26f6; 
            margin-top: 10px;
        }
        .btn.signup-btn:hover {
            background-color: #45a049; 
        }
        .btn.signup-btn:focus {
            outline: none;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }
        .footer a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-homepage,
.homepage-link {
    width: 100%;
    height: 40px;
    border: none;
    border-radius: 5px;
    background-color: #1c26f6; 
    color: white; 
    font-size: 18px;
    font-weight: bold;
    margin-top: 10px; 
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-homepage:hover,
.homepage-link:hover {
    background-color: #45a049;
}

.btn-homepage:focus,
.homepage-link:focus {
    outline: none;
}


    </style>
</head>
<body>
    
    <div class="container">
        <div class="form-container">
            <h2>Log In</h2>
            <form action="login_check.php" method="POST">
                <div class="form-group">
                    <select class="input" name="login_type" required>
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>   
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="username" placeholder="Username/Email" required>
                </div>
                <div class="form-group">
                    <input class="input" type="password" name="password" id="password" placeholder="Password" required>
                    <input type="checkbox" id="showPasswordCheckbox" onclick="togglePasswordVisibility()"> 
                    <!-- Step 1: Checkbox for show/hide password -->
                    <label for="showPasswordCheckbox">Show Password</label>
                </div>
                <div class="form-group">
                    <input class="btn" type="submit" name="login" value="Login">
                </div>
            </form>
            <div class="form-group">
                <button class="btn signup-btn" onclick="window.location.href='registration_form.php'">Not registered yet? Sign Up</button>
                <button class="btn btn-homepage" onclick="window.location.href='homepage.php'">Homepage</button>
               
            </div>
           
        </div>
    </div>

   
    <script>
         function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
        function toggleRole() {
            var teacherDiv = document.getElementById('teacher');
            var studentDiv = document.getElementById('student');
            var role = document.getElementsByName('c_type')[0].value;
            if (role === 'teacher') {
                teacherDiv.style.display = 'block';
                studentDiv.style.display = 'none';
            } else if (role === 'student') {
                teacherDiv.style.display = 'none';
                studentDiv.style.display = 'block';
            } else {
                teacherDiv.style.display = 'none';
                studentDiv.style.display = 'none';
            }
        }

        document.getElementById('illnessSelect').addEventListener('change', function() {
        var otherIllnessInput = document.getElementById('otherIllnessInput');
        if (this.value === 'Others') {
            otherIllnessInput.style.display = 'block';
            otherIllnessInput.setAttribute('required', true);
        } else {
            otherIllnessInput.style.display = 'none';
            otherIllnessInput.removeAttribute('required');
        }
    });

    document.getElementById('pastMedicalHistorySelect').addEventListener('change', function() {
        var otherPastMedicalHistoryInput = document.getElementById('otherPastMedicalHistoryInput');
        if (this.value === 'Others') {
            otherPastMedicalHistoryInput.style.display = 'block';
            otherPastMedicalHistoryInput.setAttribute('required', true);
        } else {
            otherPastMedicalHistoryInput.style.display = 'none';
            otherPastMedicalHistoryInput.removeAttribute('required');
        }
    });

    document.getElementById('mentalHealthSelect').addEventListener('change', function() {
        var otherMentalHealthInput = document.getElementById('otherMentalHealthInput');
        if (this.value === 'Others') {
            otherMentalHealthInput.style.display = 'block';
            otherMentalHealthInput.setAttribute('required', true);
        } else {
            otherMentalHealthInput.style.display = 'none';
            otherMentalHealthInput.removeAttribute('required');
        }
    });
    var dateOfBirthInput = document.getElementById('dateOfBirth');

       
        var dateOfBirthInput = document.querySelector('input[name="Date_of_birth"]');
        var today = new Date().toISOString().split('T')[0];
        dateOfBirthInput.setAttribute('max', today);

       
        document.getElementById('weightInput').addEventListener('input', function() {
            var weight = parseInt(this.value);
            var weightError = document.getElementById('weightError');
            var submitButton = document.querySelector('input[type="submit"]');
            if (weight < 1 || weight > 700 || isNaN(weight)) {
                weightError.style.display = 'block';
                submitButton.disabled = true; 
            } else {
                weightError.style.display = 'none';
                submitButton.disabled = false; 
            }
        });
        document.querySelector('input[name="guardian_contact"]').addEventListener('input', function() {
    var contact = this.value;
    var contactError = document.getElementById('contactError');
    var submitButton = document.querySelector('input[type="submit"]');
    
    
    if (/^\d{11}$/.test(contact)) {
        contactError.style.display = 'none';
        submitButton.disabled = false; 
    } else {
        contactError.style.display = 'block';
        submitButton.disabled = true; 
    }
});




    </script>
    </body>
    </html>
