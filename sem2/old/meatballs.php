<?php
    include_once 'header.php';
?>
    <div class="main-container">
        <div class="main-recipe-container">
            <div class="main-recipe-header">
                <h2>Glazed Meatballs</h2>
                <img src="images/meatballs.jpg" alt="A picture of the meatballs">
                <div class="amount">
                    <ul>
                        <li><i class="fas fa-chart-pie"></i> Meals: 4 servings</li>
                        <li><i class="fas fa-clock"></i> Preparation: 5 min Cook: 20 min</li>
                    </ul>
                </div>
            </div>
            <div class="ingredients">
                <h3>Ingredients</h3>
                <div class="ingredients-body">
                    <ul>
                        <li>1/2 cup hoisin sauce</li>
                        <li>2 tablespoons rice vinegar</li>
                        <li>4 teaspoons brown sugar</li>
                        <li>1 teaspoon garlic powder</li>
                        <li>1 teaspoon Sriracha Asian hot chili sauce</li>
                        <li>1/2 teaspoon ground ginger</li>
                        <li>1 package (12 ounce) frozen fully cooked homestyle or Italian meatballs</li>
                        <li>Thinly sliced green onions and toasted sesame seeds, optional</li>
                    </ul>
                </div>
            </div>
            <div class="directions">  
                <div class="directions-body">
                    <div class="directions-header">
                        <h3>Directions</h3>
                    </div>
                    <ol>
                        <li>In a large saucepan, mix hoisin sauce, vinegar, sugar, powder, chili sauce 
                            and ground ginger until blended.
                        </li>
                        <li>Add meatballs, stirring to coat; cook, covered, over medium-low 
                            head 12-15 minutes or until heated through, stirring occasionally.
                        </li>
                        <li>If desired, sprinkle with green onions and sesame seeds.</li>
                        <li>Serve with rice.</li>
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
                                <textarea name="comment"></textarea><br/>
                                <button name="commentSubmit" type="submit">Comment</button>
                            </form>';
                    } else{
                        echo '<p>Log in to leave a comment!<i class="fas fa-smile-beam"></i></p>';
                    }

                    include 'includes/display_comments_inc.php';  
                ?>
            </div>
        </div>
        <div class="other-recipe">
            <h2>Other recipe we recommend</h2>
            <a href="pancakes.php"><img src="images/pancakes.jpeg" alt="Go to pancake recipe"></a>
        </div>    
    </div>
<?php
    include_once 'footer.php';
?>