<?php

namespace Model;

use DTO\LoginDTO;
use DTO\RegisterDTO;
use Exceptions\CustomException;
use Integration\UserDAO;

/**
 * This class handles the registering, login and logout of users.
 */
class UserHandler{
    
    /**
     * This method performs a registration and checks if the username is already taken before sending the data to the DB handler for users.
     * @param RegisterDTO $userRegDTO a DTO that contains the username and password entered by the user in the signup form.
     * @throws CustomException if the username is already taken.
     */
    public function register(RegisterDTO $userRegDTO){
        $userDAO = new UserDAO();
        $username = $userRegDTO->getUsername();
        $foundUsername = $userDAO->findUsername($username);
        if($foundUsername != $username){
            $userDAO->registerUser($userRegDTO);
        } else{
            throw new CustomException("The username you entered is already taken!");
        }
    }

    /**
     * This method performs login functionality.
     * @param LoginDTO $userLoginData.
     * @throws CustomException if username is not found or password does not match the given username.
     */
    public function login(LoginDTO $userLoginData){
        $userDAO = new UserDAO();
        $username = $userLoginData->getUsername();
        $password = $userLoginData->getPassword();
        $foundUsername = $userDAO->findUsername($username);
        if($foundUsername == $username){
            $hashedPassword = $userDAO->getPassword($username);
            if(password_verify($password, $hashedPassword)){
                session_regenerate_id();                                //more secure
                $_SESSION['username'] = $userLoginData->getUsername();
            }else
                throw new CustomException("Password do not match with username you entered!");
        }else{
            throw new CustomException("That username does not exist!");
        }
        
    }
    /**
     * This method logs out the logged in user
     */
    public function logout(){
        session_regenerate_id();
        session_unset();
        session_destroy();
    }

    /**
     * This method returns the corresponding username to the given user_id.
     * @return the username that has the given user id in the database.
     */
    public function getUsername($user_id){
        $userDAO = new UserDAO();
        return $userDAO->getUsername($user_id);
    }
    
}
?>