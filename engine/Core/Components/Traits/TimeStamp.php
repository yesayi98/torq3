<?php


namespace Torq\Core\Components\Traits;

use Doctrine\ORM\Mapping\Column;
use Torq\Core\Components\Doctrine\DateTime;


trait TimeStamp
{

    /**
     * @Column(type="datetimetz", options={"default": "CURRENT_TIMESTAMP"})
     * @var \datetime
     */
    protected $updated_at;

    /**
     * @Column(type="datetimetz", options={"default": "CURRENT_TIMESTAMP"})
     * @var \datetime
     */
    protected $created_at;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     */
    public function setCreatedAt(): void
    {
        $this->created_at = new DateTime("now");
    }


    /**
     *
     */
    public function setUpdatedAt(): void
    {
        $this->updated_at = new DateTime("now");
    }

}