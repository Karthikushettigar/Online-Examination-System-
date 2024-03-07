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
    echo "<table border='1'>";
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
