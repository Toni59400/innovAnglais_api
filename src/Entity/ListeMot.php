<?php

namespace App\Entity;

use App\Repository\ListeMotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ListeMotRepository::class)]
#[ApiResource()]
class ListeMot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listeMots')]
    private ?Theme $Theme = null;

    #[ORM\OneToMany(mappedBy: 'ListeMot', targetEntity: Test::class)]
    private Collection $tests;

    #[ORM\ManyToMany(targetEntity: Mot::class, mappedBy: 'liste')]
    private Collection $mots;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->mots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?Theme
    {
        return $this->Theme;
    }

    public function setTheme(?Theme $Theme): self
    {
        $this->Theme = $Theme;

        return $this;
    }

    /**
     * @return Collection<int, Test>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests->add($test);
            $test->setListeMot($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getListeMot() === $this) {
                $test->setListeMot(null);
            }
        }

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
            $mot->addListe($this);
        }

        return $this;
    }

    public function removeMot(Mot $mot): self
    {
        if ($this->mots->removeElement($mot)) {
            $mot->removeListe($this);
        }

        return $this;
    }
}
