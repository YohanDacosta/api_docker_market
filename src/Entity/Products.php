<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductsRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
#[UniqueEntity(    
    fields: ['name'],
    message: 'This {{ value }} is already exists.'
)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?int $id = null;

    /**
     * @var Collection<int, Companies>
     */
    #[ORM\ManyToMany(targetEntity: Companies::class, inversedBy: 'products')]
    #[Groups(['product:read', 'product:write'])]
    private Collection $company;

    #[ORM\Column(length: 25, unique: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['product:read', 'product:write'])]
    private ?TypeProduct $type_product = null;

    /**
     * @var Collection<int, Countries>
     */
    #[ORM\ManyToMany(targetEntity: Countries::class, inversedBy: 'products')]
    #[Groups(['product:read', 'product:write'])]
    private Collection $country;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?bool $imported = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?int $quantity = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?bool $caducated = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $photo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['product:read'])]
    private ?\DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->company = new ArrayCollection();
        $this->country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeProduct(): ?TypeProduct
    {
        return $this->type_product;
    }

    public function setTypeProduct(?TypeProduct $type_product): static
    {
        $this->type_product = $type_product;

        return $this;
    }

    public function isImported(): ?bool
    {
        return $this->imported;
    }

    public function setImported(bool $imported): static
    {
        $this->imported = $imported;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isCaducated(): ?bool
    {
        return $this->caducated;
    }

    public function setCaducated(bool $caducated): static
    {
        $this->caducated = $caducated;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDischargeDate(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setDischargeDate(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Companies>
     */
    public function getCompany(): Collection
    {
        return $this->company;
    }

    public function addCompany(Companies $company): static
    {
        if (!$this->company->contains($company)) {
            $this->company->add($company);
        }

        return $this;
    }

    public function removeCompany(Companies $company): static
    {
        $this->company->removeElement($company);

        return $this;
    }

    /**
     * @return Collection<int, Countries>
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(Countries $country): static
    {
        if (!$this->country->contains($country)) {
            $this->country->add($country);
        }

        return $this;
    }

    public function removeCountry(Countries $country): static
    {
        $this->country->removeElement($country);

        return $this;
    }
}
