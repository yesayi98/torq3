<?php


namespace Core\Components\Traits;


trait DocReader
{

    public function endpoint(string $method){
        $reflection = (new \ReflectionClass($this))->getMethod($method);
        $params = $this->phpdoc_params($reflection);
        $this->params[$method] = $params;
    }

    public function getParam($method, $param, $default = null){
        return $this->params[$method]['@'.$param];
    }

    private function phpdoc_params(\ReflectionMethod $method) : array
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