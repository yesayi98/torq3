<?php


namespace Torq\Core\Components\Traits;


use Doctrine\Common\Collections\ArrayCollection;

trait ArrayConvertable
{
    /**
     * @param bool $toCollection
     * @return ArrayCollection|array
     */
   public function toArray()
   {
       return Container()->get('db')->serializeEntity($this);
   }

   protected function toArrayCollection($entity): ArrayCollection
   {
       return new ArrayCollection($entity);
   }

}