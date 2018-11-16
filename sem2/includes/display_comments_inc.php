<?php    
    function display_comments($recipe_title){
        include_once 'dbc_inc.php';
        $sql = "SELECT recipe_id FROM recipe WHERE name = '$recipe_title'";
        $recipe_id_res = mysqli_query($conn, $sql);
        $recipe_id_row = mysqli_fetch_assoc($recipe_id_res);
        $sql = "SELECT * FROM comment WHERE recipe_id = ".$recipe_id_row['recipe_id']."
                ORDER BY date DESC";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()){
            $user_id = $row['user_id'];
            $comment_id = $row['comment_id'];
            $sql = "SELECT username
                    FROM user
                    WHERE user_id = $user_id";
            $usernameRes = mysqli_query($conn, $sql);
            $usernameRow = mysqli_fetch_assoc($usernameRes);

            echo '<div class ="comment-box">';
            echo '<h4>'.$usernameRow["username"]."</h4>";
            echo '<h5>'.$row["date"]."</h5>";
            echo '<p>'.nl2br($row["message"]).'<p>';

            if(isset($_SESSION['user_id'])){
                if($_SESSION['user_id'] == $user_id){
                    
                    echo '<form class="delete-form" method="POST" action="includes/delete_comment_inc.php">
                            <input type="hidden" name="user_id" value="'.$row['user_id'].'">
                            <input type="hidden" name="comment_id" value="'.$row['comment_id'].'">
                            <button type="submit" name="deleteComment">Delete</button>
                            </form>';
                    
                }
            }

            echo "</div>";  
        }
    }