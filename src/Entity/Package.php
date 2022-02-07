<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageRepository::class)
 */
class Package
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $bottleQuantity;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $height;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $length;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $width;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $weight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBottleQuantity(): ?int
    {
        return $this->bottleQuantity;
    }

    public function setBottleQuantity(int $bottleQuantity): self
    {
        $this->bottleQuantity = $bottleQuantity;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
