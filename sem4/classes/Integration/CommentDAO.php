<?php

namespace Integration;

use DTO\CommentDTO;
use Integration\DBAccess;
use Model\Comment;

/**
 * This class handles database requests about comments
 * @package Integration
 */
class CommentDAO{
    const ID_COL = 'comment_id';
    const TABLE_NAME = 'comment';
    const USER_ID_COL = 'user_id';
    const DATE_COL = 'date';
    const MESSAGE_COL = 'message';
    const RECIPE_ID_COL = 'recipe_id';
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
     * This method stores a new comment into database
     * @param Comment the comment to be stored.
     */
    public function storeComment(Comment $comment){
        $username = $this->escape_string($comment->getUsername());
        $user_id = $this->get_user_id($username);
        $commentMessage = $this->escape_string($comment->getCommentMessage());
        $date = $this->escape_string($comment->getDate());
        $recipe_title = $this->escape_string($comment->getRecipeTitle());
        $recipe_id = $this->get_recipe_id($recipe_title);

        $query = $this->connect->prepare("INSERT INTO comment (user_id, date, message, recipe_id) VALUES
                (?, ?, ?, ?)");
        $query->bind_param("issi", $user_id, $date, $commentMessage, $recipe_id);
        $query->execute();
        $query->close();
    }

    /**
     * This method will delete the comment that is written by the given user and has the same comment id from the database.
     * @param user_id the user id of who wrote the comment.
     * @param comment_id the comment id to be deleted from the database.
     */
    public function deleteComment($user_id, $comment_id){
        $query = $this->connect->prepare("DELETE FROM comment WHERE user_id = ? AND comment_id = ?");

        $query->bind_param("ii", $user_id, $comment_id);
        $query->execute();
        $query->close();
    }

    /**
     * This method returns an array that contains all comments for a specific recipe
     * @param recipe_title the recipe
     * @return an array of the comments belonging to the recipe
     */
    public function getComments($recipe_title){
        $recipe_id = $this->get_recipe_id($recipe_title);
        $commentsArray = array();
        $query = $this->connect->prepare("SELECT * FROM comment WHERE recipe_id = ? ORDER BY date ASC");
        $query->bind_param('i', $recipe_id);
        $query->execute();
        $query->bind_result($comment_id, $user_id, $date, $message, $recipe_id);
        while ($query->fetch()) {
            $username = $this->get_username($user_id);
            $commentsArray[] = new CommentDTO($user_id, $username, $date, $message, $comment_id);
        }
        $query->close();
        return $commentsArray;
    }

    /**
     * Returns the id of the latest comment that was posted on the recipe page of the recipe given by its title.
     * @param $recipe_title the recipe where the comment was posted on.
     * @return the id of the latest comment that was posted on the recipe page.
     */
    public function getLatestCommentID($recipe_title){
        $recipe_id = $this->get_recipe_id($recipe_title);
        $query = $this->connect->prepare("SELECT comment_id FROM comment WHERE recipe_id = ? ORDER BY date DESC LIMIT 1");
        $query->bind_param('i', $recipe_id);
        $query->execute();
        $query->bind_result($latestCommentID);
        $query->fetch();
        $query->close();
        return $latestCommentID;
    }

    public function getComment($comment_id){
        $query = $this->connect->prepare("SELECT * FROM comment WHERE comment_id = ?");
        $query->bind_param('i', $comment_id);
        $query->execute();
        $query->bind_result($comment_id, $user_id, $date, $message, $recipe_id);
        $query->fetch();
        $query->close();
        $username = $this->get_username($user_id);
        return new CommentDTO($user_id, $username, $date, $message, $comment_id);
    }

    private function escape_string($param){
        return $this->connect->real_escape_string($param);
    }

    private function get_recipe_id($recipe_title){
        $recipeDAO = new RecipeDAO();
        return $recipeDAO->getRecipeID($recipe_title);
    }

    private function get_user_id($username){
        $userDAO = new UserDAO();
        return $userDAO->getUserID($username);
    }

    private function get_username($user_id){
        $userDAO = new UserDAO();
        return $userDAO->getUsername($user_id);
    }

}
?>