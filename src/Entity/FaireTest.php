<?php

namespace App\Entity;

use App\Repository\FaireTestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: FaireTestRepository::class)]
#[UniqueEntity(
    fields: ['Utilisateur', 'Test'],
    errorPath: 'port', 
    message: 'Already use',
)]
#[ApiResource()]
class FaireTest
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'faireTests')]
    private ?User $Utilisateur = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'faireTests')]
    private ?Test $Test = null;

    #[ORM\Column(length: 255)]
    private ?string $resultat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?User
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?User $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->Test;
    }

    public function setTest(?Test $Test): self
    {
        $this->Test = $Test;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }
}
