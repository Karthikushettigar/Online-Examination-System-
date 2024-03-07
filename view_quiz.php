<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve quiz ID from the form
    $quizId = $_POST['quizId'];

    // Check if the quiz ID exists in the database
    $sql = "SELECT * FROM question WHERE Quiz_Id = '$quizId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Set the quiz ID in the session
        $_SESSION['last_quiz_id'] = $quizId;

        // Retrieve questions for the quiz from the database
        $sql = "SELECT * FROM question WHERE Quiz_Id = '$quizId'";
        $result = $conn->query($sql);

        // Display questions
        if ($result->num_rows > 0) {
            echo "<h2>Quiz Questions</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h3><strong> Question:</strong>" . $row['Question'] . "</h3>";
                echo "<ul>";
                echo "<li><strong>Option1:</strong>" . $row['Option1'] . "</li>";
                echo "<li><strong>Option2:</strong>" . $row['Option2'] . "</li>";
                echo "<li><strong>Option3:</strong>" . $row['Option3'] . "</li>";
                echo "<li><strong>Option4:</strong>" . $row['Option4'] . "</li>";
                echo "</ul>";
                echo "<p><strong>Correct Answer:</strong> " . $row['Correct_Option'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No questions found for this quiz ID.";
        }
    } else {
        echo "No questions found for this quiz ID.";
    }
}

// Close database connection
$conn->close();
?>


