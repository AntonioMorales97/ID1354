<?php
    session_start();
    if(isset($_SERVER['HTTP_REFERER'])){
        $url = $_SERVER['HTTP_REFERER']; //Go back to the referer page
    } else{
        $url = "index.php"; //default
    }

    if(isset($_POST['submit'])){
        include_once 'dbc_inc.php';

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        /*
        $urlHOST = parse_url($url, PHP_URL_HOST);
        $urlPATH = parse_url($url, PHP_URL_PATH);
        $urlQUERY = parse_url($url, PHP_URL_QUERY);
        */

        //Error-handling

        //Check for empty inputs
        if(empty($username) || empty($password)){
            header("Location: $url");
            exit();
        } else{
            $sql = "SELECT * FROM user WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            $checkResult = mysqli_num_rows($result);
            if($checkResult < 1){
                $_SESSION['login'] = 'false';
                header("Location: $url");
                exit();
            } else{
                if($row = mysqli_fetch_assoc($result)){
                    //De-hash password
                    $hashedPasswordCheck = password_verify($password, $row['password']);
                    if($hashedPasswordCheck == false){
                        $_SESSION['login'] = 'false';
                        header("Location: $url");
                        exit();
                    } elseif($hashedPasswordCheck == true){
                        //correct password, let user in
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['login'] = 'true';
                        header("Location: $url");
                        exit();
                    }
                }
            }
        }
    } else {
        header("Location: ../index.php?login=error");
        exit();
    }