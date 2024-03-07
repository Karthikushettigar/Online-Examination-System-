<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Submission</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <h2>Quiz Submitted Successfully!</h2>
    <?php
    session_start();

    // Check if the score is set in the session
    if (isset($_SESSION['score']) && isset($_SESSION['totalQuestions'])) {
        $score = $_SESSION['score'];
        $totalQuestions = $_SESSION['totalQuestions'];

        // Display score
        echo "<p>Score: $score / $totalQuestions</p>";

        // Unset the session variables
        unset($_SESSION['score']);
        unset($_SESSION['totalQuestions']);
    } else {
        echo "<p>Score: N/A</p>";
    }
    ?>
    <a href="student_home.php">Go to Dashboard</a>
</body>
</html>
