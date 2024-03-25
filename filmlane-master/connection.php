<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "movies_booking";

// Create a connection
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (mysqli_connect_errno()) {
    $alertMessage = "Database connection failed: " . mysqli_connect_error();
    echo "<script>alert('$alertMessage');</script>";
} 


// Login code
if (isset($_POST['signin'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role = 'customer'";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['uname'] = $user['name'];
                header("Location: home.php");
            } else {
                echo "<script>alert('Invalid email or password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Error in query.');</script>";
        }
    } else {
        echo "<script>alert('Email and password are required.');</script>";
    }
}
?>
