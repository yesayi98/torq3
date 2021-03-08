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
        $this->chunks = array_values(array_filter(explode('/', $url)));
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
     * @param null $default
     * @return mixed|string
     */
    public function getChunk($index, $default = null)
    {
        if (!empty($this->chunks[$index])){
            return $this->chunks[$index];
        }else{
            return $default;
        }
    }

    public function removeChunk($index){
        $chunks = $this->chunks;

        array_splice($chunks, $index, 1);

        $this->chunks = $chunks;
    }
}