<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['reads']], collectionOperations: ["get"=>["security"=> "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')"], "post"=>["security"=> "is_granted('ROLE_ADMIN')"]], itemOperations: ["get"=>["security"=> "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')"], "patch"=>["security"=> "is_granted('ROLE_ADMIN')"], "delete"=>["security"=> "is_granted('ROLE_ADMIN')"]])]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["reads"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["reads"])]
    private ?string $nomCategorie = null;

    #[ORM\ManyToMany(targetEntity: Mot::class, mappedBy: 'categorie')]
    #[Groups(["reads"])]
    private Collection $mots;

    public function __construct()
    {
        $this->mots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Mot>
     */
    public function getMots(): Collection
    {
        return $this->mots;
    }

    public function addMot(Mot $mot): self
    {
        if (!$this->mots->contains($mot)) {
            $this->mots->add($mot);
            $mot->addCategorie($this);
        }

        return $this;
    }

    public function removeMot(Mot $mot): self
    {
        if ($this->mots->removeElement($mot)) {
            $mot->removeCategorie($this);
        }

        return $this;
    }
}
