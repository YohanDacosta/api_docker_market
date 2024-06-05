<?php

namespace App\Entity;

use App\Repository\CompaniesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
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

    #[ORM\Column]
    #[Groups(['company:read', 'company:write'])]
    private ?int $type = null;

    #[ORM\Column(length: 25, unique: true)]
    #[Groups(['company:read', 'company:write'])]
    private ?string $cif = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $discharge_date = null;

    public function __construct()
    {
        $this->discharge_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
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

    public function getDischargeDate(): ?\DateTimeInterface
    {
        return $this->discharge_date;
    }

    public function setDischargeDate(\DateTimeInterface $discharge_date): static
    {
        $this->discharge_date = $discharge_date;

        return $this;
    }
}
