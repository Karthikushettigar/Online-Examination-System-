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
        echo "<form method='POST'>"; // Opening form tag
        while ($row = $questionsResult->fetch_assoc()) {
            echo "<p><strong>Question:</strong> " . $row['Question'] . "</p>";
            // Display options as radio buttons
            echo "<strong>Options:</strong><br>";
            for ($i = 1; $i <= 4; $i++) {
                echo "<input type='radio' name='answer[" . $row['Question'] . "]' value='Option$i'>" . $row['Option'.$i] . "<br>";
            }
        }
        echo "<input type='hidden' name='Quiz_Id' value='$Quiz_Id'>";
        echo "<button type='submit'>Submit Quiz</button>"; // Submit button
        echo "</form>"; // Closing form tag

        // Process submitted answers and calculate score
 // Process submitted answers and calculate score
if(isset($_POST['answer'])) {
    foreach($_POST['answer'] as $question => $selectedOption) {
        $question = $conn->real_escape_string($question); // Sanitize input
        $selectedOption = $conn->real_escape_string($selectedOption); // Sanitize input
        
        // Fetch correct option from the database
        $fetchCorrectOptionQuery = "SELECT Correct_Option FROM question WHERE Question='$question' AND Quiz_Id='$Quiz_Id'";
        $correctOptionResult = $conn->query($fetchCorrectOptionQuery);
        
        if($correctOptionResult->num_rows == 1) {
            $correctOptionRow = $correctOptionResult->fetch_assoc();
            
            // Compare user-selected option with correct option
            if(strtolower($correctOptionRow['Correct_Option']) === strtolower($selectedOption)) {
                $score++;
            }
        }
    }
    
    // Display score
    echo "<p>Score: $score / $totalQuestions</p>";
    
    // Insert/update score in the table
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        // Check if the username exists in the student table
        $checkQuery = "SELECT * FROM student WHERE USN='$username'or Email='$username'";
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
}

    } else {
        echo '<script>
        window.location.href = "take_quiz.html";
        alert("No questions found for this Quiz_Id")
        </script>';
        exit();
    }

    // Close database connection
    $conn->close();
}
?>
