<!-- logout -->
<?php 
        session_start();
        // unset($_SESSION['username']);
        // unset($_SESSION['password']);
        if(session_destroy()){
        header("location:adminlogin.php");
        }