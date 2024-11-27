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

$note = $_POST["note"];
$id = $_POST["id"];

            $sql = "UPDATE file SET note='$note' WHERE id='$id'";
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