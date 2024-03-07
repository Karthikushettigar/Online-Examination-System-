
<?php  
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Quiz_Id = $_POST['Quiz_Id'];
        $Quiz_Name = $_POST['Quiz_Name'];
        $Date_Created = date('Y-m-d',strtotime($_POST['Date_Created']));


        // Check if the username contains '@' to determine whether it's an email or staff ID
        if (strpos($_SESSION['username'], '@') !== false) {
            $Email = $_SESSION['username'];
        } else {
            $Staff_Id = $_SESSION['username'];
        }

        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }

        
        $check = "select * from quiz where Quiz_Id='$Quiz_Id'";
        $result = $conn->query($check);
        $count = mysqli_num_rows($result);
        if($count>0){
            echo '<script>
            window.location.href = "add_quiz.html";
            alert("Quiz Id already listed")
        </script>';
        }

        // Insert into the quiz table based on whether it's an email or staff ID
        if(!empty($Quiz_Id)) {
            if(isset($Email)) {
                $query = "INSERT INTO quiz (Quiz_Id, Quiz_Name, Date_Created, Email) VALUES ('$Quiz_Id', '$Quiz_Name', '$Date_Created', '$Email')";
            } else {
                $query = "INSERT INTO quiz (Quiz_Id, Quiz_Name, Date_Created, Staff_Id) VALUES ('$Quiz_Id', '$Quiz_Name', '$Date_Created', '$Staff_Id')";
            }
            $result = $conn->query($query);
            if($result) {
                $_SESSION['last_quiz_id'] = $Quiz_Id;
                echo '<script>
                window.location.href = "add_question.php";
                
            </script>';
                // echo "Quiz added successfully!";
            } else {
                echo "Error adding quiz: " . $conn->error;
            }
            exit();
        }
    }  
?>

