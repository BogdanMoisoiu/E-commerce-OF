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
    private ?Product $Fk_product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'fk_orderitem')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $orderRef = null;

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

    public function getOrderRef(): ?Cart
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Cart $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

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
}
