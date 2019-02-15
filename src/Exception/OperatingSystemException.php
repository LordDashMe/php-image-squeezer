<?php

namespace LordDashMe\ImageSqueezer\Exception;

class OperatingSystemException extends \Exception
{
    const IS_NOT_SUPPORTED = 1;

    public static function isNotSupported($previous = null) 
    {
        $message = 'The current operating system is not supported. Please use only WIN, Mac OS X or Linux to use this package.';
        $code = self::IS_NOT_SUPPORTED;
        
        return new static($message, $code, $previous);
    }
}
