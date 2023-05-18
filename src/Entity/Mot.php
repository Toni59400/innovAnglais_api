<?php

namespace App\Entity;

use App\Repository\MotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: MotRepository::class)]
#[ApiResource(paginationEnabled: false, collectionOperations: ["get"=>["security"=> "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')"], "post"=>["security"=> "is_granted('ROLE_ADMIN')"]], itemOperations: ["get"=>["security"=> "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')"], "patch"=>["security"=> "is_granted('ROLE_ADMIN')"], "delete"=>["security"=> "is_granted('ROLE_ADMIN')"]])]
class Mot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'mots')]
    private Collection $categorie;

    #[ORM\ManyToMany(targetEntity: ListeMot::class, inversedBy: 'mots')]
    private Collection $liste;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'mots')]
    private Collection $motCorrespondant;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'motCorrespondant')]
    private Collection $mots;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->liste = new ArrayCollection();
        $this->motCorrespondant = new ArrayCollection();
        $this->mots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, ListeMot>
     */
    public function getListe(): Collection
    {
        return $this->liste;
    }

    public function addListe(ListeMot $liste): self
    {
        if (!$this->liste->contains($liste)) {
            $this->liste->add($liste);
        }

        return $this;
    }

    public function removeListe(ListeMot $liste): self
    {
        $this->liste->removeElement($liste);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMotCorrespondant(): Collection
    {
        return $this->motCorrespondant;
    }

    public function addMotCorrespondant(self $motCorrespondant): self
    {
        if (!$this->motCorrespondant->contains($motCorrespondant)) {
            $this->motCorrespondant->add($motCorrespondant);
        }

        return $this;
    }

    public function removeMotCorrespondant(self $motCorrespondant): self
    {
        $this->motCorrespondant->removeElement($motCorrespondant);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMots(): Collection
    {
        return $this->mots;
    }

    public function addMot(self $mot): self
    {
        if (!$this->mots->contains($mot)) {
            $this->mots->add($mot);
            $mot->addMotCorrespondant($this);
        }

        return $this;
    }

    public function removeMot(self $mot): self
    {
        if ($this->mots->removeElement($mot)) {
            $mot->removeMotCorrespondant($this);
        }

        return $this;
    }
}
