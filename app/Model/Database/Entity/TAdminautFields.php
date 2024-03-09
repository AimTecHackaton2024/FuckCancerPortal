<?php

namespace App\Model\Database\Entity;

use Doctrine\ORM\Mapping as ORM;

trait TAdminautFields
{

    /** @ORM\Column(type="datetime", nullable=FALSE, unique=FALSE) */
    private \DateTime $inserted;

    /** @ORM\Column(type="integer", length=11, nullable=FALSE, unique=FALSE) */
    private int $insertedBy;

    /** @ORM\Column(type="datetime", nullable=FALSE, unique=FALSE) */
    private \DateTime $updated;

    /** @ORM\Column(type="integer", length=11, nullable=FALSE, unique=FALSE) */
    private int $updatedBy;

    /** @ORM\Column(type="boolean", nullable=FALSE, unique=FALSE) */
    private bool $deleted;

    /** @ORM\Column(type="integer", length=11, nullable=FALSE, unique=FALSE) */
    private int $deletedBy;

    /** @ORM\Column(type="text", nullable=TRUE, unique=FALSE) */
    private ?string $deletedData;



    /**
     * @return \DateTime
     */
    public function getInserted(): \DateTime
    {
        return $this->inserted;
    }

    /**
     * @param \DateTime $inserted
     */
    public function setInserted(\DateTime $inserted): void
    {
        $this->inserted = $inserted;
    }

    /**
     * @return int
     */
    public function getInsertedBy(): int
    {
        return $this->insertedBy;
    }

    /**
     * @param int $insertedBy
     */
    public function setInsertedBy(int $insertedBy): void
    {
        $this->insertedBy = $insertedBy;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }

    /**
     * @param int $updatedBy
     */
    public function setUpdatedBy(int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return int
     */
    public function getDeletedBy(): int
    {
        return $this->deletedBy;
    }

    /**
     * @param int $deletedBy
     */
    public function setDeletedBy(int $deletedBy): void
    {
        $this->deletedBy = $deletedBy;
    }

    /**
     * @return string
     */
    public function getDeletedData(): string
    {
        return $this->deletedData;
    }

    /**
     * @param string $deletedData
     */
    public function setDeletedData(string $deletedData): void
    {
        $this->deletedData = $deletedData;
    }
}
