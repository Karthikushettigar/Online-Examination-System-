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

    // Prepare and execute SQL query to fetch staff details based on username
    $stmt = $conn->prepare("SELECT Staff_Id, Name, Email, Ph_No, Department, DOB, Gender FROM staff WHERE Staff_Id = ? OR Email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Output data of the first row (assuming username is unique)
        $row = $result->fetch_assoc();
            $Staff_Id = $row['Staff_Id'];
            $Name = $row['Name'];
            $Email = $row['Email'];
            $Ph_No = $row['Ph_No'];
            $Department = $row['Department'];
            $DOB = $row['DOB'];
            $Gender = $row['Gender'];
                }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: #333; 
        }

        .navbar-left {
            float: left;
        }

        .navbar-right {
            float: right;
        }

        .navbar a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd; 
            color: black;
        }
        
        .main {
            text-align: center;
        }
        
        .box1 {
            border: 2px solid black;
            height: 60px;
            width: 120px;
        }
        
        .container {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        .box {
            width: 200px;
            height: 100px;
            background-color: #f0f0f0;
            border: 2px solid #333;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .box:hover {
            background-color: #ddd;
        }

        .box h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        
        .leaderboard {
            position: relative;
            top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 2px solid #555;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
       
        .profile-card {
            display: none;
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f0f0f0;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        .take-quiz-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            border: 1px solid #000;
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
        <a href="staff_home.php">Dashboard</a>
        <a href="#" onclick="toggleProfileCard(event)">Profile</a>
        <a href="leaderboard.php">leaderboard</a>
        <a href="index.html">Sign Out</a>
    </div>
</div>
<div class="main">
    <h1>Welcome to Online Examination System</h1>
    <h2>Dashboard</h2>
    <div class="container">
        <div class="box">
            <h3><a href="add_quiz.html"> Add Quiz</a></h3>
        </div>
        <div class="box">
            <h3><a href="delete_quiz.html"> Delete Quiz</a></h3>
        </div>
        <div class="box">
            <h3><a href="view_quiz.html"> View Quiz</a></h3>
        </div>
    </div>
    <div class="leaderboard">
        <h2>Leaderboard</h2>
        <a href="leaderboard.php" class="take-quiz-link">Leaderboard</a>
        
    </div>
  
    <div class="profile-card" id="profileCard">
        <h3>User Details</h3>
        <p>Type of user: Staff</p>
        <p>Name: <span><?php echo $Name; ?></span></p>
        <p>Staff_Id:<span><?php echo $Staff_Id; ?></span></p>
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
