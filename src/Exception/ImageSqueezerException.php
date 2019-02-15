<?php

namespace LordDashMe\ImageSqueezer\Exception;

class ImageSqueezerException extends \Exception
{
    const EMPTY_SOURCE_FILE_PATH = 1;
    const EMPTY_OUTPUT_FILE_PATH = 2;

    public static function emptySourceFilePath($previous = null) 
    {
        $message = 'The source file path is empty.';
        $code = self::EMPTY_SOURCE_FILE_PATH;
        
        return new static($message, $code, $previous);
    }

    public static function emptyOutpuFilePath($previous = null) 
    {
        $message = 'The output file path is empty';
        $code = self::EMPTY_OUTPUT_FILE_PATH;
        
        return new static($message, $code, $previous);
    }
}
