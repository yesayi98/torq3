<?php


namespace Core\Components;


class UrlParser
{
    /**
     * @var false|string[]
     */
    protected $chunks;

    public function __construct(string $url)
    {
        $this->chunks = explode('/', $url);
    }

    /**
     * @return false|string[]
     */
    public function getChunks()
    {
        return $this->chunks;
    }

    /**
     * @param int $index
     * @return mixed|string
     */
    public function getChunk($index, $default){
        if (!empty($this->chunks[$index])){
            return $this->chunks[$index];
        }else{
            return $default;
        }
    }
}