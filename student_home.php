<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirect to login page if not logged in
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];

// Connect to the database
$host = "localhost";
$dusername = "root";
$dpassword = "admin";
$dbname = "dbms";
$conn = new mysqli($host, $dusername, $dpassword, $dbname, 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL query to fetch student details based on username
$stmt = $conn->prepare("SELECT USN, Name, Email, Ph_No, Department, DOB, Gender FROM student WHERE USN = ? OR Email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of the first row (assuming username is unique)
    $row = $result->fetch_assoc();
            $USN = $row['USN'];
            $Name = $row['Name'];
            $Email = $row['Email'];
            $Ph_No = $row['Ph_No'];
            $Department = $row['Department'];
            $DOB = $row['DOB'];
            $Gender = $row['Gender'];
                }
        $conn->close();
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Examination System</title>
    <style>
       
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .navbar a:hover {
            background-color: #555;
        }

        
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align:center;
        }

        .container h1 {
            margin-top: 0;
            font-size: 36px;
            color: #333;
        }

        .container h2 {
            font-size: 24px;
            color: #333;
        }

       
        .profile-card {
            display: none;
            position: absolute;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .profile-card h3 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .profile-card p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        
        .take-quiz-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .take-quiz-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-left">
        <a href="#">Online Examination System</a>
    </div>
    <div class="navbar-right">
        <a href="student_home.php">Dashboard</a>
        <a href="#" onclick="toggleProfileCard(event)">Profile</a>
        <a href="take_quiz.html">Quizzes</a>
        <a href="index.html">Sign Out</a>
    </div>
</div>

<div class="container">
    <h1>Welcome to Online Examination System</h1>
    <h2>Take any Quiz</h2>
    <a href="take_quiz.html" class="take-quiz-link">Take Quiz</a>

    <div class="leaderboard">
        <h2>View Leaderboard</h2>
        <a href="leaderboard.php" class="take-quiz-link">Leaderboard</a>
    </div>

    <div class="profile-card" id="profileCard">
        <h3>User Details</h3>
        <p>Type of user: Student</p>
        <p>Name: <span><?php echo $Name; ?></span></p>
        <p>USN: <span><?php echo $USN; ?></span></p>
        <p>Email: <span><?php echo $Email; ?></span></p>
        <p>Ph.no: <span><?php echo $Ph_No; ?></span></p>
        <p>Department: <span><?php echo $Department; ?></span></p>
        <p>DOB: <span><?php echo $DOB; ?></span></p>
        <p>Gender: <span><?php echo $Gender; ?></span></p>
    </div>
</div>

<script>
    function toggleProfileCard(event) {
        var profileCard = document.getElementById('profileCard');
        if (profileCard.style.display === 'block') {
            profileCard.style.display = 'none';
        } else {
            profileCard.style.display = 'block';
        }
        event.stopPropagation();
    }

    document.body.addEventListener('click', function() {
        var profileCard = document.getElementById('profileCard');
        profileCard.style.display = 'none';
    });
</script>

</body>
</html>
