<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }
        $query = "SELECT * FROM student WHERE USN = '$username' OR Email = '$username' AND Password = '$password'";
        $result = $conn->query($query);
        if($result->num_rows == 1){
            //login success
            header("location: success.html");
            exit();
        }
        
        $query = "SELECT * FROM staff WHERE Staff_Id = '$username' OR Email = '$username' AND Password = '$password'";
        $result = $conn->query($query);
        if($result->num_rows == 1){
            //login success
            header("location: success1.html");
            exit();
        }
        else{
                //login failed
                echo '<script>
                window.location.href = "index.html";
                alert("Login failed. Invalid username or password")
                </script>';

                 exit();
        }
        $conn->close();
    }
?>

