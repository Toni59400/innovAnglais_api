<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: TestRepository::class)]

#[UniqueEntity(
    fields: ['id', 'DernierPassage'],
    errorPath: 'port', 
    message: 'Already use',
)]
#[ApiResource()]
class Test
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Id]
    #[ORM\Column]
    private ?int $DernierPassage = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    private ?ListeMot $ListeMot = null;

    #[ORM\OneToMany(mappedBy: 'Test', targetEntity: FaireTest::class)]
    private Collection $faireTests;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    

    public function __construct()
    {
        $this->faireTests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDernierPassage(): ?int
    {
        return $this->DernierPassage;
    }

    public function setDernierPassage(int $DernierPassage): self
    {
        $this->DernierPassage = $DernierPassage;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getListeMot(): ?ListeMot
    {
        return $this->ListeMot;
    }

    public function setListeMot(?ListeMot $ListeMot): self
    {
        $this->ListeMot = $ListeMot;

        return $this;
    }

   

    /**
     * @return Collection<int, FaireTest>
     */
    public function getFaireTests(): Collection
    {
        return $this->faireTests;
    }

    public function addFaireTest(FaireTest $faireTest): self
    {
        if (!$this->faireTests->contains($faireTest)) {
            $this->faireTests->add($faireTest);
            $faireTest->setTest($this);
        }

        return $this;
    }

    public function removeFaireTest(FaireTest $faireTest): self
    {
        if ($this->faireTests->removeElement($faireTest)) {
            // set the owning side to null (unless already changed)
            if ($faireTest->getTest() === $this) {
                $faireTest->setTest(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
