<?php
    session_start();
    if(isset($_SERVER['HTTP_REFERER'])){
        $url = $_SERVER['HTTP_REFERER'];
    } else{
        $url = "index.php"; //default
    }
    
    if(isset($_POST['submit'])){
        /*
        $urlHOST = parse_url($url, PHP_URL_HOST);
        $urlPATH = parse_url($url, PHP_URL_PATH);
        $urlQUERY = parse_url($url, PHP_URL_QUERY);
        */
        
        session_start();
        session_unset();
        session_destroy();
        header("Location: $url");
        exit();
    }