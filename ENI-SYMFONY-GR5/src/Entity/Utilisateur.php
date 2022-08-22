<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=campus::class, inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateurcampus;

    /**
     * @ORM\ManyToMany(targetEntity=Date::class)
     */
    private $participantdate;

    /**
     * @ORM\OneToMany(targetEntity=Date::class, mappedBy="utilisateur", orphanRemoval=true)
     */
    private $participantdateorga;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relation;

    public function __construct()
    {
        $this->participantdate = new ArrayCollection();
        $this->participantdateorga = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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
     * @see UserInterface
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdministrateur(): ?bool
    {
        return $this->administrateur;
    }

    public function setAdministrateur(bool $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection<int, Date>
     */
    public function getParticipantdate(): Collection
    {
        return $this->participantdate;
    }

    public function addParticipantdate(Date $participantdate): self
    {
        if (!$this->participantdate->contains($participantdate)) {
            $this->participantdate[] = $participantdate;
        }

        return $this;
    }

    public function removeParticipantdate(Date $participantdate): self
    {
        $this->participantdate->removeElement($participantdate);

        return $this;
    }

    /**
     * @return Collection<int, Date>
     */
    public function getParticipantdateorga(): Collection
    {
        return $this->participantdateorga;
    }

    public function addParticipantdateorga(Date $participantdateorga): self
    {
        if (!$this->participantdateorga->contains($participantdateorga)) {
            $this->participantdateorga[] = $participantdateorga;
            $participantdateorga->setUtilisateur($this);
        }

        return $this;
    }

    public function removeParticipantdateorga(Date $Participantdateorga): self
    {
        if ($this->Participantdateorga->removeElement($Participantdateorga)) {
            // set the owning side to null (unless already changed)
            if ($Participantdateorga->getUtilisateur() === $this) {
                $Participantdateorga->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getRelation(): ?Campus
    {
        return $this->relation;
    }

    public function setRelation(?Campus $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}
