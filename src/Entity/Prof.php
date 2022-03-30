<?php

namespace App\Entity;

use App\Repository\ProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfRepository::class)]
class Prof {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'date')]
    private $dateNaissance;

    #[ORM\ManyToOne(targetEntity: Matiere::class, inversedBy: 'profs')]
    #[ORM\JoinColumn(nullable: false)]
    private $matiere;

    #[ORM\OneToMany(mappedBy: 'profPrincipal', targetEntity: Classe::class)]
    private $classesPrincipales;

    public function __construct() {
        $this->classesPrincipales = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNomEtPrenom() {
        return ucfirst($this->prenom) . ' ' . mb_strtoupper($this->nom);
    }

    public function getDateNaissance(): ?\DateTimeInterface {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getMatiere(): ?Matiere {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClassesPrincipales(): Collection {
        return $this->classesPrincipales;
    }

    public function addClassesPrincipale(Classe $classesPrincipale): self {
        if (!$this->classesPrincipales->contains($classesPrincipale)) {
            $this->classesPrincipales[] = $classesPrincipale;
            $classesPrincipale->setProfPrincipal($this);
        }

        return $this;
    }

    public function removeClassesPrincipale(Classe $classesPrincipale): self {
        if ($this->classesPrincipales->removeElement($classesPrincipale)) {
            // set the owning side to null (unless already changed)
            if ($classesPrincipale->getProfPrincipal() === $this) {
                $classesPrincipale->setProfPrincipal(null);
            }
        }

        return $this;
    }
}
