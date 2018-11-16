<?php
    /**
     * Sends a query to the database to get a random recipe that is not the given recipe.
     */
    function other_recipe($recipe_title){
        include 'dbc_inc.php';
        $sql = "SELECT name FROM recipe WHERE name != '$recipe_title' 
                ORDER BY RAND() LIMIT 1";
        $other_recipe_res = mysqli_query($conn, $sql);
        $other_recipe_row = mysqli_fetch_assoc($other_recipe_res);
        return $other_recipe_row['name'];
    }