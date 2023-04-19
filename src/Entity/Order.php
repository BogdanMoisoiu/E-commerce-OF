<?php

namespace App\Entity;

use App\Repository\OrderRepository;
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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderItem $Fk_orderItem = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;
    
    # private ?string $status = self::STATUS_CART;

    # const STATUS_CART = 'cart';

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

    public function getFkOrderItem(): ?OrderItem
    {
        return $this->Fk_orderItem;
    }

    public function setFkOrderItem(?OrderItem $Fk_orderItem): self
    {
        $this->Fk_orderItem = $Fk_orderItem;

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
}
