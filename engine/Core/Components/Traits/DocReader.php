<?php


namespace Torq\Core\Components\Traits;


trait DocReader
{
    protected static $params;
    public static function endpoint(string $method){
        $reflection = (new \ReflectionClass(get_called_class()))->getMethod($method);
        $params = self::phpdoc_params($reflection);
        self::$params[$method] = $params;
    }

    public static function getParam($method, $param, $default = null){
        return  self::$params[$method]['@'.$param];
    }

    private static function phpdoc_params(\ReflectionMethod $method) : array
    {
        // Retrieve the full PhpDoc comment block
        $doc = $method->getDocComment();

        // Trim each line from space and star chars
        $lines = array_map(function($line){
            return trim($line, " *");
        }, explode("\n", $doc));

        // Retain lines that start with an @
        $lines = array_filter($lines, function($line){
            return strpos($line, "@") === 0;
        });

        $args = [];

        // Push each value in the corresponding @param array
        foreach($lines as $line){
            list($param, $value) = explode(' ', $line, 2);
            $args[$param][] = $value;
        }

        return $args;
    }
}