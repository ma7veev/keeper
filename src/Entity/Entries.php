<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntriesRepository")
 */
class Entries
{
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime);
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount_before;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount_after;

    /**
     * @ORM\Column(type="integer")
     */
    private $operation_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $account_id;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmountBefore(): ?int
    {
        return $this->amount_before;
    }

    public function setAmountBefore(int $amount_before): self
    {
        $this->amount_before = $amount_before;

        return $this;
    }

    public function getAmountAfter(): ?int
    {
        return $this->amount_after;
    }

    public function setAmountAfter(int $amount_after): self
    {
        $this->amount_after = $amount_after;

        return $this;
    }

    public function getOperationId(): ?int
    {
        return $this->operation_id;
    }

    public function setOperationId(int $operation_id): self
    {
        $this->operation_id = $operation_id;

        return $this;
    }

    public function getAccountId(): ?int
    {
        return $this->account_id;
    }

    public function setAccountId(int $account_id): self
    {
        $this->account_id = $account_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
