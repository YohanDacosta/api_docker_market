<?php

namespace App\Entity;

use App\Repository\CompaniesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Countries;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompaniesRepository::class)]
#[UniqueEntity(    
    fields: ['cif'],
    message: 'This {{ value }} is already exists.'
)]
class Companies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['company:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: TypeCompany::class, inversedBy: 'companies')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['company:read', 'company:write'])]
    private ?TypeCompany $type = null;

    #[ORM\Column(length: 25, unique: true)]
    #[Groups(['company:read', 'company:write'])]
    private ?string $cif = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['company:read'])]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at= null;

    #[ORM\ManyToOne(targetEntity: Countries::class, inversedBy: 'companies')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['company:read', 'company:write'])]
    private ?Countries $country = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?TypeCompany
    {
        return $this->type;
    }

    public function setType(?TypeCompany $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCif(): ?string
    {
        return $this->cif;
    }

    public function setCif(string $cif): static
    {
        $this->cif = $cif;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCountry(): ?Countries
    {
        return $this->country;
    }

    public function setCountry(?Countries $country): static
    {
        $this->country = $country;

        return $this;
    }
}
