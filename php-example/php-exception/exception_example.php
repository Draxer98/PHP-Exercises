<?php

class EmptyFileException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $code = -40;
        $message = 'An exception has been throw at ' . $this->getFile() . ' at line' . $this->getLine() . ' with code ' . $code;
        parent::__construct($message, $code, $previous);
    }
}

function getFileContent($filename = '')
{
    if(!$filename){
        throw new EmptyFileException('No file name specified');
    }
    if (!file_exists($filename)) {
        throw new Exception("$filename does not exist", -20);
    }

    return file_get_contents($filename);
}

try {
    getFileContent('ttt');
} catch (EmptyFileException $e) {
    $arr['success'] = false;
    $arr['message'] = $e->getMessage();
    $arr['code'] = $e->getCode();
    echo json_encode($arr);
} catch(Exception $e) {
    echo $e->getMessage();
}



finally {
    echo ' Finally called';
}
