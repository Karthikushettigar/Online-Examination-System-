<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Staff_Id = $_POST['Staff_Id'];
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Ph_No = $_POST['Phone_Number'];
        $Department = $_POST['Department'];
        $DOB = date('Y-m-d',strtotime($_POST['DOB']));
        $Gender = $_POST['Gender'];
        $Password = $_POST['Password'];

        $host = "localhost";
        $dusername = "root";
        $dpassword = "admin";
        $dbname = "dbms";
        $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
        if($conn->connect_error){
            die("connection failed".$conn->connect_error);
        }
        
        
        $check = "select * from Staff where Email='$Email'";
        $result = $conn->query($check);
        $count = mysqli_num_rows($result);
        if($count>0){
            echo '<script>
            window.location.href = "signup.html";
            alert("Email already listed")
        </script>';
        }
        $check = "select * from staff where Staff_Id='$Staff_Id'";
        $result = $conn->query($check);
        $count = mysqli_num_rows($result);
        if($count>0){
            echo '<script>
            window.location.href = "signup.html";
            alert("Staff Id already listed")
        </script>';
        }
        else
        if(!empty($Staff_Id) && !empty($Email) && !empty($Password) && !is_numeric($Staff_Id))
        {
        $query = "insert into staff (Staff_Id, Name, Email, Ph_No, Department, DOB, Gender, Password) values('$Staff_Id', '$Name', '$Email', $Ph_No, '$Department', '$DOB', '$Gender', '$Password' )";
        $result = $conn->query($query);
        echo '<script>
                window.location.href = "signup.html";
                alert("Successfully Registered")
            </script>';
            exit();
        }
        else
        {
            echo '<script>
                window.location.href = "signup.html";
                alert("Please Enter some Valid Information")
            </script>';
            exit();
        }
        $conn->close();
    }
?>