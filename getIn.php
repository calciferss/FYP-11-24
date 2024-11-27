<?php
session_start();
include("dbConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myusername = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['pass']);
    // $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "SELECT * FROM user WHERE email='$myusername'and password='$mypassword'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $role = $row['role'];
    $uid = $row['id'];
    $verification_status = $row['has_verify'];


    $_SESSION['login_user'] = $myusername;
    $login_user=$_SESSION['login_user'];
            
    if ($count == 1) {
        if($verification_status=='1'){
            if ($role == 'Admin') {
                $_SESSION['login_user'] = $myusername;
                $_SESSION['role'] = $role;
                $_SESSION['uid'] = $uid;
                echo "
                <script type='text/javascript'>
                window.location.href ='Admin/index.php';
                </script>";
                // header("location: Admin/Index.php");
            } 
            elseif ($role == 'User') {
                    $_SESSION['login_user'] = $myusername;
                    $_SESSION['role'] = $role;
                    $_SESSION['uid'] = $uid;
                    echo "
                    <script type='text/javascript'>
                window.location.href ='User/index.php';
            </script>";
            }
        }
        else{
            echo "<script>alert('Your Email Not Verified');</script>";
                echo "
                    <script type='text/javascript'>
                window.location.href ='./login.php';
            </script>";
        }
    } else {
        $error = "Email Dan Kata Laluan Tidak Sah";
        echo "<script>alert('Wrong email and password');</script>";
        echo "
            <script type='text/javascript'>
        window.location.href ='index.php';
    </script>";
    }
}
?>

