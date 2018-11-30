<?php
namespace DTO;
/**
 * Class that holds the data when registering/signing up
 */
class RegisterDTO{
    private $username;
    private $password;

    /**
     * Constructs the RegisterDTO.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }
    /**
     * @return the username
     */
    public function getUsername(){
        return $this->username;
    }
    /**
     * @return the password
     */
    public function getPassword(){
        return $this->password;
    }
}
?>