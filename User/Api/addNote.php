<?php
session_start();
if (!$_SESSION["login_user"]) {
  echo "
    <script type='text/javascript'>
window.location.href ='../../index.php';
</script>";
}
$login_session = $_SESSION['login_user'];
include_once("../../dbConnect.php");


$note = $_POST["note"];
$uid = $_POST["uid"];

$query = "INSERT INTO file (user_id,note,created_at) VALUES ('$uid','$note',NOW())";
$run_query = mysqli_query($conn, $query);
if ($run_query) {
  
    echo "
                        <script type='text/javascript'>
                        alert('Add Note Success');
               history.back();
                </script>";
  } else {
    echo "
                            <script type='text/javascript'>
                            alert('Error Add Note');
                          history.back();
                      </script>";
  }

