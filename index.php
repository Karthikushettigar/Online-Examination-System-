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
        
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM student WHERE (USN = ? OR Email = ?) AND Password = ?");
        $stmt->bind_param("sss", $username, $username, $password);
        
        // Execute the statement
        $stmt->execute();
        
        // Get result
        $result = $stmt->get_result();
        
        if($result->num_rows == 1){
            //login success
            session_start();
            $_SESSION['username'] = $username; // Store username in session
            header("location: student_home.php");
            exit();
        }
        else{
            // Check if it's a staff login
            $stmt = $conn->prepare("SELECT * FROM staff WHERE (Staff_Id = ? OR Email = ?) AND Password = ?");
            $stmt->bind_param("sss", $username, $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                //login success for staff
                session_start();
                $_SESSION['username'] = $username; // Store username in session
                header("location: staff_home.php");
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
        }
        $conn->close();
    }
?>

  <!-- <?php  
    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     $username = $_POST['Username'];
    //     $password = $_POST['Password'];

    //     $host = "localhost";
    //     $dusername = "root";
    //     $dpassword = "admin";
    //     $dbname = "dbms";
    //     $conn = new mysqli($host, $dusername, $dpassword, $dbname,3307);
    //     if($conn->connect_error){
    //         die("connection failed".$conn->connect_error);
    //     }
    //     $query = "SELECT * FROM student WHERE (USN = '$username' OR Email = '$username') AND Password = '$password'";
    //     $result = $conn->query($query);
    //     if($result->num_rows == 1){
    //         //login success
    //         session_start();
    //         $_SESSION['username'] = $username; // Assuming $username contains the student's username
    //         header("location: student_home.php");
    //         exit();

    //     }
        
    //     $query = "SELECT * FROM staff WHERE Staff_Id = '$username' OR Email = '$username' AND Password = '$password'";
    //     $result = $conn->query($query);
    //     if($result->num_rows == 1){
    //         //login success
    //         header("location: staff_home.php");
    //         exit();
    //     }
    //     else{
    //             //login failed
    //             echo '<script>
    //             window.location.href = "index.html";
    //             alert("Login failed. Invalid username or password")
    //             </script>';

    //              exit();
    //     }
    //     $conn->close();
    // }
// ?>
 
