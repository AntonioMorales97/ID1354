<?php
namespace Model;

use Integration\RecipeDAO;

/**
 * This handles everything that has to do with recipe data.
 */
class RecipeHandler{
    
    /**
     * This function will get an other recipe that is not the recipe given from the database.
     * @param $recipe_title - the recipe title that the random recipe should not be equal to.
     * @return an other random recipe title.
     */
    public function otherRandomRecipe($recipe_title){
        $recipeDAO = new RecipeDAO();
        return $recipeDAO->getOtherRandomRecipe($recipe_title);
    }

    public function getRecipeID($recipe_title){
        $recipeDAO = new RecipeDAO();
        return $recipeDAO->getRecipeID($recipe_title);
    }
}
?>