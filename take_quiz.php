<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch quiz ID from the form
    $Quiz_Id = $_POST['Quiz_Id'];

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

    // Fetch questions for the given quiz ID
    $fetchQuestionsQuery = "SELECT * FROM question WHERE Quiz_Id='$Quiz_Id'";
    $questionsResult = $conn->query($fetchQuestionsQuery);

    if ($questionsResult->num_rows > 0) {
        // Initialize score variables
        $totalQuestions = $questionsResult->num_rows;
        $score = 0;

        // Display questions and process answers
        echo "<form method='POST'>";
        while ($row = $questionsResult->fetch_assoc()) {
            echo "<p><strong>Question:</strong> " . $row['Question'] . "</p>";
            // Display options as radio buttons
            echo "<strong>Option1:</strong> <input type='radio' name='answer[" . $row['Question'] . "]' value='Option1'>" . $row['Option1'] . "<br>";
            echo "<strong>Option2:</strong> <input type='radio' name='answer[" . $row['Question'] . "]' value='Option2'>" . $row['Option2'] . "<br>";
            echo "<strong>Option3:</strong> <input type='radio' name='answer[" . $row['Question'] . "]' value='Option3'>" . $row['Option3'] . "<br>";
            echo "<strong>Option4:</strong> <input type='radio' name='answer[" . $row['Question'] . "]' value='Option4'>" . $row['Option4'] . "<br>";
            
            // Check if the answer is correct and increment the score
            if (isset($_POST['answer'][$row['Question']]) && $_POST['answer'][$row['Question']] == $row['Correct_Option']) {
                $score++; // Increment score for correct answer
            }
        }
        echo "<input type='hidden' name='Quiz_Id' value='$Quiz_Id'>";
        echo "<button type='submit'>Submit Quiz</button>";
        echo "</form>";

        // Insert/update score in the table
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            // Check if the username exists in the student table
            $checkQuery = "SELECT * FROM student WHERE USN='$username' or Email='$username'";
            $result = $conn->query($checkQuery);
            if ($result->num_rows > 0) {
                // Determine whether it's an email or USN
                if (strpos($_SESSION['username'], '@') !== false) {
                    $Email = $_SESSION['username'];
                    $query = "INSERT INTO score (Score, Total_Score, Quiz_Id, Email) VALUES ('$score', '$totalQuestions', '$Quiz_Id', '$Email')";
                } else {
                    $USN = $_SESSION['username'];
                    $query = "INSERT INTO score (Score, Total_Score, Quiz_Id, USN) VALUES ('$score', '$totalQuestions', '$Quiz_Id', '$USN')";
                }
                $conn->query($query);
            } else {
                echo '<script>alert("User does not exist in the student table.");</script>';
            }
        }
    } else {
        echo '<script>window.location.href = "take_quiz.html"; alert("No questions found for this Quiz_Id")</script>';
        exit();
    }

    // Close database connection
    $conn->close();
}
?>
