<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private ?string $street;

    /**
     * @Assert\NotBlank;
     * @Assert\Regex(pattern="/^[A-Za-z0-9]{5}$/", message="Code postal invalide.")
     * @ORM\Column(type="string", length=255)
     */
    private ?string $zipCode;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private ?string $city;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private ?string $country;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private ?string $province;

    /**
     * @Assert\Valid
     * @ORM\Column(type="string", length=255)
     */
    private ?string $iso;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="address",cascade={"persist"},)
     */
    private ?User $user;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, mappedBy="address", cascade={"persist", "remove"})
     */
    private Company $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIso(): ?string
    {
        return $this->iso;
    }

    /**
     * @param string|null $iso
     */
    public function setIso(?string $iso): void
    {
        $this->iso = $iso;
    }



    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }


}
