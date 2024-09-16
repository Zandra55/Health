<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.png');
            background-size: cover;
            background-position: top;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center; 
            align-items: center;
        }
        .container {
            margin-left: 600px;
            max-width: 600px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            border-radius: 10px;
        }
        .welcome-text {
            margin-bottom: 20px;
            font-size: 32px; 
            font-weight: bold;
            color: #333;
        }
        .btn {
            width: 200px;
            height: 50px; 
            border: none;
            border-radius: 5px;
            background-color: #1c26f6;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-text">
            Welcome to Our Health and Medical Record System
        </div><br>
        <button class="btn" onclick="window.location.href='index.php'">Login</button>
    </div>
</body>
</html>
