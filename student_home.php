<?php
        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }
            $dbinfo = "SELECT * FROM student";
            $result = $conn->query($dbinfo);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
            $USN = $row['USN'];
            $Name = $row['Name'];
            $Email = $row['Email'];
            $Ph_No = $row['Ph_No'];
            $Department = $row['Department'];
            $DOB = $row['DOB'];
            $Gender = $row['Gender'];
                }
        }
        $conn->close();
        
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
        <a href="student_home.php">Dashboard</a>
        <a href="#" onclick="toggleProfileCard(event)">Profile</a>
        <a href="#">Quizzes</a>
        <a href="index.html">Sign Out</a>
    </div>
</div>
<div class="main">
    <h1>Welcome to Online Examination System</h1>
    <h2>Take any Quiz</h2>
 
<table>
    <thead>
        <tr>
            <th>Quiz Title</th>
            <th>Created On</th>
            <th>Created By</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Quiz 1</td>
            <td></td>
            <td></td>
            <td><a href="#" class="take-quiz-link">Take Quiz</a></td>
        </tr>
        <tr>
            <td>Quiz 2</td>
            <td></td>
            <td></td>
            <td><a href="#" class="take-quiz-link">Take Quiz</a></td>
        </tr>
       
    </tbody>
</table>
    <div class="leaderboard">
        <h2>Leaderboard</h2>
        <table>
            <thead>
                <tr>
                    <th>Quiz Title</th>
                    <th>Student Name</th>
                    <th>Score Obtained</th>
                    <th>Max Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Quiz 1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Quiz 2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Quiz 3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="profile-card" id="profileCard">
        <h3>User Details</h3>
        <p>Type of user: Student</p>
        <p>Name: <span><?php echo $Name; ?></span></p>
        <p>USN:<span><?php echo $USN; ?></span></p>
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
