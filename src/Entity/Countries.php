<?php

namespace App\Entity;

use App\Entity\Companies;
use App\Repository\CountriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CountriesRepository::class)]
class Countries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['country:read', 'company:read', 'product:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    #[Groups(['country:read', 'country:write', 'company:read', 'product:read'])]
    private ?string $iso = null;

    #[ORM\Column(length: 80)]
    #[Groups(['country:read', 'country:write', 'company:read', 'product:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Companies>
     */
    #[ORM\OneToMany(targetEntity: Companies::class, mappedBy: 'country')]
    private Collection $companies;

    /**
     * @var Collection<int, Products>
     */
    #[ORM\ManyToMany(targetEntity: Products::class, mappedBy: 'country')]
    private Collection $products;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): static
    {
        $this->iso = $iso;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Companies>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Companies $company): static
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
            $company->setCountry($this);
        }

        return $this;
    }

    public function removeCompany(Companies $company): static
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getCountry() === $this) {
                $company->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addCountry($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): static
    {
        if ($this->products->removeElement($product)) {
            $product->removeCountry($this);
        }

        return $this;
    }
}
