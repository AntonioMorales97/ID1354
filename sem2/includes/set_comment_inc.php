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


    if(isset($_POST['commentSubmit'])){
        $user_id = $_POST['user_id'];
        $date = $_POST['date'];
        $comment = $_POST['comment'];
        $recipe_title = $_POST['recipe_title'];

        $sql = "SELECT recipe_id FROM recipe WHERE name = '$recipe_title'";
        $recipe_id_res = mysqli_query($conn, $sql);
        $recipe_id_row = mysqli_fetch_assoc($recipe_id_res);

        $sql = "INSERT INTO comment (user_id, date, message, recipe_id) 
                VALUES('$user_id', '$date', '$comment', '".$recipe_id_row['recipe_id']."')";
        $result = mysqli_query($conn, $sql);

        header("Location: $url");
        exit();

        //$checkResult = mysqli_num_rows($result);
        /*
        if($checkResult != 0){
            header("Location: $url");
            exit();
        } else{
            header("Location: $url");
            exit();
        }
        */
    }

    

