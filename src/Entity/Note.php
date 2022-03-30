<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    /**
     * @Assert\DivisibleBy(0.25)
     */
    private $note;

    #[ORM\Column(type: 'float')]
    /**
     * @Assert\DivisibleBy(0.5)
     */
    private $coefficient;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\ManyToOne(targetEntity: Matiere::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $matiere;

    #[ORM\ManyToOne(targetEntity: Eleve::class, inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private $eleve;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNote(): ?float {
        return $this->note;
    }

    public function setNote(float $note): self {
        $this->note = $note;

        return $this;
    }

    public function getCoefficient(): ?float {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): self {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self {
        $this->date = $date;

        return $this;
    }

    public function getMatiere(): ?Matiere {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self {
        $this->matiere = $matiere;

        return $this;
    }

    public function getEleve(): ?Eleve {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self {
        $this->eleve = $eleve;

        return $this;
    }
}
