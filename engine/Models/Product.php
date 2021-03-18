<?php

namespace Torq\Models;

use Torq\Core\Components\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product extends Model
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $discounted_price;

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
    /**
     * @param mixed $name
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}