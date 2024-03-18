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

    // Delete the quiz and its associated questions from the database
    $deleteQuizSQL = "DELETE FROM quiz WHERE Quiz_Id = '$quizId'";
    $deleteQuestionsSQL = "DELETE FROM question WHERE Quiz_Id = '$quizId'";

    if ($conn->query($deleteQuizSQL) === TRUE && $conn->query($deleteQuestionsSQL) === TRUE) {
        echo '<script>
        window.location.href = "delete_quiz.html";
        alert("Quiz and associated questions deleted successfully.")
        </script>';
    } else {
        echo "Error deleting quiz: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
