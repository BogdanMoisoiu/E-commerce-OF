<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_time_stamp = null;

    #[ORM\Column(length: 255)]
    // private ?string $status = null;
    private ?string $status = self::STATUS_CART;

    const STATUS_CART = 'cart';

    #[ORM\OneToMany(mappedBy: 'orderRef', targetEntity: OrderItem::class, cascade: ["persist", "remove"], orphanRemoval: true)]
    private Collection $fk_orderitem;

    public function __construct()
    {
        $this->fk_orderitem = new ArrayCollection();
    }  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTimeStamp(): ?\DateTimeInterface
    {
        return $this->date_time_stamp;
    }

    public function setDateTimeStamp(\DateTimeInterface $date_time_stamp): self
    {
        $this->date_time_stamp = $date_time_stamp;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /*public function addItem(OrderItem $orderItem): self
    {
        foreach($this->getFkOrderItem() as $existingItem) {
            if($existingItem->equals($orderItem)) {
                $existingItem->setQuantity($existingItem->getQuantity() + $orderItem->getQuantity());
                return $this;
            }

        }

        $this->orderItems[] = $orderItem;
        $orderItem->setOrderRef($this);
    }
    */

    /**
     * @return Collection<int, OrderItem>
     */
    public function getFkOrderitem(): Collection
    {
        return $this->fk_orderitem;
    }

    public function addFkOrderitem(OrderItem $item): self
{
    foreach ($this->getFkOrderitem() as $existingItem) {
        // The item already exists, update the quantity
        if ($existingItem->equals($item)) {
            $existingItem->setQuantity(
                $existingItem->getQuantity() + $item->getQuantity()
            );
            return $this;
        }
    }
    $this->fk_orderitem[] = $item;
    $item->setOrderRef($this);

    return $this;
}
    // public function addFkOrderitem(OrderItem $fkOrderitem): self
    // {
    //     if (!$this->fk_orderitem->contains($fkOrderitem)) {
    //         $this->fk_orderitem->add($fkOrderitem);
    //         $fkOrderitem->setOrderRef($this);
    //     }

    //     return $this;
    // }

    public function removeFkOrderitem(OrderItem $fkOrderitem): self
    {
        if ($this->fk_orderitem->removeElement($fkOrderitem)) {
            // set the owning side to null (unless already changed)
            if ($fkOrderitem->getOrderRef() === $this) {
                $fkOrderitem->setOrderRef(null);
            }
        }

        return $this;
    }
    public function removeFkOrderitems(): self
    {
        foreach ($this->getFkOrderitem() as $item) {
           $this->removeFkOrderitem($item);
        }
        return $this;
    }

    
/**
 * Removes all items from the order.
 *
 * @return $this
 */
public function removeItems(): self
{
    foreach ($this->getFkOrderitem() as $item) {
        $this->removeFkOrderitem($item);
    }

    return $this;
}


public function getTotal(): float
{
    $total = 0;

    foreach ($this->getFkOrderitem() as $item) {
        $total += $item->getTotal();
    }
    return $total;
}

}
