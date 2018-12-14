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
                    <!-- ko if: loggedIn--> 
                        <textarea data-bind="textInput: commentMessage" placeholder="Enter a comment for this recipe!"></textarea><br/>
                        <button data-bind="click: postComment">Comment</button>            
                    <!-- /ko -->
                    <!-- ko ifnot: loggedIn-->
                        <p>Log in to leave a comment!<i class="fas fa-smile-beam"></i></p>
                    <!-- /ko -->
            
                    <!-- ko foreach: {data: comments, as: 'comment'} -->
                        <div class = "comment-box">
                            <h4 data-bind="text: comment.username"></h4>
                            <h5 data-bind="text: comment.date"></h5>
                            <p data-bind="html: comment.message"></p>
                        
                        <!-- ko if: $parent.loggedIn -->
                            <!-- ko if: comment.iWroteThis -->
                            <div class="delete-div"> <!-- change class name!!! -->
                            <button data-bind="click: $parent.deleteComment">Delete</button>
                            </div>
                            <!-- /ko -->
                        <!-- /ko -->
                        </div>
                    <!-- /ko -->


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