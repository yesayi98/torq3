<?php


namespace Torq\Core\Components\Doctrine;

use DateTime as DefaultDateTime;

class DateTime extends DefaultDateTime
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->format('Y-m-d H:i:s');
    }
}