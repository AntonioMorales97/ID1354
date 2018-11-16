<?php
    include 'fragments/header.php';
    $currentRecipe = "";
    if(isset($_GET['name'])){
        $xml = simplexml_load_file("recipes/recipes.xml") or die("Error: Could not create xml object");
        foreach($xml->recipe as $recipe){
            if($_GET['name'] == $recipe->title){
                $currentRecipe = $recipe;
                break;
            }
        }
    } else{
        header("Location: index.php?error=norecipefound");
        exit();
    }
?>
    <div class="main-container">
        <div class="main-recipe-container">
            <div class="main-recipe-header">
                <h2>
                    <?php echo $currentRecipe->title; ?>
                </h2>
                <img src="<?php echo $currentRecipe->imagepath; ?>" alt="<?php echo $currentRecipe->title;?>">
                <div class="amount">
                    <ul>
                        <li><i class="fas fa-chart-pie"></i> <?php echo $currentRecipe->quantity;?></li>
                        <li><i class="fas fa-clock"></i> <?php echo $currentRecipe->preptime.' '.$currentRecipe->cooktime?></li>
                    </ul>
                </div>
            </div>
            <div class="ingredients">
                <h3>Ingredients</h3>
                <div class="ingredients-body">
                    <ul>
                        <?php
                            foreach($currentRecipe->ingredient->li as $ingredient){
                                echo '<li>'.$ingredient.'</li>';
                            } 
                        ?>
                    </ul>
                </div>
            </div>
            <div class="directions">  
                <div class="directions-body">
                    <div class="directions-header">
                        <h3>Directions</h3>
                    </div>
                    <ol>
                        <?php
                            foreach($currentRecipe->recipetext->li as $direction){
                                echo '<li>'.$direction.'</li>';
                            } 
                        ?>
                    </ol>
                </div>
            </div>
            <div class="comment-container">
                <h3>Comments about the recipe</h3>
                <?php
                    if(isset($_SESSION['username'])){
                        echo 
                            '<form action="includes/set_comment_inc.php" method="POST">
                                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                                <input type="hidden" name="date" value="'.date('Y-m-d H:i:s').'">
                                <input type="hidden" name="recipe_title" value="'.$currentRecipe->title.'">
                                <textarea name="comment" placeholder="Enter a comment for this recipe!"></textarea><br/>
                                <button name="commentSubmit" type="submit">Comment</button>
                            </form>';
                    } else{
                        echo '<p>Log in to leave a comment!<i class="fas fa-smile-beam"></i></p>';
                    }

                    include 'includes/display_comments_inc.php';
                    display_comments($currentRecipe->title);  
                ?>
            </div>
        </div>
        <?php
            include 'includes/random_recipe.php';
            $other_recipe_title = other_recipe($currentRecipe->title);
            if(isset($other_recipe_title)){
                $other_recipe = "";
                $xml = simplexml_load_file("recipes/recipes.xml") or die("Error: Could not create xml object");
                foreach($xml->recipe as $recipe){
                    if($other_recipe_title == $recipe->title){
                    $other_recipe = $recipe;
                    break;
                    }
                }
                echo 
                    '<div class="other-recipe">
                    <h2>Other recipe we recommend</h2>
                    <a href="recipe.php?name='.rawurlencode($other_recipe->title).'"><img src="'.$other_recipe->imagepath.'" alt="'.$other_recipe->title.'"></a>
                </div>';
            }
        ?>
            
    </div>
<?php
    include 'fragments/footer.php';
?>