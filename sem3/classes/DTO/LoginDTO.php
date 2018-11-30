<?php
namespace DTO;

/**
 * This class holds the data that was entered when trying to login.
 */
class LoginDTO{
    private $username;
    private $password;

    /**
     * Constructs our LoginDTO
     * @param $username
     * @param $password
     */
    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }
    /**
     * Returns the username entered in the login form
     * @return the username entered in the login form
     */
    public function getUsername(){
        return $this->username;
    }
    /**
     * Returns the password entered in login form
     * @return the password entered in the login form
     */
    public function getPassword(){
        return $this->password;
    }
}
?>