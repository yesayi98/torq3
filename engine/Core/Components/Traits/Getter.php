<?php


namespace Torq\Core\Components\Traits;


trait Getter
{
    public function getName() {
        return $this->reflect->getShortName();
    }
}