<?php

namespace App\Entity;

use App\Repository\MentoringSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentoringSessionRepository::class)
 */
class MentoringSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $summary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinished;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=MentoringContract::class, inversedBy="mentoringSessions")
     */
    private $MentoringContract;

    /**
     * @ORM\OneToMany(targetEntity=Notation::class, mappedBy="MentoringSession", orphanRemoval=true)
     */
    private $notations;

    public function __construct()
    {
        $this->MentoringContract = new ArrayCollection();
        $this->notations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getIsFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|MentoringContract[]
     */
    public function getMentoringContract(): Collection
    {
        return $this->MentoringContract;
    }

    public function addMentoringContract(MentoringContract $mentoringContract): self
    {
        if (!$this->MentoringContract->contains($mentoringContract)) {
            $this->MentoringContract[] = $mentoringContract;
        }

        return $this;
    }

    public function removeMentoringContract(MentoringContract $mentoringContract): self
    {
        if ($this->MentoringContract->contains($mentoringContract)) {
            $this->MentoringContract->removeElement($mentoringContract);
        }

        return $this;
    }

    /**
     * @return Collection|Notation[]
     */
    public function getNotations(): Collection
    {
        return $this->notations;
    }

    public function addNotation(Notation $notation): self
    {
        if (!$this->notations->contains($notation)) {
            $this->notations[] = $notation;
            $notation->setMentoringSession($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->contains($notation)) {
            $this->notations->removeElement($notation);
            // set the owning side to null (unless already changed)
            if ($notation->getMentoringSession() === $this) {
                $notation->setMentoringSession(null);
            }
        }

        return $this;
    }
}
