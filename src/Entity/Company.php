<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column()
     * @Assert\NotBlank
     */
    private string $name = "";

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private ?string $siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $vatNumber;


    /**
     * @ORM\Column(nullable=true, type="text")
     * @Assert\NotBlank
     */
    private ?string $presentation;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, inversedBy="company",cascade={"persist", "remove"})
     */
    private ?Address $address;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="company")
     */
    private User $user;

    /**
     * @ORM\OneToMany (targetEntity=Product::class, mappedBy="company")
     *
     */
    private Collection $product;

    /**
     * @return Collection
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    /**
     * @param Collection $product
     */
    public function setProduct(Collection $product): void
    {
        $this->product = $product;
    }




    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    /**
     * @param string|null $vatNumber
     */
    public function setVatNumber(?string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }




    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address|null $address
     */
    public function setAddress(?Address $address): void
    {
        $this->address = $address;
    }

//    /**
//     * @return Image
//     */
//    public function getImage(): Image
//    {
//        return $this->image;
//    }
//
//    /**
//     * @param Image $image
//     */
//    public function setImage(Image $image): void
//    {
//        $this->image = $image;
//    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCompany($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompany() === $this) {
                $user->setCompany(null);
            }
        }

        return $this;
    }
}
