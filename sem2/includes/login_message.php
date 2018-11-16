<?php
    if(isset($_SESSION['login'])){
        if($_SESSION['login'] == 'false'){
            echo '<script>alert("Wrong username or password!")</script>';
            unset($_SESSION['login']);
            exit();
        } 
        /*elseif($_SESSION['login'] == 'true'){
            echo '<script>alert("Successfully logged in!")</script>';
            unset($_SESSION['login']);
            exit();
        }*/
    }      
