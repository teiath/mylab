<?php

class JsonFunctions{

    public static function replace_unicode_escape_sequence($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }

    public static function toGreek($value)
    {
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $value ? $value : array());
    }

    public static function PrepareResponse()
    {
        global $app;

        $app->contentType('application/json');
        $app->response()->headers()->set('Content-Type', 'application/json; charset=utf-8');
        $app->response()->headers()->set('X-Powered-By', 'TEI of Athens');
        $app->response()->setStatus(200);
    }

    //based on https://github.com/perchten/php-truepath
    /**
    * This function is to replace PHP's extremely buggy realpath().
    * @param string The original path, can be relative etc.
    * @return string The resolved path, it might not exist.
    */
    public static function truepath($path){
        // whether $path is unix or not
        $unipath=strlen($path)==0 || $path{0}!='/';

        // attempts to detect if path is relative in which case, add cwd
        if(strpos($path,':')===false && $unipath)
            $path=getcwd().DIRECTORY_SEPARATOR.$path;

        // resolve path parts (single dot, double dot and double delimiters)
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
            array_pop($absolutes);
            } else {
            $absolutes[] = $part;
            }
        }
        
        $path=implode(DIRECTORY_SEPARATOR, $absolutes);
        
        // resolve any symlinks
        if(file_exists($path) && linkinfo($path)>0)$path=readlink($path);
        // put initial separator that could have been lost
        $path=!$unipath ? '/'.$path : $path;
        //$path=($path{0}!="/") ? '/'.$path : $path; //used with linux
        
        return $path;
    }
    
}
?>