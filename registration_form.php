<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('bg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-color: white; 
    }


        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 10px; 
        }

        .form-container {
            background-color: #fff;
            padding: 10px; 
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 10px;
        }

        .input {
            width: calc(100% - 10px);
            height: 30px; 
            padding: 5px;
            font-size: 12px; 
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            height: 30px; 
            width: 120px; 
            font-size: 14px; 
        }

        footer {
            background-color: gray;
            height: 40px; 
            padding: 5px 10px;
            margin-top: 15px;
            text-align: left;
            font-size: 12px; 
            color: white;
        }

        
        .form-container h2 {
            font-size: 16px; 
            font-weight: bold;
            margin-bottom: 10px; 
        }

        .form-container .form-group label {
            font-size: 14px; 
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        label {
            font-size: 15px;
        }
        
header {
    background-color: #097969; 
    padding: 10px 20px; 
    display: flex;
    justify-content: space-between; 
    align-items: center;
    height: 60px; 
}

header h1 {
    color: white; 
    margin: 0; 
    font-size: 24px; 
}

.login-btn-header {
    background-color: white; 
    color: #2ecc71; 
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-btn-header:hover {
    background-color: #e6e6e6; 
}

    footer {
        background-color: #097969; 
        height: 40px;
        padding: 5px 10px;
        margin-top: 15px;
        text-align: left;
        font-size: 12px;
        color: white;
    }

    </style> 
</head>
<body>
<header>
    <h1>HEALTH AND MEDICAL RECORD SYSTEM</h1>
    <button class="login-btn-header" onclick="window.location.href='index.php'">Login</button>
</header>


    <div class="container">
    <div class="form-container">
    <h2 style="font-size: 23px; font-weight: bold;">REGISTRATION FORM</h2>
            <form action="insert_db.php" method="POST">
                <div class="form-group">
                    <label>Are you a?</label>
                    <div class="flex">
                        <select required name="c_type" style="margin: 5px; height: 45px; background-color: #F0F8FF; font-weight: bold;" class="input" onchange="toggleRole()">
                            <option value="">None</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input class="input" type="text" name="name" placeholder="Full Name" required>
                </div>

                <div class="form-group">
                    <input class="input" type="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="form-group flex">
                    <input class="input" type="password" name="password" placeholder="New Password" required>
                    <input class="input" type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <label>Date of Birth:</label>
                    <input class="input" type="date" name="Date_of_birth" required max="<?php echo date('Y-m-d'); ?>">
                </div>
               


                <div class="form-group">
                    <label>Gender:</label>
                    <div class="flex">
                        <label><input type="radio" name="Sex" value="Male" required>Male</label>
                        <label><input type="radio" name="Sex" value="Female">Female</label>
                    </div>
                </div>

                <div class="form-group">
                    <input class="input" type="text" name="address" placeholder="Your residential Address" required>
                </div>
                <div class="form-group" id="departmentField">
                <label>Department:</label>
                <select class="input" name="department">
                    <option value="">Select Department</option>
                    <option value="CCS">College of Arts And Sciences (CAS)</option>
                    <option value="CBAA">College of Business Administration and Accountancy (CBAA)</option>
                    <option value="CCS">College of Computer Studies (CCS)</option>
                    <option value="CHS">College of Health Sciences (CHS)</option>
                    <option value="CoEd">College of Education (CoEd)</option>
                    <option value="CoEng">College of Engineering (CoEng)</option>
                </select>
            </div>




            

                <div class="form-group">
                    <h2 style="font-size: 23px; font-weight: bold;">MEDICAL INFORMATION</h2>
        </div>
        <div class="form-group">
    <input class="input" type="text" name="weight" id="weightInput" placeholder="Weight (kg)" required>
    <span id="weightError" style="color: red; display: none;">Enter a valid weight (1-700)</span>
</div>

                <div class="form-group">
                    <input class="input" type="text" name="height" placeholder="Height (cm)" required>
                </div>
                <div class="form-group">
                    <label style="font-size: 15px;">Present Illness:</label>
                    <div>
                        <select id="illnessSelect" name="illness[]" class="input" style="margin-bottom: 10px; height: 40px;">
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
                    </div>
                    <input id="otherIllnessInput" type="text" name="otherIllness" class="input" placeholder="Please specify" style="width: 96%; font-size: 15px; display: none;">
                </div>

                <div class="form-group">
                    <label style="font-size: 15px;">Past Medical History</label>
                    <div>
                        <select id="pastMedicalHistorySelect" name="past_medical_history[]" class="input" style="margin-bottom: 10px; height: 40px;">
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
                    </div>
                    <input id="otherPastMedicalHistoryInput" type="text" name="otherPastMedicalHistory" class="input" placeholder="Please specify" style="width: 96%; font-size: 15px; display: none;">
                </div>

                <div class="form-group">
                    <label style="font-size: 15px;">Mental Health Problem</label>
                    <div>
                        <select id="mentalHealthSelect" name="mental_health[]" class="input" style="margin-bottom: 10px; height: 40px;">
                            <option value="">None</option>
                            <option value="Excessive sadness">Excessive sadness</option>
                            <option value="Confuse thinking or reduced ability to concentrate">Confuse thinking or reduced ability to concentrate</option>
                            <option value="Excessive fears or worries or extreme feelings of guilt">Excessive fears or worries or extreme feelings of guilt</option>
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
                    <input id="otherMentalHealthInput" type="text" name="otherMentalHealth" class="input" placeholder="Please specify" style="width: 96%; font-size: 15px; display: none;">
                </div>

                <div class="form-group">
                    <input class="input" type="text" name="medication" placeholder="Medication" required>
                </div>

                <div class="form-group">
                    <h2 style="font-size: 23px; font-weight: bold;">Emergency Contact</h2>
                </div>

                <div class="form-group">
                    <input class="input" type="text" name="guardian_fname" placeholder="Guardian Full Name" required>
                </div>
                <div class="form-group">
    <input class="input" type="text" name="guardian_contact" placeholder="Guardian Contact Number" required>
    <span id="contactError" style="color: red; display: none;">Enter a valid 11-digit contact number</span>
</div>


                <div class="form-group">
                    <h2 style="font-size: 23px; font-weight: bold;">DATA PRIVACY NOTICE:</h2>
                    <label style="font-size: 16px;">
                        I hereby acknowledge that I have acquired the consent from all parties relevant to this activity and that they allow Developer to collect, process, store, and share their personal data and hold free and harmless and indemnity Developer from any complaint, suit, or damages which any party may file.
                    </label>
                    <br>
                    <input type="checkbox" id="privacyConsent" required>
                    <label for="privacyConsent" style="font-size: 16px;">I acknowledge and agree to the above terms</label>
                </div>

                
                <div class="flex">
                    <input class="btn btn-reset" type="reset" value="Reset">
                    <input class="btn" type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
    
    <footer>
        <div>&copy; 2024</div>
        <div>Laguna University Students</div>
    </footer>

    <script>
       
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
