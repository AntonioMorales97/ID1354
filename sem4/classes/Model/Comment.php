<?php
namespace Model;

use Integration\CommentDAO;

/**
 * This class handles the possible operations with comments
 */
class Comment{
    private $username;
    private $commentMessage;
    private $date;
    private $recipe_title;

    /**
     * Comment constructor.
     * @param $username
     * @param $commentMessage
     * @param $recipe_title
     */
    public function __construct($username, $commentMessage, $recipe_title){
        $this->username = $username;
        $this->commentMessage = $commentMessage;
        $datetime = new \DateTime();
        $this->date = $datetime->format('Y-m-d H:i:s'); //must be this format
        $this->recipe_title = $recipe_title;
    }
    /**
     * This method sends comment to database handler to store the comment
     */
    public function store(){
        $commentDAO = new CommentDAO();
        $commentDAO->storeComment($this);
    }
    
    /**
     * @return the username of who wrote this comment
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * @return the message in this comment
     */
    public function getCommentMessage(){
        return $this->commentMessage;
    }

    /**
     * @return the date this comment was created
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * @return the recipe title where this comment was posted
     */
    public function getRecipeTitle(){
        return $this->recipe_title;
    }
}
?>