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
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
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
            background-color: #0056b3;
        }

        .main {
            text-align: center;
            margin-top: 50px;
        }

        .container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 50px;
        }

        .box {
            width: 200px;
            height: 100px;
            background-color: #f0f0f0;
            border: 2px solid #007bff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .box:hover {
            background-color: #e9e9e9;
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .box h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .leaderboard {
            margin-bottom: 50px;
        }

        .profile-card {
            display: none;
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .profile-card h3 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .profile-card p {
            font-size: 16px;
            margin: 10px 0;
        }

        .take-quiz-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .take-quiz-link:hover {
            background-color: #218838;
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
        <a href="leaderboard.php">Leaderboard</a>
        <a href="index.html">Sign Out</a>
    </div>
</div>

<div class="main">
    <h1>Welcome to Online Examination System</h1>
    <h2>Dashboard</h2>
    <div class="container">
        <div class="box" onclick="location.href='add_quiz.html';">
            <h3>Add Quiz</h3>
        </div>
        <div class="box" onclick="location.href='delete_quiz.html';">
            <h3>Delete Quiz</h3>
        </div>
        <div class="box" onclick="location.href='view_quiz.html';">
            <h3>View Quiz</h3>
        </div>
    </div>
    <div class="leaderboard">
        <a href="leaderboard.php" class="take-quiz-link">View Leaderboard</a>
    </div>
    <div class="profile-card" id="profileCard">
        <h3>User Details</h3>
        <p>Type of user: Staff</p>
        <p>Name: <span><?php echo $Name; ?></span></p>
        <p>Staff Id: <span><?php echo $Staff_Id; ?></span></p>
        <p>Email: <span><?php echo $Email; ?></span></p>
        <p>Phone Number: <span><?php echo $Ph_No; ?></span></p>
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
