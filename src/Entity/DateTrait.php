<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;

trait DateTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $updated = null;

    /**
     * @return DateTimeInterface|null
     */
    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @param DateTimeInterface|null $created
     */
    public function setCreated(?DateTimeInterface $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdated(): ?DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @param DateTimeInterface|null $updated
     */
    public function setUpdated(?DateTimeInterface $updated): void
    {
        $this->updated = $updated;
    }

}