<?php

namespace App\Entity;

use DateTime;
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

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?int $company_id = null;

    #[ORM\Column(length: 25, unique: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?int $type_product = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?int $country_id = null;

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
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyId(): ?int
    {
        return $this->company_id;
    }

    public function setCompanyId(int $company_id): static
    {
        $this->company_id = $company_id;

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

    public function getTypeProduct(): ?int
    {
        return $this->type_product;
    }

    public function setTypeProduct(int $type_product): static
    {
        $this->type_product = $type_product;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id): static
    {
        $this->country_id = $country_id;

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
}
