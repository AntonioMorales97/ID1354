<?php
namespace Integration;

use Integration\DBAccess;

/**
 * This class handles database requests about recipes
 * @package Integration
 */
class RecipeDAO{
    private $connect;

    /**
     * Constructor - establishes connection to a database when object is created
     */
    public function __construct(){
        $this->connect = new \mysqli(DBAccess::DB_LOCATION, DBAccess::DB_USER, DBAccess::DB_PASS, DBAccess::DB_NAME);
    }

    /**
     * Destructor - closes connection to the database as soon as there are no references to this object
     */
    public function __destructor(){
        $this->connect->close();
    }

    /**
     * This function will get an other recipe that is not the recipe given from the database.
     * @param $recipe_title - the recipe title that the random recipe should not be equal to.
     * @return an other random recipe title.
     */
    public function getOtherRandomRecipe($recipe_title){
        $query = $this->connect->prepare("SELECT name FROM recipe WHERE name != ?
        ORDER BY RAND() LIMIT 1");
        $recipe_title = $this->escape_string($recipe_title);
        $query->bind_param("s", $recipe_title);
        $query->execute();
        $query->bind_result($other_recipe_title);
        $query->fetch();
        $query->close();
        return $other_recipe_title;
    }

    public function getRecipeID($recipe_title){
        $query = $this->connect->prepare("SELECT recipe_id FROM recipe WHERE name = ?");
        $recipe_title = $this->escape_string($recipe_title);
        $query->bind_param("s", $recipe_title);
        $query->execute();
        $query->bind_result($recipe_id);
        $query->fetch();
        $query->close();
        return $recipe_id;
    }

    private function escape_string($param){
        return $this->connect->real_escape_string($param);
    }
}
?>