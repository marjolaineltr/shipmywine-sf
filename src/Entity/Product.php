<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $area;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $cuveeDomaine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $capacity;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $vintage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @
     */
    private ?string $image = null ;


    /**
     * @ORM\Column(type="float")
     */
    private ?float $alcoholVolume;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $hsCode;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $state = 'en stock';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?Integer $stockQuantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?Integer $rate;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?\DateTimeImmutable $createdAt;


    /**
     * @ORM\ManyToOne(targetEntity=Color::class, inversedBy="products")
     */
    private ?Color $color;

    /**
     * @ORM\ManyToOne(targetEntity=Appellation::class,inversedBy="products")
     */
    private ?Appellation $appellation;


    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="products")
     */
    private ?Type $type;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="product")
     */
    private ?Collection $orders;


    /**
     * @ORM\ManyToOne (targetEntity=Company::class, inversedBy="product")
     */
    private ?Company $company = null;



    public function __construct()
    {

        $this->orders = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();

    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company|null $company
     */
    public function setCompany(?Company $company): void
    {
        $this->company = $company;
    }




    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param string|null $area
     */
    public function setArea(?string $area): void
    {
        $this->area = $area;
    }

    /**
     * @return string|null
     */
    public function getCuveeDomaine(): ?string
    {
        return $this->cuveeDomaine;
    }

    /**
     * @param string|null $cuveeDomaine
     */
    public function setCuveeDomaine(?string $cuveeDomaine): void
    {
        $this->cuveeDomaine = $cuveeDomaine;
    }

    /**
     * @return string|null
     */
    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    /**
     * @param string|null $capacity
     */
    public function setCapacity(?string $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return int|null
     */
    public function getVintage(): ?int
    {
        return $this->vintage;
    }

    /**
     * @param int|null $vintage
     */
    public function setVintage(?int $vintage): void
    {
        $this->vintage = $vintage;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return float|null
     */
    public function getAlcoholVolume(): ?float
    {
        return $this->alcoholVolume;
    }

    /**
     * @param float|null $alcoholVolume
     */
    public function setAlcoholVolume(?float $alcoholVolume): void
    {
        $this->alcoholVolume = $alcoholVolume;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getHsCode(): ?string
    {
        return $this->hsCode;
    }

    /**
     * @param string|null $hsCode
     */
    public function setHsCode(?string $hsCode): void
    {
        $this->hsCode = $hsCode;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return int|null
     */
    public function getStockQuantity(): ?int
    {
        return $this->stockQuantity;
    }

    /**
     * @param int|null $stockQuantity
     */
    public function setStockQuantity(?int $stockQuantity): void
    {
        $this->stockQuantity = $stockQuantity;
    }

    /**
     * @return int|null
     */
    public function getRate(): ?int
    {
        return $this->rate;
    }

    /**
     * @param int|null $rate
     */
    public function setRate(?int $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Color|null
     */
    public function getColor(): ?Color
    {
        return $this->color;
    }

    /**
     * @param Color|null $color
     */
    public function setColor(?Color $color): void
    {
        $this->color = $color;
    }

    /**
     * @return Appellation|null
     */
    public function getAppellation(): ?Appellation
    {
        return $this->appellation;
    }

    /**
     * @param Appellation|null $appellation
     */
    public function setAppellation(?Appellation $appellation): void
    {
        $this->appellation = $appellation;
    }

    /**
     * @return Type|null
     */
    public function getType(): ?Type
    {
        return $this->type;
    }

    /**
     * @param Type|null $type
     */
    public function setType(?Type $type): void
    {
        $this->type = $type;
    }


    /**
     * @return ArrayCollection
     */
    public function getOrders(): ArrayCollection
    {
        return $this->orders;
    }

    /**
     * @param ArrayCollection $orders
     */
    public function setOrders(ArrayCollection $orders): void
    {
        $this->orders = $orders;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     */
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }




}
