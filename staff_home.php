<?php
        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }
            
            $dbinfo = "SELECT Staff_Id, Name, Email, Ph_No, Department, DOB, Gender FROM staff";
            $result = $conn->query($dbinfo);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
            $Staff_Id = $row['Staff_Id'];
            $Name = $row['Name'];
            $Email = $row['Email'];
            $Ph_No = $row['Ph_No'];
            $Department = $row['Department'];
            $DOB = $row['DOB'];
            $Gender = $row['Gender'];
                }
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
        <a href="#">Quizzes</a>
        <a href="index.html">Sign Out</a>
    </div>
</div>
<div class="main">
    <h1>Welcome to Online Examination System</h1>
    <h2>Dashboard</h2>
    <div class="container">
        <div class="box">
            <h3>Add Quiz</h3>
        </div>
        <div class="box">
            <h3>Delete Quiz</h3>
        </div>
        <div class="box">
            <h3>View Quiz</h3>
        </div>
    </div>
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
        <p>Type of user:</p>
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
