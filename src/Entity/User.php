<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['read']], collectionOperations: ["get"=>["security"=> "is_granted('ROLE_ADMIN')"], "post"=>["security"=> "is_granted('ROLE_ADMIN')"]], itemOperations: ["get"=>["security"=> "is_granted('ROLE_ADMIN') or object == user"], "patch"=>["security"=> "is_granted('ROLE_ADMIN') or object == user"], "delete"=>["security"=> "is_granted('ROLE_ADMIN')"]])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read"])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(["read"])]
    private ?string $nom = null;

    #[ORM\Column]
    #[Groups(["read"])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(["read"])]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read"])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read"])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read"])]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read"])]
    private ?string $ville = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(["read"])]
    private ?\DateTimeInterface $dateSouscription = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(["read"])]
    private ?\DateTimeInterface $dateDernierPaiement = null;

    #[ORM\ManyToMany(targetEntity: Abonnement::class, mappedBy: 'Utilisateur')]
    #[Groups(["read"])]
    private Collection $abonnements;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: FaireTest::class)]
    private Collection $faireTests;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Test::class)]
    private Collection $tests;

    public function __construct()
    {
        $this->abonnements = new ArrayCollection();
        $this->faireTests = new ArrayCollection();
        $this->abonnement = new ArrayCollection();
        $this->tests = new ArrayCollection();
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDateSouscription(): ?\DateTimeInterface
    {
        return $this->dateSouscription;
    }

    public function setDateSouscription(\DateTimeInterface $dateSouscription): self
    {
        $this->dateSouscription = $dateSouscription;

        return $this;
    }

    public function getDateDernierPaiement(): ?\DateTimeInterface
    {
        return $this->dateDernierPaiement;
    }

    public function setDateDernierPaiement(\DateTimeInterface $dateDernierPaiement): self
    {
        $this->dateDernierPaiement = $dateDernierPaiement;

        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): self
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements->add($abonnement);
            $abonnement->addUtilisateur($this);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): self
    {
        if ($this->abonnements->removeElement($abonnement)) {
            $abonnement->removeUtilisateur($this);
        }

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
            $faireTest->setUtilisateur($this);
        }

        return $this;
    }

    public function removeFaireTest(FaireTest $faireTest): self
    {
        if ($this->faireTests->removeElement($faireTest)) {
            // set the owning side to null (unless already changed)
            if ($faireTest->getUtilisateur() === $this) {
                $faireTest->setUtilisateur(null);
            }
        }

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
            $test->setUser($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getUser() === $this) {
                $test->setUser(null);
            }
        }

        return $this;
    }
}
