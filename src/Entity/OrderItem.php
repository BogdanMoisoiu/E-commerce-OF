<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?Product $Fk_product = null;

    #[ORM\Column]
    private ?int $quantity = null;



    #[ORM\ManyToOne]
    private ?User $fk_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkProduct(): ?Product
    {
        return $this->Fk_product;
    }

    public function setFkProduct(?Product $Fk_product): self
    {
        $this->Fk_product = $Fk_product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /*public function equals(OrderItem $orderItem): bool
    {
        
        return $this->getFkProduct()->getId() === $orderItem->getFKProduct()->getId();
    }
    */

  

    public function equals(OrderItem $item): bool
{
    return $this->getFkProduct()->getId() === $item->getFkProduct()->getId();
}

/**
 * Calculates the item total.
 *
 * @return float|int
 */
public function getTotal(): float
{
    return $this->getFkProduct()->getPrice() * $this->getQuantity();
}

public function getFkUser(): ?User
{
    return $this->fk_user;
}

public function setFkUser(?User $fk_user): self
{
    $this->fk_user = $fk_user;

    return $this;
}
}
