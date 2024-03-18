<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
     
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
</head>
<body>
<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "admin";
$dbname = "dbms";
$conn = new mysqli($host, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch leaderboard data from the score table
$query = "SELECT * FROM score";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h2>Leaderboard</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>USN</th><th>Email</th><th>Total Score</th><th>Score Obtained</th></tr>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Fetch student details based on USN or email
        if (!empty($row['USN'])) {
            $studentQuery = "SELECT * FROM student WHERE USN='" . $row['USN'] . "'";
        } else {
            $studentQuery = "SELECT * FROM student WHERE Email='" . $row['Email'] . "'";
        }
        $studentResult = $conn->query($studentQuery);
        $studentRow = $studentResult->fetch_assoc();

        echo "<tr>";
        echo "<td>" . $studentRow['Name'] . "</td>";
        echo "<td>" . $studentRow['USN'] . "</td>";
        echo "<td>" . $studentRow['Email'] . "</td>";
        echo "<td>" . $row['Total_Score'] . "</td>";
        echo "<td>" . $row['Score'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found";
}

// Close database connection
$conn->close();
?>
</body>
</html>
