<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Companies>
     */
    #[ORM\OneToMany(targetEntity: Companies::class, mappedBy: 'type_id')]
    private Collection $companies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

    #[Groups(['company:read', 'company:write'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['company:read', 'company:write'])]
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $company->setTypeId($this);
        }

        return $this;
    }

    public function removeCompany(Companies $company): static
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getTypeId() === $this) {
                $company->setTypeId(null);
            }
        }

        return $this;
    }
}
