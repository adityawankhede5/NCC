<?php
    session_start();
    $error='';

    // IF FORM IS SUBMITTED
    if(isset($_POST['submit'])){
        $adminemail = $_POST['adminemail'];
        $adminpassword = $_POST['adminpassword'];

        $mysqli = new mysqli("localhost", "root", "","test");

        // To protect MySQL injection for Security purpose
        $adminemail = mysqli_escape_string($mysqli, $adminemail);
        $adminpassword = mysqli_escape_string($mysqli, $adminpassword);

        $results = $mysqli->query("SELECT password FROM admincred where email='$adminemail' AND password='$adminpassword'");
        if($results->num_rows==1){
            $_SESSION['admin_user']=$adminemail;
            header("location: admin.html");
        }else{
            $error="Username or password is invalid.";
        }
        $mysqli->close();
        
    }
?>