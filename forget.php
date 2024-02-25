<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['Username'];
        $DOB = date('Y-m-d',strtotime($_POST['DOB']));

        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }
        $query = "SELECT * FROM student WHERE USN = '$username' OR Email = '$username' AND DOB = '$DOB'";
        $result = $conn->query($query);
        if($result->num_rows == 1){
            //login success
            header("location: student_home.php");
            exit();
        }
        
        $query = "SELECT * FROM staff WHERE Staff_Id = '$username' OR Email = '$username' AND DOB = '$DOB'";
        $result = $conn->query($query);
        if($result->num_rows == 1){
            //login success
            header("location: staff_home.php");
            exit();
        }
        else{
                //login failed
                echo '<script>
                window.location.href = "forget.html";
                alert("Login failed. Invalid username or Date of Birth")
                </script>';

                 exit();
        }
        $conn->close();
    }
?>

