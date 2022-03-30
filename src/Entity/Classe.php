<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 5)]
    private $niveau;

    #[ORM\ManyToOne(targetEntity: Prof::class, inversedBy: 'classesPrincipales')]
    #[ORM\JoinColumn(nullable: false)]
    private $profPrincipal;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Eleve::class)]
    private $eleves;

    public function __construct() {
        $this->eleves = new ArrayCollection();
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

    public function getNiveau(): ?string {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self {
        $this->niveau = $niveau;

        return $this;
    }

    public function getProfPrincipal(): ?Prof {
        return $this->profPrincipal;
    }

    public function setProfPrincipal(?Prof $profPrincipal): self {
        $this->profPrincipal = $profPrincipal;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleves(): Collection {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setClasse($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getClasse() === $this) {
                $elefe->setClasse(null);
            }
        }

        return $this;
    }
}
