<?php  
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch quiz ID from session
    $Quiz_Id = $_SESSION['last_quiz_id'];

    // Array to store questions data
    $questionsData = [];

    // Check if the keys exist in the $_POST array
    if (isset($_POST['numberOfQuestions'])) {
        $numberOfQuestions = $_POST['numberOfQuestions'];

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

        // Loop through POST data to retrieve questions and options
        for ($i = 1; $i <= $numberOfQuestions; $i++) {
            // Check if the keys exist in the $_POST array before accessing them
            if (isset($_POST['question' . $i], $_POST['option1_' . $i], $_POST['option2_' . $i], $_POST['option3_' . $i], $_POST['option4_' . $i], $_POST['correctAnswer' . $i])) {
                $question = $_POST['question' . $i];
                $option1 = $_POST['option1_' . $i];
                $option2 = $_POST['option2_' . $i];
                $option3 = $_POST['option3_' . $i];
                $option4 = $_POST['option4_' . $i];
                $correctAnswer = $_POST['correctAnswer' . $i];

                // SQL query to insert question into the database
                $sql = "INSERT INTO question (Question, Option1, Option2, Option3, Option4, Correct_Option, Quiz_Id) 
                        VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correctAnswer', '$Quiz_Id')";

                if ($conn->query($sql) === TRUE) {
                    // Question inserted successfully
                    $questionsData[] = array(
                        'question' => $question,
                        'options' => array($option1, $option2, $option3, $option4),
                        'correctAnswer' => $correctAnswer
                    );
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }

        // Close database connection
        $conn->close();

        // Output success message as PHP alert
        echo "<script>alert('Questions added successfully!');</script>";
        exit(); // Exit to prevent further output
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staffans</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <h2>Enter Quiz Questions</h2>
    <form id="numberOfQuestionsForm" method="POST">
        <label for="numberOfQuestions">Number of Questions:</label>
        <input type="number" id="numberOfQuestions" name="numberOfQuestions" min="1" required>
        <button type="submit">Generate Forms</button>
    </form>

    <div id="questionFormsContainer"></div>

    <button id="submitQuiz" style="display:none;"><a href="succesful.html">Submit Quiz</a></button>
    <div id="submittedQuestions"></div>

    <script>
        document.getElementById('numberOfQuestionsForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const numberOfQuestions = parseInt(document.getElementById('numberOfQuestions').value, 10);

            let questionFormsHTML = '';

            for (let i = 1; i <= numberOfQuestions; i++) {
                questionFormsHTML += `
                    <div class="questionForm">
                        <h3>Question ${i}</h3>
                        <label for="question${i}">Question:</label>
                        <input type="text" id="question${i}" name="question${i}" required><br>
                        <label for="option1_${i}">Option 1:</label>
                        <input type="text" id="option1_${i}" name="option1_${i}" required><br>
                        <label for="option2_${i}">Option 2:</label>
                        <input type="text" id="option2_${i}" name="option2_${i}" required><br>
                        <label for="option3_${i}">Option 3:</label>
                        <input type="text" id="option3_${i}" name="option3_${i}" required><br>
                        <label for="option4_${i}">Option 4:</label>
                        <input type="text" id="option4_${i}" name="option4_${i}" required><br>
                        <label for="correctAnswer${i}">Correct Answer:</label>
                        <select id="correctAnswer${i}" name="correctAnswer${i}" required>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                            <option value="option4">Option 4</option>
                        </select><br><br>
                    </div>
                `;
            }

            document.getElementById('questionFormsContainer').innerHTML = questionFormsHTML;
            document.getElementById('submitQuiz').style.display = numberOfQuestions > 0 ? 'block' : 'none'; // Show submit button only if there are questions
        });

        document.getElementById('submitQuiz').addEventListener('click', function() {
            const form = document.getElementById('numberOfQuestionsForm');
            if (form.checkValidity()) {
                const questionForms = document.querySelectorAll('.questionForm');
                const questionsData = [];

                questionForms.forEach(function(questionForm, index) {
                    const question = questionForm.querySelector(`#question${index + 1}`).value;
                    const option1 = questionForm.querySelector(`#option1_${index + 1}`).value;
                    const option2 = questionForm.querySelector(`#option2_${index + 1}`).value;
                    const option3 = questionForm.querySelector(`#option3_${index + 1}`).value;
                    const option4 = questionForm.querySelector(`#option4_${index + 1}`).value;
                    const correctAnswer = questionForm.querySelector(`#correctAnswer${index + 1}`).value;

                    questionsData.push({
                        question: question,
                        options: [option1, option2, option3, option4],
                        correctAnswer: correctAnswer
                    });
                });

                const formData = new FormData();
                formData.append('numberOfQuestions', questionsData.length);
                questionsData.forEach(function(question, index) {
                    formData.append(`question${index + 1}`, question.question);
                    formData.append(`option1_${index + 1}`, question.options[0]);
                    formData.append(`option2_${index + 1}`, question.options[1]);
                    formData.append(`option3_${index + 1}`, question.options[2]);
                    formData.append(`option4_${index + 1}`, question.options[3]);
                    formData.append(`correctAnswer${index + 1}`, question.correctAnswer);
                });

                fetch('add_question.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('submittedQuestions').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
            } else {
                alert('Please fill in all required fields.');
            }
        });
    </script>
</body>
</html>

