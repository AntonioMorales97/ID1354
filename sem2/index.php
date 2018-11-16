<?php
    include 'fragments/header.php';
?>
    <div class="logo-container">
        <h1>Tasty Recipes</h1>
    </div>
    <div class="top-container">
        <div class="showcase">
            <h2>Welcome</h2>
            <p>
                This is TastyRecipes and we love to cook and share with us.
                We have recently started this company and we hope you like it.
                We would like to present our chef Per Morberg who has worked
                with us from the beginning. In our website you can easily follow our
                calendar of recipes to inspire you of some tasty food that is easy to cook. Some example
                recipes can be seen below and we hope you like it. Have a nice meal!
            </p>
        </div>   
        <div class="sidecase">
            <h2>Per Moberg</h2>
            <img src="images/per.jpg" alt="A picture of our own chef Per">
            <p>Per Moberg in action!</p>
        </div>
    </div>
    <div class="bottom-header">
        <h2>Our most popular recipes</h2>
    </div>
    <div class="bottom-container">
        <div class="boxes">
            <?php
                $xml = simplexml_load_file("recipes/recipes.xml") or die("Error: Could not create xml object");
                foreach($xml->recipe as $recipe){
                    echo 
                        '<div class="box">
                            <a href="recipe.php?name='.$recipe->title.'"><img src="'.$recipe->imagepath.'" alt="'.$recipe->title.'"></a>
                        </div>';
                } 
            ?>
        </div>     
    </div>  

<?php
    include 'fragments/footer.php';
?>