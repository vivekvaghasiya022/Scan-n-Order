<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scan-n-order";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$username = $_GET['uname'];
$password = $_GET['pwd'];

echo "Username: $username  Password: $password";


$all_fields = false;

if ($username != '' && $password != '')
    $all_fields = true;
echo "$username $password";


if($all_fields)
{
    $select_query = "SELECT * FROM registration WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn,$select_query);

    if (mysqli_num_rows($res)==0)
        echo "<script type='text/javascript'>alert('Invaid Username or Password');location='login.html'</script>";
    else
        echo "<script type='text/javascript'>alert('Login Successful');location='server.php'</script>";



}
else
    echo "<script type='text/javascript'>alert('⚠ Please enter all the fields.');location='../login.html'</script>";

?>