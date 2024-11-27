<?php
session_start();
if(!$_SESSION["login_user"]){
    echo "
    <script type='text/javascript'>
window.location.href ='../../index.php';
</script>";
 }
$login_session =$_SESSION['login_user'];
$uid =$_SESSION['uid'];
include_once("../../dbConnect.php");

$nama = $_POST["nama"];
$noFon = $_POST["noFon"];
$userId = $_POST["userId"];
$pass = $_POST["pass"];


            $sql = "UPDATE profile SET nama='$nama', noFon='$noFon'
            WHERE user_id='$userId'";
            $sql2 = "UPDATE user SET password='$pass'
            WHERE id='$userId'";
            $run_query2 = mysqli_query($conn, $sql2);
          
            if ($conn->query($sql) === TRUE){
              echo "<script>alert('Update Success')</script>" ;
                    echo "
                    <script type='text/javascript'>
               history.back();
              </script>";
            }
            else{
            echo "<script>alert('Error Update')</script>" ;
                    echo "
                    <script type='text/javascript'>
              history.back();
              </script>";
            }
     
   

?>