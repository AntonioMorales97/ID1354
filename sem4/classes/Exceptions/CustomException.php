<?php
namespace Exceptions;

use \Exception;

class CustomException extends \Exception{
    /**
     * CustomException constructor
     * @param string $message - exception message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}

?>