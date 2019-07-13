<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scan-n-order";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $query_string="SELECT * FROM registration";
// $result_set=mysqli_query($conn,$query_string);
// $rows=mysqli_fetch_assoc($result_set);

$username = $_GET['uname'];
$password = $_GET['pwd'];
$confirm_password = $_GET['cpwd'];

$all_fields = false;

if($username != "" && $password != "" && $confirm_password != "")
    $all_fields = true;



if($password === $confirm_password && $all_fields)
{
    $insert_query = "INSERT INTO registration VALUES ('$username','$password')";
    if ($conn->query($insert_query) === TRUE)
        echo "<script type='text/javascript'>alert('Registration Completed Successfully ✔ ');location='../login.html'</script>";
    else
        echo "Error: " . $insert_query . "<br>" . $conn->error;
}
else if(!$all_fields)
    echo "<script type='text/javascript'>alert('⚠ Please enter all the fields ');location='../register.html'</script>";
else
    echo "<script type='text/javascript'>alert('❌ Password doesnt match.\\nPlease try again.');location='../register.html'</script>";

?>