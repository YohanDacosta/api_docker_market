<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeCompanyRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeCompanyRepository::class)]
class TypeCompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['type_company:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Groups(['type_company:read', 'type_company:write'])]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
