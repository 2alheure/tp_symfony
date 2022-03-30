<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve {
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

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Note::class, orphanRemoval: true)]
    private $notes;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private $classe;

    public function __construct() {
        $this->notes = new ArrayCollection();
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

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection {
        return $this->notes;
    }

    public function addNote(Note $note): self {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEleve($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEleve() === $this) {
                $note->setEleve(null);
            }
        }

        return $this;
    }

    public function getMoyenneGenerale() {
        $sumNotes = 0;
        $sumCoefs = 0;

        foreach ($this->notes as $note) {
            $sumCoefs += $note->getCoefficient();
            $sumNotes += $note->getNote() * $note->getCoefficient();
        }

        return number_format($sumNotes / $sumCoefs, 2);
    }

    public function getClasse(): ?Classe {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self {
        $this->classe = $classe;

        return $this;
    }
}
