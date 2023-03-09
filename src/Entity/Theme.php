<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
#[ApiResource()]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomTheme = null;

    #[ORM\OneToMany(mappedBy: 'Theme', targetEntity: ListeMot::class)]
    private Collection $listeMots;

    public function __construct()
    {
        $this->listeMots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTheme(): ?string
    {
        return $this->nomTheme;
    }

    public function setNomTheme(string $nomTheme): self
    {
        $this->nomTheme = $nomTheme;

        return $this;
    }

    /**
     * @return Collection<int, ListeMot>
     */
    public function getListeMots(): Collection
    {
        return $this->listeMots;
    }

    public function addListeMot(ListeMot $listeMot): self
    {
        if (!$this->listeMots->contains($listeMot)) {
            $this->listeMots->add($listeMot);
            $listeMot->setTheme($this);
        }

        return $this;
    }

    public function removeListeMot(ListeMot $listeMot): self
    {
        if ($this->listeMots->removeElement($listeMot)) {
            // set the owning side to null (unless already changed)
            if ($listeMot->getTheme() === $this) {
                $listeMot->setTheme(null);
            }
        }

        return $this;
    }
}
