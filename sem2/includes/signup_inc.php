<?php
    if(isset($_POST['submit'])){ //check if button has been clicked
        include_once 'dbc_inc.php';

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        //Error-handling

        //Check for empty inputs
        if(empty($username) || empty($password)){
            header("Location: ../signup.php?signup=empty");
            exit();
        } else{
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $checkResult = mysqli_num_rows($result);
            //check for invalid username
            if($checkResult > 0){
                header("Location: ../signup.php?signup=usertaken&username=$username");
                exit();
            } else{
                //hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword');";
                mysqli_query($conn, $sql);
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }

    } else{
        header("Location: ../signup.php");
        exit();
    }