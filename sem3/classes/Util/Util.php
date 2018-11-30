<?php
namespace Util;
/**
 * A utility class that will be used in several places.
 * @package Util
 */
final class Util{
    const VIEWS_PATH = 'resources/view/';
    const CSS_PATH = 'resources/css/';
    const IMG_PATH = 'resources/images/';
    const JS_PATH = 'resources/js/';
    const USER_SESSION_NAME = 'username';
    const FADE_SCRIPT = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
    private  function __construct(){}
    
    /**
     * This method initialises autoload function and starts a session.
     * Call this method first in any PHP page that is receiving a HTTP request.
     */
    public static function initRequest(){
        \session_start();
        self::initAutoload();
    }

    private static function initAutoload(){
        spl_autoload_register(function($class) {
            require_once 'classes/' . \str_replace('\\', '/', $class) . '.php';
        });
    }
}
?>