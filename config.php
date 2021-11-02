<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "myappdb";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

if (isset($_POST['submitBtn'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name','$last_name','$email','$password')";

    if ($conn -> query($sql) == TRUE) {
        echo "<script>alert('User Registration Completed.');</script>";
    }    else {
        echo "<script>alert('Woops! Something Wrong Went.');</script>";
    }
}

if (isset($_POST['loginBtn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        if($row['password'] == $password){
            echo "<script>alert('Login Successful!');</script>";
            echo "<script>window.location.href='blogsite.php'</script>";
        }else{
            echo "<script>alert('Password is Wrong');</script>";
        }
    } else {
        echo "<script>alert('Account does not exist!');</script>";
    }
}

$sql = "SELECT id, firstname, lastname FROM users";
$result = $conn->query($sql);

if (isset($_POST['logoutBtn'])) {
    echo "<script>alert('Redirecting to Main Page');</script>";
    echo("<script>window.location.href='index.php'</script>");
}


?>