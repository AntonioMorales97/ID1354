<?php

namespace DTO;

/**
 * Class that holds the data for a comment
 */
class CommentDTO{
    private $user_id;
    private $date;
    private $message;
    private $comment_id;

    /**
     * CommentDTO constructor.
     * @param $username the username of the author
     * @param $date the date the comment was written
     * @param $message the actual commented message
     */
    public function __construct($user_id, $date, $message, $comment_id){
        $this->user_id = $user_id;
        $this->date = $date;
        $this->message = $message;
        $this->comment_id = $comment_id;
    }

    /**
     * Get the user id
     * @return the username of the user who wrote the comment
     */
    public function getUserID(){
        return $this->user_id;
    }

    /**
     * Get the date
     * @return the date when the comment was written
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * Get the message
     * @return the commented message
     */
    public function getMessage(){
        return $this->message;
    }

    /**
     * Get the comment id
     * @return the username of the user who wrote the comment
     */
    public function getCommentID(){
        return $this->comment_id;
    }

}
?>