<?php
namespace Controller;

use DTO\LoginDTO;
use DTO\RegisterDTO;
use Integration\CommentDAO;
use Model\RecipeHandler;
use Model\Comment;
use Model\UserHandler;

class Controller{

    /**
     * Sends the input entered by a user in the sign up form to a UserHandler object for registration.
     * @param $username the username the user entered.
     * @param $password the password the user entered.
     */
    public function registerNewUser($username, $password){
        $userHandler = new UserHandler();
        $userHandler->register(new RegisterDTO($username, $password));
    }


    /**
     * Sends data entered by a user in login form to UserHandler object for login process.
     * @param $loginName.
     * @param $loginPass.
     */
    public function loginUserProcess($loginName, $loginPass){
        $userHandler = new UserHandler();
        $userHandler->loginVerify(new LoginDTO($loginName, $loginPass));
    }

    /**
     * This method returns all comments for the given recipe.
     * @param $recipe_title The recipe.
     * @return an array holding every comment for the recipe.
     */
    public function getComments($recipe_title){
        $commentDAO = new CommentDAO();
        return $commentDAO->getComments($recipe_title);
    }


    /**
     * Creates a comment object and calls its store function.
     * @param username the username of who wrote the comment
     * @param commentMessage the message in the comment
     * @param recipe_title the recipe of where the commented was posted
     */
    public function setComment($username, $commentMessage, $recipe_title){
        $comment = new Comment($username, $commentMessage, $recipe_title);
        $comment->store();
    }

    /**
     * Deletes the specific comment from the database.
     * @param user_id the user id of who wrote the comment.
     * @param comment_id the comment id to be deleted.
     */
    public function deleteComment($user_id, $comment_id){
        $commentDAO = new CommentDAO();
        $commentDAO->deleteComment($user_id, $comment_id);
    }
    
    /**
     * This method gets the username with the matching user_id
     * @param $user_id
     * @return the username.
     */
    public function getUsername($user_id){
        $userHandler = new UserHandler();
        return $userHandler->getUsername($user_id);
    }

    /**
     * Gets an other recipe that is not the given recipe.
     * @return an other recipe title.
     */
    public function getOtherRecipe($recipe_title){
        $recipeHandler = new RecipeHandler();
        return $recipeHandler->otherRandomRecipe($recipe_title);  
    }

}
?>