<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    public ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prod_dimensions = null;

    #[ORM\Column(length: 255)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $power_max = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $power_source = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column]
    private ?int $quantity_left = null;

    #[ORM\Column(length: 50)]
    private ?string $material = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $special_features = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $style = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $discount = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $Fk_brand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?bool $approved = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProdDimensions(): ?string
    {
        return $this->prod_dimensions;
    }

    public function setProdDimensions(?string $prod_dimensions): self
    {
        $this->prod_dimensions = $prod_dimensions;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPowerMax(): ?string
    {
        return $this->power_max;
    }

    public function setPowerMax(?string $power_max): self
    {
        $this->power_max = $power_max;

        return $this;
    }

    public function getPowerSource(): ?string
    {
        return $this->power_source;
    }

    public function setPowerSource(?string $power_source): self
    {
        $this->power_source = $power_source;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getQuantityLeft(): ?int
    {
        return $this->quantity_left;
    }

    public function setQuantityLeft(int $quantity_left): self
    {
        $this->quantity_left = $quantity_left;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getSpecialFeatures(): ?string
    {
        return $this->special_features;
    }

    public function setSpecialFeatures(?string $special_features): self
    {
        $this->special_features = $special_features;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getFkBrand(): ?Brand
    {
        return $this->Fk_brand;
    }

    public function setFkBrand(?Brand $Fk_brand): self
    {
        $this->Fk_brand = $Fk_brand;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

}
