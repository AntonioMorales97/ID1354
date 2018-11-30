<?php
namespace Controller;

use Controller\Controller;

/**
 * This class stores and retrieves session data
 */
class SessionManager{
    const CONTROLLER_KEY = 'controller';
    
    private function __construct(){}
    
    /**
     * This method stores controller instance in the current session.
     * @param $controller The controller instance to be stored.
     */
    public static function storeController(Controller $controller){
        $_SESSION[self::CONTROLLER_KEY] = serialize($controller);
    }
    /**
     * This method returns the Controller instance.
     * If Controller instance does not exists then it returns a new instance.
     * @return The Controller.
     */
    public static function getController(){
        if(isset($_SESSION[self::CONTROLLER_KEY]))
            return unserialize($_SESSION[self::CONTROLLER_KEY]);
        else
            return new Controller();
    }
}
?>