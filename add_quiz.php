<?php
session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Quiz_Id = $_POST['Quiz_Id'];
        $Quiz_Name = $_POST['Quiz_Name'];
        $Date_Created = date('Y-m-d',strtotime($_POST['Date_Created']));

        // if ($_SESSION['username'] == '@' ) {
        //     $Email = $_SESSION['username'];
        // }
        // else{
        //     $Staff_Id = $_SESSION['username'];
        // }
        

        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }
        $username = $_SESSION['username'];

        if ($username == '@') {
            // Insert into Staff_Id
            $query = "INSERT INTO quiz (Quiz_Id, Quiz_Name, Date_Created, Email) VALUES ('$Quiz_Id', '$Quiz_Name', '$Date_Created', '$username')";
        } else {
            // Insert into Email
            $query = "INSERT INTO quiz (Quiz_Id, Quiz_Name, Date_Created, Staff_Id) VALUES ('$Quiz_Id', '$Quiz_Name', '$Date_Created', '$username')";
        }
        $result = $conn->query($query);
    // echo '<script>
    //         window.location.href = "#";
    //         alert("Successfully Registered")
    //     </script>';
        exit();
        }
    // }