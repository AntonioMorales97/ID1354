<?php
    use Util\Util;
    $_SESSION['pageId'] = $_GET['page'];
    
    $currentRecipe = "";
    if(isset($_GET['page'])){
        $xml = simplexml_load_file("resources/xml/recipes.xml") or die("Error: Could not create xml object");
        foreach($xml->recipe as $recipe){
            if($_GET['page'] == $recipe->title){
                $currentRecipe = $recipe;
                break;
            }
        }
        if(!isset($currentRecipe)){
            header("Location: index.php?page=home&error=norecipefound");
            exit();
        }
    } else{
        header("Location: index.php?page=home&error=noSuchRecipe");
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
                            '<form action="set_comment.php" method="POST">
                                <input type="hidden" name="username" value="'.$_SESSION['username'].'">
                                <input type="hidden" name="date" value="'.date('Y-m-d H:i:s').'">
                                <input type="hidden" name="recipe_title" value="'.$currentRecipe->title.'">
                                <textarea name="comment" placeholder="Enter a comment for this recipe!"></textarea><br/>
                                <button name="commentSubmit" type="submit">Comment</button>
                            </form>';
                    } else{
                        echo '<p>Log in to leave a comment!<i class="fas fa-smile-beam"></i></p>';
                    }
                    
                    include 'get_comments.php';
                    
                    foreach($comments as $comment){
                        $user_id = $comment->getUserID();
                        echo '<div class ="comment-box">';
                        echo '<h4>'.$controller->getUsername($user_id).'</h4>';
                        echo '<h5>'.$comment->getDate().'</h5>';
                        echo '<p>'.nl2br($comment->getMessage()).'<p>';
                    
                        if(isset($_SESSION['username'])){
                            if($_SESSION['username'] == $controller->getUsername($user_id)){        
                                echo '<form class="delete-form" method="POST" action="delete_comment.php">
                                        <input type="hidden" name="user_id" value="'.$user_id.'">
                                        <input type="hidden" name="comment_id" value="'.$comment->getCommentID().'">
                                        <button type="submit" name="deleteComment">Delete</button>
                                        </form>';       
                            }
                        }
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <?php
            include 'get_random_recipe.php';
            echo 
            '<div class="other-recipe">
                <h2>Other recipe we recommend</h2>
                <a href="index.php?page='.rawurlencode($other_recipe->title).'"><img src="'.$other_recipe->imagepath.'" alt="'.$other_recipe->title.'"></a>
            </div>';
        ?>
            
    </div>