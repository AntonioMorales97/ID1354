<?php
use Controller\SessionManager;

$controller = SessionManager::getController();

$other_recipe_title = $controller->getOtherRecipe(($currentRecipe->title));
    if(isset($other_recipe_title)){
        $other_recipe = "";
        $xml = simplexml_load_file("resources/xml/recipes.xml") or die("Error: Could not create xml object");
        foreach($xml->recipe as $recipe){
            if($other_recipe_title == $recipe->title){
                $other_recipe = $recipe;
                break;
            }
        }
    }

SessionManager::storeController($controller);

?>