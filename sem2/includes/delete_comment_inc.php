<?php
    include_once 'dbc_inc.php';

    session_start();

    if(isset($_SERVER['HTTP_REFERER'])){
        $url = $_SERVER['HTTP_REFERER']; //Go back to the referer page
    } else{
        $url = "index.php"; //default
    }

    /*
    $urlHOST = parse_url($url, PHP_URL_HOST);
    $urlPATH = parse_url($url, PHP_URL_PATH);
    $urlQUERY = parse_url($url, PHP_URL_QUERY);
    */

    if(isset($_POST['deleteComment'])){
        $user_id = $_POST['user_id'];
        $comment_id = $_POST['comment_id'];
        

        $sql = "DELETE FROM comment WHERE user_id = $user_id
                AND comment_id = $comment_id";
        $result = mysqli_query($conn, $sql);
        header("Location: $url");
        exit();
    }

    

