<?php

namespace Integration;

use Integration\DBAccess;
use DTO\LoginDTO;
use DTO\RegisterDTO;

/**
 * This class handles database requests about users
 * @package Integration
 */
class UserDAO{
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
     * This method returns the given username if it exists in the database.
     * @param $username - username of the user
     * @return the username if it exists; otherwise an empty string.
     */
    public function findUsername($username){
        $query = $this->connect->prepare("SELECT username FROM user WHERE username = ?");
        $username = $this->escape_string($username);
        $query->bind_param("s", $username);
        $query->execute();
        $query->bind_result($foundUsername);
        $query->fetch();
        return $foundUsername;
    }
    /**
     * This method gets the hashed password of the user
     * @param $username - the username
     * @return - the hashed password
     */
    public function getPassword($username){
        $query = $this->connect->prepare("SELECT password FROM user WHERE username = ?");
        $username = $this->escape_string($username);
        $query->bind_param("s", $username);
        $query->execute();
        $query->bind_result($hashedPassword);
        $query->fetch();
        return $hashedPassword;
    }

    /**
     * This method sends new users data to the database.
     * @param RegisterDTO $registerDTO the data of the new user to be registered.
     */
    public function registerUser(RegisterDTO $registerDTO){
        $query = $this->connect->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $username = $registerDTO->getUsername();
        $username = $this->escape_string($username);
        $password = $registerDTO->getPassword();
        $password = $this->escape_string($password);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query->bind_param("ss", $username, $hashedPassword);
        $query->execute();
    }
    
    /**
     * This method returns the username that matches the user_id in the database.
     * @param $user_id
     * @return the corresponding username.
     */
    public function getUsername($user_id){
        $query = $this->connect->prepare("SELECT username FROM user WHERE user_id = ?");
        $user_id = $this->escape_string($user_id);
        $query->bind_param('i', $user_id);
        $query->execute();
        $query->bind_result($username);
        $query->fetch();
        $query->close();
        return $username;
    }

    /**
     * This method returns the user id that matches the username in the database.
     * @param $user_id
     * @return the corresponding user id.
     */
    public function getUserID($username){
        $query = $this->connect->prepare("SELECT user_id FROM user WHERE username = ?");
        $user_id = $this->escape_string($username);
        $query->bind_param('s', $username);
        $query->execute();
        $query->bind_result($user_id);
        $query->fetch();
        $query->close();
        return $user_id;
    }

    private function escape_string($param){
        return $this->connect->real_escape_string($param);
    }
}
?>